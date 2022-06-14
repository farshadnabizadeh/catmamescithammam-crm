<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ContactFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $contact_forms = ContactForm::orderBy('created_at', 'desc')->get();
            $data = array('contact_forms' => $contact_forms);
            return view('admin.contactforms.contactforms_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new ContactForm();
            $newData->name_surname = $request->input('name_surname');
            $newData->phone = $request->input('phone');
            $newData->country = $request->input('country');
            $newData->email = $request->input('email');
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
            $contact_form = ContactForm::where('id','=',$id)->first();
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

            if ($updateSelectedData = ContactForm::where('id', '=', $id)->update($temp)) {
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
