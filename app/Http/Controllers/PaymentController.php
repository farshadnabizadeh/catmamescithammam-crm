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

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $payments = Reservation::all();
            $services = Service::orderBy('service_name', 'asc')->get();
            $sources = Source::orderBy('source_name', 'asc')->get();
            $therapists = Therapist::orderBy('therapist_name', 'asc')->get();
            $customers = Customer::orderBy('customer_name', 'asc')->get();
            $sources = Source::orderBy('source_name', 'asc')->get();
            $data = array('payments' => $payments, 'services' => $services, 'sources' => $sources, 'therapists' => $therapists, 'customers' => $customers, 'sources' => $sources);
            return view('admin.payments.payments_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newReservation = new Reservation();
            $newReservation->reservation_date = date('Y/m/d');
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