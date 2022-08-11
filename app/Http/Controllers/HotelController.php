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
            $hotels = Hotel::orderBy('name', 'asc')->get();
            $data = array('hotels' => $hotels);
            return view('admin.hotels.hotels_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Hotel();
            $newData->name = $request->input('hotelName');
            $newData->phone = $request->input('hotelPhone');
            $newData->person = $request->input('hotelPerson');
            $newData->person_account_number = $request->input('hotelPersonAccountNumber');

            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result){
                return redirect('/definitions/hotels')->with('message', 'Otel Başarıyla Kaydedildi!');
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

            $temp['name'] = $request->input('hotelName');
            $temp['phone'] = $request->input('hotelPhone');
            $temp['person'] = $request->input('hotelPerson');
            $temp['person_account_number'] = $request->input('hotelPersonAccountNumber');

            if (Hotel::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/hotels')->with('message', 'Otel Başarıyla Güncellendi!');
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
            return redirect('definitions/hotels')->with('message', 'Otel Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
