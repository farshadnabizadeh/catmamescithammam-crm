<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ReservationPaymentType;
use App\Models\ReservationComission;
use App\Models\ReservationTherapist;
use App\Models\ReservationService;
use App\Models\Reservation;
use App\Models\Therapist;
use App\Models\Service;
use App\Models\Source;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\User;
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

            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $reservations = Reservation::whereBetween('reservations.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])->get();

            $data = array('reservations' => $reservations, 'start' => $start, 'end' => $end);
            return view('admin.reports.index')->with($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reservationReport(Request $request)
    {
        try {

            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $therapistAll = ReservationTherapist::select('therapists.*', DB::raw('therapist_id, sum(piece) as therapistCount'))
                ->leftJoin('therapists', 'reservations_therapists.therapist_id', '=', 'therapists.id')
                ->whereBetween('reservations_therapists.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->groupBy('therapist_id')
                ->get();

            $serviceAll = ReservationService::select('services.*', DB::raw('service_id, sum(piece) as serviceCount'))
                ->leftJoin('services', 'reservations_services.service_id', '=', 'services.id')
                ->whereBetween('reservations_services.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->groupBy('service_id')
                ->get();
            $therapistLabels = [];
            $therapistData = [];
            $therapistColors = [];

            foreach ($therapistAll as $therapist) {
                array_push($therapistLabels, $therapist->name);
                array_push($therapistData, $therapist->therapistCount);
                $therapistColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $serviceLabels = [];
            $serviceData = [];
            $serviceColors = [];

            foreach ($serviceAll as $service) {
                array_push($serviceLabels, $service->name);
                array_push($serviceData, $service->serviceCount);
                $serviceColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            $data = array(
                'therapistLabels' => $therapistLabels,
                'therapistData' => $therapistData,
                'therapistColors' => $therapistColors,
                'serviceLabels' => $serviceLabels,
                'serviceData' => $serviceData,
                'serviceColors' => $serviceColors,
                'therapistAll' => $therapistAll,
                'serviceAll' => $serviceAll,
                'start' => $start,
                'end' => $end
            );
            return view('admin.reports.reservation_report')->with($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function sourceReport(Request $request)
    {
        try {

            $data = Source::select("sources.*", \DB::raw("(SELECT count(*) FROM reservations a WHERE a.source_id = sources.id) as aCount"))->get();

            return json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function therapistReport(Request $request)
    {
        try {

            $data = Therapist::select("therapists.*", \DB::raw("(SELECT sum(piece) FROM reservations_therapists a WHERE a.therapist_id = therapists.id) as aCount"))->get();

            return json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function comissionReport(Request $request)
    {
        try {
            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $hotelComissions = ReservationComission::select('hotels.*', DB::raw('hotel_id, sum(comission_price) as totalPrice'))
                ->leftJoin('hotels', 'reservations_comissions.hotel_id', '=', 'hotels.id')
                ->whereBetween('reservations_comissions.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->whereNull('reservations_comissions.guide_id')
                ->where('reservations_comissions.comission_price', '!=', NULL)
                ->groupBy('hotel_id')
                ->get();

            $guideComissions = ReservationComission::select('guides.*', DB::raw('guide_id, sum(comission_price) as totalPrice'))
                ->leftJoin('guides', 'reservations_comissions.guide_id', '=', 'guides.id')
                ->whereBetween('reservations_comissions.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->whereNull('reservations_comissions.hotel_id')
                ->where('reservations_comissions.comission_price', '!=', NULL)
                ->groupBy('guide_id')
                ->get();

            $hotelComissionLabels = [];
            $hotelComissionData = [];
            $hotelComissionColors = [];

            foreach ($hotelComissions as $hotelComission) {
                array_push($hotelComissionLabels, $hotelComission->name);
                array_push($hotelComissionData, $hotelComission->totalPrice);
                $hotelComissionColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $guideComissionLabels = [];
            $guideComissionData = [];
            $guideComissionColors = [];

            foreach ($guideComissions as $guideComission) {
                array_push($guideComissionLabels, $guideComission->name);
                array_push($guideComissionData, $guideComission->totalPrice);
                $guideComissionColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $data = array(
                'hotelComissions' => $hotelComissions,
                'guideComissions' => $guideComissions,
                'start' => $start,
                'end' => $end,
                'hotelComissionLabels' => $hotelComissionLabels,
                'hotelComissionData' => $hotelComissionData,
                'hotelComissionColors' => $hotelComissionColors,
                'guideComissionLabels' => $guideComissionLabels,
                'guideComissionData' => $guideComissionData,
                'guideComissionColors' => $guideComissionColors,
            );

            return view('admin.reports.comission_report')->with($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function serviceReport(Request $request)
    {
        try {

            $data = Service::select("services.name", \DB::raw("(SELECT count(*) FROM reservations_services a WHERE a.service_id = services.id) as aCount"))->get();

            return json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function paymentReport(Request $request)
    {
        try {

            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $cashTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '5')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $cashEur = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '6')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $cashUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '7')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $cashPound = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '8')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $ykbTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '9')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $ziraatTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '10')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $ziraatEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '11')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $ziraatDolar = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '12')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $viatorEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '13')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $all_payments = ReservationPaymentType::select('payment_types.*', DB::raw('payment_type_id, sum(payment_price) as totalPrice'))
            ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
            ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->groupBy('payment_type_id')
            ->get();

            $all_paymentLabels = [];
            $all_paymentData = [];
            $all_paymentColors = [];
            foreach ($all_payments as $all_payment) {
                array_push($all_paymentLabels, $all_payment->type_name);
                array_push($all_paymentData, $all_payment->totalPrice);
                $all_paymentColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            $totalData = array(
                'all_paymentLabels' => $all_paymentLabels,
                'all_paymentData' => $all_paymentData,
                'all_paymentColors' => $all_paymentColors,
                'cashTl' => $cashTl,
                'cashEur' => $cashEur,
                'cashUsd' => $cashUsd,
                'cashPound' => $cashPound,
                'ykbTl' => $ykbTl,
                'ziraatTl' => $ziraatTl,
                'ziraatEuro' => $ziraatEuro,
                'ziraatDolar' => $ziraatDolar,
                'viatorEuro' => $viatorEuro,
                'start' => $start,
                'end' => $end
            );

            return view('admin.reports.payment_report')->with($totalData);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
