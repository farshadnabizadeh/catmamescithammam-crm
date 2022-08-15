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
use App\Models\Hotel;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Builder $builder)
    {
        try {
            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $storages = array('start' => $start, 'end' => $end);

            if (request()->ajax()) {
                $data = Reservation::with('customer', 'source')->orderBy('reservation_date', 'desc')->orderBy('reservation_time', 'desc')->whereBetween('reservations.reservation_date', [$start, $end]);
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        return '<div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/definitions/reservations/edit/'.$item->id.'" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Güncelle</a>
                                </li>
                                <li>
                                    <a href="/definitions/reservations/destroy/'.$item->id.'" onclick="return confirm(Are you sure?);" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a>
                                </li>
                                <li>
                                    <a href="/definitions/reservations/download/'.$item->id.'?lang=en" class="btn btn-success edit-btn"><i class="fa fa-download"></i> İndir</a>
                                </li>
                            </ul>
                        </div>';
                    })
                    ->editColumn('id', function ($item) {
                        $action = date('ymd', strtotime($item->created_at)) . $item->id;
                        return $action;
                    })
                    ->editColumn('source.name', function ($item) {
                        return '<span class="badge text-white" style="background-color: '. $item->source->color .'">'. $item->source->name .'</span>';
                    })
                    ->editColumn('reservation_date', function ($item) {
                        $action = date('d-m-Y', strtotime($item->reservation_date));
                        return $action;
                    })

                    ->rawColumns(['action', 'id', 'source.name', 'date'])
                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'source.name', 'name' => 'source.name', 'title' => 'Kaynak'],
                    ['data' => 'reservation_date', 'name' => 'reservation_date', 'title' => 'Rezervasyon Tarihi'],
                    ['data' => 'reservation_time', 'name' => 'reservation_time', 'title' => 'Rezervasyon Saati'],
                    ['data' => 'customer.name_surname', 'name' => 'customer.name_surname', 'title' => 'Müşteri Adı'],
                    ['data' => 'total_customer', 'name' => 'total_customer', 'title' => 'Kişi Sayısı'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.reservations.reservations_list', compact('html'))->with($storages);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        try {
            $reservations = Reservation::all();
            $services = Service::orderBy('name', 'asc')->get();
            $sources = Source::orderBy('name', 'asc')->get();
            $therapists = Therapist::orderBy('name', 'asc')->get();
            $customers = Customer::orderBy('name_surname', 'asc')->get();
            $discounts = Discount::orderBy('name', 'asc')->get();
            $payment_types = PaymentType::orderBy('type_name', 'asc')->get();
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
            $newData = new Reservation();
            $newData->reservation_date = $request->input('arrivalDate');
            $newData->reservation_time = $request->input('arrivalTime');
            $newData->total_customer = $request->input('totalCustomer');
            $newData->customer_id = $request->input('customerId');
            $newData->discount_id = $request->input('discountId');
            $newData->source_id = $request->input('sourceId');
            $newData->reservation_note = $request->input('reservationNote');

            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return response($newData->id, 200);
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

            $arrivalsA = Reservation::select('reservations.reservation_date as date', 'reservations.*', 'reservations.id as tId',  'sources.color', 'sources.name', 'customers.name_surname as Cname')
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

            $calendarCount = Reservation::select('reservations.reservation_date as date', 'reservations.reservation_time as time', 'sources.id as sId', 'sources.color', 'sources.name', DB::raw('count(name) as countR'))
            ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
            ->whereNull('reservations.deleted_at')
            ->whereNotNull('reservations.source_id')
            // ->whereMonth('treatment_plans.created_date', Carbon::now()->month)
            ->groupBy(['date', 'time', 'sId']);

            $listCountByMonth = DB::select($calendarCount->groupBy(DB::raw('sId'))->toSql(),
            $calendarCount->getBindings());

            $data = array('listCountByMonth' => $listCountByMonth);
            return view('admin.reservations.reservation_calendar')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $reservation = Reservation::where('id','=', $id)->first();
            $services = Service::orderBy('name', 'asc')->get();
            $therapists = Therapist::orderBy('name', 'asc')->get();
            $payment_types = PaymentType::all();
            $hotels = Hotel::all();
            $sources = Source::all();

            $reservation_payment_type = ReservationPaymentType::where('reservations_payments_types.reservation_id', '=', $id);

            $hasPaymentType = false;
            $hasPaymentType = $reservation_payment_type->get()->count() > 0 ? true : false;

            $reservation_service = ReservationService::where('reservations_services.reservation_id', '=', $id);
            $hasService = false;
            $hasService = $reservation_service->get()->count() > 0 ? true : false;

            $reservation_therapist = ReservationTherapist::where('reservations_therapists.reservation_id', '=', $id);
            $hasTherapist = false;
            $hasTherapist = $reservation_therapist->get()->count() > 0 ? true : false;

            $totalPrice = [];

            foreach($reservation->subPaymentTypes as $subPaymentType) {
                array_push($totalPrice, $subPaymentType->payment_price);
            }
            $totalPayment = array_sum($totalPrice);

            $data = array('reservation' => $reservation, 'services' => $services, 'sources' => $sources, 'therapists' => $therapists, 'payment_types' => $payment_types, 'hasPaymentType' => $hasPaymentType, 'hasService' => $hasService, 'hasTherapist' => $hasTherapist, 'totalPayment' => $totalPayment, 'hotels' => $hotels);

            $page = $request->input('page');

            if($page == "payments"){
                return view('admin.reservations.payment_reservation')->with($data);
            }
            else {
                return view('admin.reservations.edit_reservation')->with($data);
            }

        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editPaymentType($id)
    {
        try {
            $reservation_payment_type = ReservationPaymentType::where('id','=', $id)->first();
            $payment_types = PaymentType::all();
            return view('admin.reservations.edit_payment_type', ['reservation_payment_type' => $reservation_payment_type, 'payment_types' => $payment_types]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editService($id)
    {
        try {
            $reservation_service = ReservationService::where('id','=', $id)->first();
            $services = Service::orderBy('name', 'asc')->get();
            return view('admin.reservations.edit_service', ['reservation_service' => $reservation_service, 'services' => $services]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editTherapist($id)
    {
        try {
            $reservation_therapist = ReservationTherapist::where('id','=', $id)->first();
            $therapists = Therapist::orderBy('name', 'asc')->get();
            return view('admin.reservations.edit_therapist', ['reservation_therapist' => $reservation_therapist, 'therapists' => $therapists]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['reservation_date'] = $request->input('reservationDate');
            $temp['reservation_time'] = $request->input('reservationTime');
            $temp['total_customer'] = $request->input('totalCustomer');
            $temp['source_id'] = $request->input('sourceId');
            $temp['reservation_note'] = $request->input('note');

            if (Reservation::where('id', '=', $id)->update($temp)) {
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

    public function updatePaymentType(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['payment_type_id'] = $request->input('paymentTypeId');
            $temp['payment_price'] = $request->input('paymentPrice');

            if (ReservationPaymentType::where('id', '=', $id)->update($temp)) {
                return back()->with('message', 'Ödeme Türü Başarıyla Güncellendi!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateService(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['service_id'] = $request->input('serviceId');
            $temp['piece'] = $request->input('piece');

            if (ReservationService::where('id', '=', $id)->update($temp)) {
                return back()->with('message', 'Hizmet Başarıyla Güncellendi!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateTherapist(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['therapist_id'] = $request->input('therapistId');
            $temp['piece'] = $request->input('piece');

            if (ReservationTherapist::where('id', '=', $id)->update($temp)) {
                return back()->with('message', 'Terapist Başarıyla Güncellendi!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroyPaymentType($id){
        try {
            ReservationPaymentType::find($id)->delete();
            return back()->with('message', 'Ödeme Türü Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroyService($id){
        try {
            ReservationService::find($id)->delete();
            return back()->with('message', 'Hizmet Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroyTherapist($id){
        try {
            ReservationTherapist::find($id)->delete();
            return back()->with('message', 'Terapist Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function download(Request $request, $id)
    {
        try {
            $reservation = Reservation::find($id);
            $lang = $request->input('lang');
            $totalPrice = [];
            foreach ($reservation->subServices as $subService) {
                array_push($totalPrice, $subService->cost * $subService->piece);
            }
            $total = array_sum($totalPrice);

            $data = array('reservation' => $reservation, 'total' => $total);

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
            return back()->with('message', 'Rezervasyon Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
