<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationCustomer;
use App\Models\Service;
use App\Models\Source;
use App\Models\Therapist;
use App\Models\Discount;
use App\Models\Customer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $reservations = Reservation::all();
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
            $data = array('reservations' => $reservations, 'services' => $services, 'sources' => $sources, 'therapists' => $therapists, 'customers' => $customers, 'discounts' => $discounts);
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
            $newReservation->service_id	= $request->input('serviceId');
            $newReservation->service_currency = $request->input('serviceCurrency');
            $newReservation->service_cost = $request->input('serviceCost');
            $newReservation->service_commission = $request->input('serviceComission');
            $newReservation->therapist_id = $request->input('therapistId');

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
            $newData->reservation_id = $request->input('reservation_id');
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

    public function destroy($id){
        try {
            Reservation::find($id)->delete();
            return redirect('definitions/reservations')->with('message', 'Reservation Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}