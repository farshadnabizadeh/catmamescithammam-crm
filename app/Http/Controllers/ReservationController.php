<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationCustomer;
use App\Models\ReservationService;
use App\Models\ReservationTherapist;
use App\Models\ReservationPaymentType;
use App\Models\Service;
use App\Models\PaymentType;
use App\Models\Source;
use App\Models\Therapist;
use App\Models\Discount;
use App\Models\Customer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $reservations = Reservation::orderBy('reservation_date', 'desc')->get();
            $services = Service::orderBy('service_name', 'asc')->get();
            $sources = Source::orderBy('source_name', 'asc')->get();
            $therapists = Therapist::orderBy('therapist_name', 'asc')->get();
            $customers = Customer::orderBy('customer_name', 'asc')->get();
            $discounts = Discount::orderBy('discount_name', 'asc')->get();
            $data = array('reservations' => $reservations, 'services' => $services, 'sources' => $sources, 'therapists' => $therapists, 'customers' => $customers, 'discounts' => $discounts);
            return view('admin.reservations.reservations_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        try {
            $reservations = Reservation::all();
            $services = Service::orderBy('service_name', 'asc')->get();
            $sources = Source::orderBy('source_name', 'asc')->get();
            $therapists = Therapist::orderBy('therapist_name', 'asc')->get();
            $customers = Customer::orderBy('customer_name', 'asc')->get();
            $discounts = Discount::orderBy('discount_name', 'asc')->get();
            $payment_types = PaymentType::orderBy('payment_type_name', 'asc')->get();
            $data = array('reservations' => $reservations, 'services' => $services, 'sources' => $sources, 'therapists' => $therapists, 'customers' => $customers, 'discounts' => $discounts, 'payment_types' => $payment_types);
            return view('admin.reservations.new_reservation')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newReservation = new Reservation();
            $newReservation->reservation_date = $request->input('arrivalDate');
            $newReservation->reservation_time = $request->input('arrivalTime');
            $newReservation->total_customer = $request->input('totalCustomer');
            $newReservation->customer_id = $request->input('customerId');
            $newReservation->service_currency = $request->input('serviceCurrency');
            $newReservation->service_cost = $request->input('serviceCost');
            $newReservation->service_commission = $request->input('serviceComission');
            $newReservation->discount_id = $request->input('discountId');
            $newReservation->source_id = $request->input('sourceId');
            $newReservation->reservation_note = $request->input('reservationNote');

            $newReservation->user_id = auth()->user()->id;
            $result = $newReservation->save();

            if ($result) {
                return response($newReservation->id, 200);
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addCustomertoReservation(Request $request)
    {
        try {
            $user = auth()->user();

            $newData = new ReservationCustomer();
            $newData->reservation_id = $request->input('reservationId');
            $newData->customer_id = $request->input('customer_id');
            $newData->user_id = $user->id;

            if ($newData->save()) {
                return response(true, 200);
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addServicetoReservation(Request $request)
    {
        try {
            $user = auth()->user();

            $newData = new ReservationService();
            $newData->reservation_id = $request->input('reservationId');
            $newData->service_id = $request->input('serviceId');
            $newData->piece = $request->input('piece');
            $newData->user_id = $user->id;

            if ($newData->save()) {
                return response(true, 200);
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addTherapisttoReservation(Request $request)
    {
        try {
            $user = auth()->user();

            $newData = new ReservationTherapist();
            $newData->reservation_id = $request->input('reservationId');
            $newData->therapist_id = $request->input('therapistId');
            $newData->piece = $request->input('piece');
            $newData->user_id = $user->id;

            if ($newData->save()) {
                return response(true, 200);
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addPaymentTypetoReservation(Request $request)
    {
        try {
            $user = auth()->user();

            $newData = new ReservationPaymentType();
            $newData->reservation_id = $request->input('reservationId');
            $newData->payment_type_id = $request->input('paymentTypeId');
            $newData->payment_price = $request->input('paymentPrice');
            $newData->user_id = $user->id;

            if ($newData->save()) {
                return response(true, 200);
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function allReservationByDate(Request $request)
    {
        try {
            $user = auth()->user();
            $searchDate = $request->input('s');
            $tpStatus = $request->input('ps');

            $arrivalsA = DB::table('reservations')
                ->select('reservations.reservation_date as date', 'reservations.*', 'reservations.id as tId',  'sources.source_color', 'sources.source_name', 'customers.customer_name as Cname')
                ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
                ->leftJoin('customers', 'reservations.customer_id', '=', 'customers.id')
                // ->whereNull('deleted_at')
                ->whereDate('reservations.reservation_date', '=', $searchDate)
                ->orderBy('reservation_date');

            if (!empty($tpStatus)) {
                $arrivalsA->where('reservations.source_id', '=', $tpStatus);
            }

            $listAllByDates = DB::select($arrivalsA->orderByRaw('DATE_FORMAT(date, "%y-%m-%d")')->toSql(), $arrivalsA->getBindings());

            $datePrmtr = date('d.m.Y', strtotime($searchDate));

            if (!empty($tpStatus)) {
                $datePrmtr = $datePrmtr . "  -  " . $tpStatus;
            }
           
            $data = array('listAllByDates' => $listAllByDates, 'tableTitle' => $datePrmtr . ' Tarihindeki Tüm Rezervasyonlar');
            return view('admin.reservations.all_reservation')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reservationCalendar()
    {
        try {
            $user = auth()->user();

            $calendarCount = Reservation::select('reservations.reservation_date as date', 'sources.id as sId', 'sources.source_color', 'sources.source_name', DB::raw('count(source_name) as countR'))
            ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
            ->whereNull('reservations.deleted_at')
            ->whereNotNull('reservations.source_id')
            // ->whereMonth('treatment_plans.created_date', Carbon::now()->month)
            ->groupBy(['date', 'sId']);

            $listCountByMonth = DB::select($calendarCount->groupBy(DB::raw('sId'))->toSql(),
            $calendarCount->getBindings());

            $data = array('listCountByMonth' => $listCountByMonth);
            return view('admin.reservations.reservation_calendar')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $reservation = Reservation::where('id','=', $id)->first();
            $services = Service::all();
            $therapists = Therapist::all();
            $customers = Customer::orderBy('customer_name', 'asc')->get();
            return view('admin.reservations.edit_reservation', ['reservation' => $reservation, 'services' => $services, 'therapists' => $therapists, 'customers' => $customers]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['reservation_date'] = $request->input('arrivalDate');
            $temp['reservation_time'] = $request->input('arrivalTime');
            $temp['total_customer'] = $request->input('totalCustomer');
            $temp['service_cost'] = $request->input('serviceCost');
            $temp['service_currency'] = $request->input('serviceCurrency');
            $temp['service_commission'] = $request->input('serviceComission');

            if ($updateSelectedData = Reservation::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/reservations/calendar')->with('message', 'Rezervasyon Başarıyla Güncellendi!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function download(Request $request, $id)
    {
        try {
            $reservation = Reservation::find($id);
            $data = array('reservation' => $reservation);

            $lang = $request->input('lang');

            switch ($lang) {
            case "en":
                return view('admin.reservations.languages.download_en')->with($data);
                break;
            case "de":
                return view('admin.reservations.languages.download_de')->with($data);
                break;
            case "fr":
                return view('admin.reservations.languages.download_fr')->with($data);
                break;
            case "it":
                return view('admin.reservations.languages.download_it')->with($data);
                break;
            case "es":
                return view('admin.reservations.languages.download_es')->with($data);
                break;
            case "tr":
                return view('admin.reservations.languages.download_tr')->with($data);
                break;
            case "ru":
                return view('admin.reservations.languages.download_ru')->with($data);
                break;
            case "pl":
                return view('admin.reservations.languages.download_pl')->with($data);
                break;
            case "pt":
                return view('admin.reservations.languages.download_tr')->with($data);
                break;
            case "ar":
                return view('admin.reservations.languages.download_tr')->with($data);
                break;
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        try {
            Reservation::find($id)->delete();
            return redirect('definitions/reservations')->with('message', 'Rezervasyon Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
