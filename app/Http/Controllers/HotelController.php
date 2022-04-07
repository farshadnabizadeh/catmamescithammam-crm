<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Source;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $hotels = Hotel::orderBy('hotel_name', 'asc')->get();
            $sources = Source::orderBy('source_name', 'asc')->get();
            $data = array('hotels' => $hotels, 'sources' => $sources);
            return view('admin.hotels.hotels_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newHotel = new Hotel();
            $newHotel->hotel_name = $request->input('hotelName');
            $newHotel->hotel_phone = $request->input('hotelPhone');
            $newHotel->hotel_person = $request->input('hotelPerson');
            $newHotel->hotel_person_account_number = $request->input('hotelPersonAccountNumber');
            $newHotel->hotel_person_send_amount = $request->input('hotelPersonSendAmount');

            $newHotel->user_id = auth()->user()->id;
            $result = $newHotel->save();

            if ($result){
                return redirect('/definitions/hotels')->with('message', 'Hotel Added Successfully!');
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
        $hotel = Hotel::where('id','=',$id)->first();
        $sources = Source::orderBy('source_name', 'asc')->get();

        return view('admin.hotels.edit_hotel', ['hotel' => $hotel, 'sources' => $sources]);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['customer_name'] = $request->input('customerName');
            $temp['customer_phone'] = $request->input('customerPhone');
            $temp['customer_country'] = $request->input('customerCountry');
            $temp['customer_email'] = $request->input('customerEmail');
            $temp['customer_sob_id'] = $request->input('customerSobId');

            if ($updateSelectedData = Customer::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/customers')->with('message', 'Customer Updated Successfully!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        try {
            $customers = Customer::where('id', '=', $id)->delete();
            return redirect('definitions/customers')->with('message', 'Customer Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
