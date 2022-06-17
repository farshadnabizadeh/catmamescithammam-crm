<?php

namespace App\Http\Controllers;

use App\Models\BookingForm;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BookingFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $booking_forms = BookingForm::orderBy('created_at', 'desc')->get();
            $data = array('booking_forms' => $booking_forms);
            return view('admin.bookingforms.bookingforms_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new BookingForm();
            $newData->reservation_date = $request->input('reservation_date');
            $newData->reservation_time = $request->input('reservation_time');
            $newData->name_surname = $request->input('name_surname');
            $newData->phone = $request->input('phone');
            $newData->country = $request->input('country');
            $newData->massage_package = $request->input('massage_package');
            $newData->hammam_package = $request->input('hammam_package');
            $newData->male_pax = $request->input('male_pax');
            $newData->female_pax = $request->input('female_pax');
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

    public function edit($id)
    {
        try {
            $contact_form = BookingForm::where('id','=',$id)->first();
            return view('admin.contactforms.edit_contactform', ['contact_form' => $contact_form]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name_surname'] = $request->input('name_surname');
            $temp['phone_number'] = $request->input('phone');
            $temp['country'] = $request->input('country');
            $temp['email'] = $request->input('email');

            if ($updateSelectedData = BookingForm::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/contactforms')->with('message', 'İletişim Formu Başarıyla Güncellendi!');
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
            ContactForm::find($id)->delete();
            return redirect('definitions/contactforms')->with('message', 'İletişim Formu Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
