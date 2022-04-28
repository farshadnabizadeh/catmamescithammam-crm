<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $payment_types = PaymentType::all();
            $data = array('payment_types' => $payment_types);
            return view('admin.payment_types.payment_type_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new PaymentType();
            $newData->payment_type_name = $request->input('paymentTypeName');
            $newData->note = $request->input('note');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect('/definitions/payment_types')->with('message', 'Payment Type Added Successfully!');
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
