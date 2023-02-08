<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp;
use App\Models\Country;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $whatsapps = Whatsapp::all();
            $countries = Country::orderBy('name', 'asc')->get();
            $data      = array('whatsapps' => $whatsapps,'countries' => $countries);
            return view('admin.whatsapps.whatsapp_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Whatsapp();
            $newData->name_surname  = $request->input('name_surname');
            $newData->phone         = $request->input('phone');
            $newData->email         = $request->input('email');
            $newData->country       = $request->input('country');
            $newData->note          = $request->input('note');
            $newData->user_id       = auth()->user()->id;
            $result                 = $newData->save();

            if ($result) {
                return redirect()->route('whatsapp.index')->with('message', 'Whatsapp Numara Başarıyla Kaydedildi!');
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
            $whatsapp = Whatsapp::where('id','=', $id)->first();
            $countries = Country::where('name','!=', $whatsapp->country)->get();
            $data      = array('whatsapp' => $whatsapp,'countries' => $countries);

            return view('admin.whatsapps.edit_whatsapp')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name_surname'] = $request->input('name_surname');
            $temp['phone'] = $request->input('phone');
            $temp['email'] = $request->input('email');
            $temp['country'] = $request->input('country');
            $temp['note'] = $request->input('note');

            if (Whatsapp::where('id', '=', $id)->update($temp)) {
                return redirect()->route('whatsapp.index')->with('message', 'Whatsapp Numara Başarıyla Güncellendi!');
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
            Whatsapp::find($id)->delete();
            return redirect()->route('whatsapp.index')->with('message', 'Whatsapp Numara Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
