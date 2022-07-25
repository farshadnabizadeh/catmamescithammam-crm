<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Source;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
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
        try {
            $hotel = Hotel::where('id','=',$id)->first();

            return view('admin.hotels.edit_hotel', ['hotel' => $hotel]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['hotel_name'] = $request->input('hotelName');
            $temp['hotel_phone'] = $request->input('hotelPhone');
            $temp['hotel_person'] = $request->input('hotelPerson');
            $temp['hotel_person_account_number'] = $request->input('hotelPersonAccountNumber');
            $temp['hotel_person_send_amount'] = $request->input('hotelPersonSendAmount');

            if ($updateSelectedData = Hotel::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/hotels')->with('message', 'Hotel Updated Successfully!');
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
            Hotel::where('id', '=', $id)->delete();
            return redirect('definitions/hotels')->with('message', 'Hotel Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
