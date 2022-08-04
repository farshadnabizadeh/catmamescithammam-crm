<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ReservationPaymentType;
use App\Models\Therapist;
use App\Models\Service;
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

            $total = ReservationPaymentType::sum("payment_price");

            $month = ReservationPaymentType::whereMonth('created_at', Carbon::now()->month)
                ->sum("payment_price");

            $week = ReservationPaymentType::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->sum("payment_price");

            $today = ReservationPaymentType::where('created_at', '>=', Carbon::now())
                ->sum("payment_price");

            $therapistAll = Therapist::select("therapists.therapist_name",
                    DB::raw("(SELECT count(*) FROM reservations_therapists a
                        WHERE a.therapist_id = therapists.id
                        ) as aCount"))
                ->get();

            $therapistMonth = Therapist::select("therapists.therapist_name",
                    DB::raw("(SELECT count(*) FROM reservations_therapists a
                        WHERE a.therapist_id = therapists.id and MONTH(created_at) =  MONTH(CURRENT_DATE())
                        ) as aCount"))
                ->get();

            $therapistWeek = Therapist::select("therapists.therapist_name",
                    DB::raw("(SELECT count(*) FROM reservations_therapists a
                        WHERE a.therapist_id = therapists.id and YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1)
                        ) as aCount"))
                ->get();

            //service
            $serviceAll = Service::select("services.service_name",
                    DB::raw("(SELECT count(*) FROM reservations_services a
                        WHERE a.service_id = services.id
                        ) as aCount"))
                ->get();

            $serviceMonth = Service::select("services.service_name",
                    DB::raw("(SELECT count(*) FROM reservations_services a
                        WHERE a.service_id = services.id and MONTH(created_at) =  MONTH(CURRENT_DATE())
                        ) as aCount"))
                ->get();

            $serviceWeek = Service::select("services.service_name",
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

    public function paymentReport(Request $request)
    {
        try {

            $start = $request->input('startDate');
            $end = $request->input('endDate');

            //
            $cashTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '5')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $cashEur = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '6')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $cashUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '7')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $cashPound = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '8')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $ykbTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '9')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $ziraatTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '10')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $ziraatEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '11')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");
                
            $ziraatDolar = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '12')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $totalData = array('cashTl' => $cashTl, 'cashEur' => $cashEur, 'cashUsd' => $cashUsd, 'cashPound' => $cashPound, 'ykbTl' => $ykbTl, 'ziraatTl' => $ziraatTl, 'ziraatEuro' => $ziraatEuro, 'ziraatDolar' => $ziraatDolar, 'start' => $start, 'end' => $end);

            return view('admin.reports.payment_report')->with($totalData);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function comissionReport(Request $request)
    {
        try {

            $start = $request->input('startDate');
            $end = $request->input('endDate');

            //
            $cashTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '5')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $cashEur = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '6')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $cashUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '7')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $cashPound = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '8')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $ykbTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '9')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $ziraatTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '10')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $ziraatEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '11')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");
                
            $ziraatDolar = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '12')
                ->whereBetween('reservations_payments_types.created_at', [$start, $end])
                ->sum("payment_price");

            $totalData = array('cashTl' => $cashTl, 'cashEur' => $cashEur, 'cashUsd' => $cashUsd, 'cashPound' => $cashPound, 'ykbTl' => $ykbTl, 'ziraatTl' => $ziraatTl, 'ziraatEuro' => $ziraatEuro, 'ziraatDolar' => $ziraatDolar, 'start' => $start, 'end' => $end);

            return view('admin.reports.payment_report')->with($totalData);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
}
