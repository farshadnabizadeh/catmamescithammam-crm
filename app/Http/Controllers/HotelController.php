<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
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

    public function getHotels()
    {
        try {
            $hotels = Hotel::all();

            $output = [];
            foreach ($hotels as $hotel) {
                $output[$hotel->id] = $hotel->name;
            }

            return json_encode($output);

        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Hotel();
            $newData->name = $request->input('name');
            $newData->phone = $request->input('phone');
            $newData->person = $request->input('person');
            $newData->person_account_number = $request->input('personAccountNumber');

            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result){
                return redirect()->route('hotel.index')->with('message', 'Otel Başarıyla Kaydedildi!');
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
        return view('admin.hotels.edit_hotel', ['hotel' => $hotel]);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['name'] = $request->input('name');
            $temp['phone'] = $request->input('phone');
            $temp['person'] = $request->input('person');
            $temp['person_account_number'] = $request->input('personAccountNumber');

            if (Hotel::where('id', '=', $id)->update($temp)) {
                return redirect()->route('hotel.index')->with('message', 'Otel Başarıyla Güncellendi!');
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
        Hotel::where('id', '=', $id)->delete();
        return redirect()->route('hotel.index')->with('message', 'Otel Başarıyla Silindi!');
    }
}
