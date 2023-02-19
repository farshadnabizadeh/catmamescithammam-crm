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
            $newData->type_name = $request->input('name');
            $newData->note = $request->input('note');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('paymenttype.index')->with('message', 'Ödeme Türü Başarıyla Kaydedildi!');
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
            $result = $newData->save();

            if ($result) {
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
            $payment_type = PaymentType::where('id','=', $id)->first();
            return view('admin.payment_types.edit_payment_type', ['payment_type' => $payment_type]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['type_name'] = $request->input('name');
            $temp['note'] = $request->input('note');

            if (PaymentType::where('id', '=', $id)->update($temp)) {
                return redirect()->route('paymenttype.index')->with('message', 'Ödeme Türü Başarıyla Güncellendi!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        PaymentType::find($id)->delete();
        return redirect()->route('paymenttype.index')->with('message', 'Ödeme Türü Başarıyla Silindi!');
    }
}
