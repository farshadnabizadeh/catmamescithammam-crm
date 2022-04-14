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
            $contact_forms = ContactForm::orderBy('name_surname', 'asc')->get();
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
            $newData->customer_name = $request->input('customerName');
            $newData->customer_phone = $request->input('customerPhone');
            $newData->customer_country = $request->input('customerCountry');
            $newData->customer_email = $request->input('customerEmail');

            $newData->user_id = auth()->user()->id;
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
            $customer = Customer::where('id','=',$id)->first();
            return view('admin.customers.edit_customer', ['customer' => $customer]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name_surname'] = $request->input('patientName');
            $temp['phone_number'] = $request->input('patientPhone');
            $temp['email_address'] = $request->input('patientEmail');
            $temp['country'] = $request->input('patientCountry');
            $temp['birthdate'] = $request->input('patientBirthdate');
            $temp['sales_person_id'] = $request->input('salesPersonId');
            $temp['lead_source_id'] = $request->input('leadSourceId');
            $temp['gender'] = $request->input('gender');
            $temp['weight'] = $request->input('weight');
            $temp['height'] = $request->input('height');
            $temp['bmiValue'] = $request->input('bmiValue');
            $temp['is_cigarette'] = $request->input('is_cigarette');
            $temp['note'] = $request->input('note');

            if ($updateSelectedData = Patient::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/patients')->with('message', 'Patient Updated Successfully!');
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
            Form::find($id)->delete();
            return redirect('definitions/patients')->with('message', 'Patient Deleted Successfully!');  
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
