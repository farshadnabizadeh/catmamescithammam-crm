<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ReservationPaymentType;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {

            $total = DB::table('reservations_payments_types')->sum("payment_price");

            $month = DB::table('reservations_payments_types')
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum("payment_price");

            $week = DB::table('reservations_payments_types')
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->sum("payment_price");

            $today = DB::table('reservations_payments_types')
                ->where('created_at', '>=', Carbon::now())
                ->sum("payment_price");

            $therapistAll = DB::table("therapists")
                ->select("therapists.therapist_name",
                    DB::raw("(SELECT count(*) FROM reservations_therapists a
                        WHERE a.therapist_id = therapists.id
                        ) as aCount"))
                ->get();

            $therapistMonth = DB::table("therapists")
                ->select("therapists.therapist_name",
                    DB::raw("(SELECT count(*) FROM reservations_therapists a
                        WHERE a.therapist_id = therapists.id and MONTH(created_at) =  MONTH(CURRENT_DATE())
                        ) as aCount"))
                ->get();

            $therapistWeek = DB::table("therapists")
                ->select("therapists.therapist_name",
                    DB::raw("(SELECT count(*) FROM reservations_therapists a
                        WHERE a.therapist_id = therapists.id and YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1)
                        ) as aCount"))
                ->get();

            //service
            $serviceAll = DB::table("services")
                ->select("services.service_name",
                    DB::raw("(SELECT count(*) FROM reservations_services a
                        WHERE a.service_id = services.id
                        ) as aCount"))
                ->get();

            $serviceMonth = DB::table("services")
                ->select("services.service_name",
                    DB::raw("(SELECT count(*) FROM reservations_services a
                        WHERE a.service_id = services.id and MONTH(created_at) =  MONTH(CURRENT_DATE())
                        ) as aCount"))
                ->get();

            $serviceWeek = DB::table("services")
                ->select("services.service_name",
                    DB::raw("(SELECT count(*) FROM reservations_services a
                        WHERE a.service_id = services.id and YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1)
                        ) as aCount"))
                ->get();

            /* $enes = DB::table("therapists")
                ->select("therapists.therapist_name",
                    DB::raw("(SELECT count(*) FROM reservations_therapists a
                        WHERE a.therapist_id = therapists.id
                        ) as aCount"))
                ->get(); */

            // $payment_types = ReservationPaymentType::get()->whereMonth('reservations_payments_types.created_at', Carbon::now()->month)->sum("payment_price");

            $set = $request->input('set');

            $data = array('total' => $total, 'month' => $month, 'week' => $week, 'today' => $today, 'serviceAll' => $serviceAll, 'serviceMonth' => $serviceMonth, 'serviceWeek' => $serviceWeek, 'therapistMonth' => $therapistMonth, 'therapistAll' => $therapistAll, 'therapistWeek' => $therapistWeek);

            if($set == "total"){
                return view('admin.reports.reports')->with($data);
            }

            else if($set == "month"){
                return view('admin.reports.month_reports')->with($data);
            }

            else if($set == "week"){
                return view('admin.reports.week_reports')->with($data);
            }

            else if($set == "today"){
                return view('admin.reports.today_reports')->with($data);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
