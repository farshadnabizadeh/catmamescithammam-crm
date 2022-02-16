<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $forms = Form::orderBy('name_surname', 'asc')->get();
        $data = array('forms' => $forms);
        return view('admin.forms.forms_list')->with($data);
    }

    public function store(Request $request)
    {
        $newForm = new Form();
        $newForm->customer_name = $request->input('customerName');
        $newForm->customer_phone = $request->input('customerPhone');
        $newForm->customer_country = $request->input('customerCountry');
        $newForm->customer_email = $request->input('customerEmail');

        $newForm->user_id = auth()->user()->id;
        $result = $newForm->save();

        if ($result) {
            return response($newForm->id, 200);
        }
        else {
            return response(false, 500);
        }
    }

    public function edit($id)
    {
        $customer = Customer::where('id','=',$id)->first();

        //$data = $patient->requestTreatments()->get();
        //dd($data->first()->subTreatment->treatment_name);
        return view('admin.customers.edit_customer', ['customer' => $customer]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

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

    public function destroy($id){
        Patient::find($id)->delete();
        return redirect('definitions/patients')->with('message', 'Patient Deleted Successfully!');
    }
}
