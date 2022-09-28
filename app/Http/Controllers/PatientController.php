<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\LeadSource;
use App\Models\Country;
use Auth;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\User;
class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Builder $builder)
    {
        try {
            $user = auth()->user();

            if (request()->ajax()) {
                $data = Patient::with('leadsource', 'country')
                ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                    $query->where('patients.user_id', '=', $user->id);
                })
                ->orderBy('created_at', 'desc');
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        $param = '<div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="'.route('patient.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a>
                                </li>
                                <li>
                                    <a href="'.route('patient.destroy', ['id' => $item->id]).'" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a>
                                </li>
                            </ul>
                        </div>';
                        return $param;
                    })
                    ->editColumn('id', function ($item) {
                        $param = date('ymd', strtotime($item->created_date)) . $item->id;
                        return $param;
                    })
                    ->editColumn('name_surname', function ($item) {
                        if($item->gender == "Male"){
                            return '<a href="'.route('patient.edit', ['id' => $item->id]).'"><i class="fa fa-male"></i> '.$item->name_surname.'</a>';
                        }
                        if($item->gender == "Female"){
                            return '<a href="'.route('patient.edit', ['id' => $item->id]).'"><i class="fa fa-female"></i> '.$item->name_surname.'</a>';
                        }
                        else {
                            return '<a href="'.route('patient.edit', ['id' => $item->id]).'">'.$item->name_surname.'</a>';
                        }
                    })
                    ->rawColumns(['action', 'id', 'name_surname'])
                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'leadsource.name', 'name' => 'leadsource.name', 'title' => 'Lead Source'],
                    ['data' => 'name_surname', 'name' => 'name_surname', 'title' => 'Name'],
                    ['data' => 'phone_number', 'name' => 'phone_number', 'title' => 'Phone Number'],
                    ['data' => 'age', 'name' => 'age', 'title' => 'Age'],
                    ['data' => 'gender', 'name' => 'gender', 'title' => 'Gender'],
                    ['data' => 'email_address', 'name' => 'email_address', 'title' => 'Email Address'],
                    ['data' => 'country.name', 'name' => 'country.name', 'title' => 'Country'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.patients.patients_list', compact('html'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        try {
            $lead_sources = LeadSource::orderBy('name', 'asc')->get();
            $data = array('lead_sources' => $lead_sources);
            return view('admin.patients.new_patient')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Patient();
            $newData->lead_source_id = $request->input('leadSourceId');
            $newData->name_surname = $request->input('name');
            $newData->phone_number = $request->input('phone');
            $newData->email_address = $request->input('email');
            $newData->country_id = $request->input('countryId');
            $newData->age = $request->input('age');
            $newData->gender = $request->input('gender');
            $newData->note = $request->input('note');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return response()->json($newData->id);
            } else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createPatient(Request $request)
    {
       try {
            $newData = new Patient();
            $newData->lead_source_id = $request->input('leadSourceId');
            $newData->name_surname = $request->input('name');
            $newData->phone_number = $request->input('phone');
            $newData->email_address = $request->input('email');
            $newData->country_id = $request->input('countryId');
            $newData->age = $request->input('age');
            $newData->gender = $request->input('gender');
            $newData->note = $request->input('note');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('patient.index')->with('message', 'New Patient Added Successfully!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $patient = Patient::where('id','=',$id)->first();
            $lead_sources = LeadSource::orderBy('name', 'asc')->get();
            $countries = Country::orderBy('name', 'asc')->get();

            return view('admin.patients.edit_patient', ['patient' => $patient, 'lead_sources' => $lead_sources, 'countries' => $countries]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['lead_source_id'] = $request->input('leadSourceId');
            $temp['name_surname'] = $request->input('name');
            $temp['phone_number'] = $request->input('phone');
            $temp['age'] = $request->input('age');
            $temp['email_address'] = $request->input('email');
            $temp['country_id'] = $request->input('countryId');
            $temp['gender'] = $request->input('gender');
            $temp['note'] = $request->input('note');

            if (Patient::where('id', '=', $id)->update($temp)) {
                return redirect()->route('patient.index')->with('message', 'Patient Updated Successfully!');
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
            Patient::find($id)->delete();
            return redirect()->route('patient.index')->with('message', 'Patient Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
