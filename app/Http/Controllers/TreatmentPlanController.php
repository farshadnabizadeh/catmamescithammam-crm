<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TreatmentPlan;
use App\Models\Patient;
use App\Models\SalesPerson;
use App\Models\LeadSource;
use App\Models\Treatment;
use App\Models\TreatmentPlanStatus;
use App\Models\TreatmentPlanPhoto;
use App\Models\Country;
use Auth;
use Mail;
use App\Mail\RequestMail;
use App\Mail\NotificationMail;
use Carbon\Carbon;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $newData = new TreatmentPlan();
            $newData->created_date = date('Y-m-d');
            $newData->patient_id = $request->input('patient_id');
            $newData->treatment_id = $request->input('treatment_id');
            $newData->sales_person_id = $request->input('sales_person_id');
            $newData->doctor_id = $request->input('doctor_id');
            $newData->duration_of_stay = $request->input('duration_of_stay');
            $newData->hospitalization = $request->input('hospitalization');
            $newData->total_price = $request->input('total_price');
            $newData->price_currency = $request->input('price_currency');
            $newData->is_asthma = $request->input('is_asthma');
            $newData->is_diabetes = $request->input('is_diabetes');
            $newData->is_hyper_tension = $request->input('is_hyper_tension');
            $newData->is_breathing_problem = $request->input('is_breathing_problem');
            $newData->is_chronic_illness = $request->input('is_chronic_illness');
            $newData->is_hiv = $request->input('is_hiv');
            $newData->is_stroke = $request->input('is_stroke');
            $newData->is_hepatitis = $request->input('is_hepatitis');
            $newData->is_cancer = $request->input('is_cancer');
            $newData->is_sickle = $request->input('is_sickle');
            $newData->is_anaemia = $request->input('is_anaemia');
            $newData->is_kidney_problem = $request->input('is_kidney_problem');
            $newData->is_smoking = $request->input('is_smoking');
            $newData->is_alcohol = $request->input('is_alcohol');
            $newData->is_allergie = $request->input('is_allergie');
            $newData->is_surgery_history = $request->input('is_surgery_history');
            $newData->is_covid_vaccine = $request->input('is_covid_vaccine');
            $newData->weight = $request->input('weight');
            $newData->weight_unit = $request->input('weight_unit');
            $newData->height = $request->input('height');
            $newData->height_unit = $request->input('height_unit');
            $newData->note = $request->input('note');
            $newData->medical_department_id = "1";
            $newData->medical_sub_department_id = "1";
            $newData->treatment_plan_status_id = "1";
            $newData->user_id = $user->id;
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

    public function sendNotification(Request $request)
    {
        try {

            $treatment_plan_id = $request->input('treatment_plan_id');
            $message = $request->input('message');

            $body = [
                'treatment_plan_id' => $treatment_plan_id,
                'message' => $message
            ];

            Mail::to(['ceyhun.aydogan@outlook.com', 'ucar@ceyhunaydogan.com'])->send(new NotificationMail($body));

            if (Mail::failures()) {
                return response()->Fail('Sorry! Please try again latter');
            }
            else {
                return back()->with('message', 'Send Notification Successfully!');
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(Builder $builder)
    {
        try {

            $sales_persons = SalesPerson::all();

            $doctors = User::with("roles")->whereHas("roles", function($q) {
                $q->whereIn("id", [4]);
            })->get();

            $countries = Country::all();
            $treatments = Treatment::orderBy('name_en', 'asc')->get();
            $lead_sources = LeadSource::all();
            $data = array('sales_persons' => $sales_persons, 'lead_sources' => $lead_sources, 'doctors' => $doctors, 'treatments' => $treatments, 'countries' => $countries);

            $user = auth()->user();
            if (request()->ajax()) {
                $data = Patient::with('leadsource', 'country')
                ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                    $query->where('patients.user_id', '=', $user->id);
                });
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        $param = '<button type="button" class="btn btn-success action-btn create-registered-customer-reservation" id="'.$item->id.'" data-name="'.$item->name_surname.'"><i class="fa fa-check"></i> Choose</button>';
                        return $param;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false],
                    ['data' => 'leadsource.name', 'name' => 'leadsource.name', 'title' => 'Lead Source'],
                    ['data' => 'name_surname', 'name' => 'name_surname', 'title' => 'Name'],
                    ['data' => 'phone_number', 'name' => 'phone_number', 'title' => 'Phone Number'],
                    ['data' => 'age', 'name' => 'age', 'title' => 'Age'],
                    ['data' => 'gender', 'name' => 'gender', 'title' => 'Gender'],
                    ['data' => 'country.name', 'name' => 'country.name', 'title' => 'Country'],
                    ['data' => 'email_address', 'name' => 'email_address', 'title' => 'Email Address'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

                return view('admin.treatmentplans.create_treatmentplan', compact('html'))->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function requested(Builder $builder)
    {
        try {
            $user = auth()->user();
                if (request()->ajax()) {
                    $data = TreatmentPlan::with('status', 'patient', 'treatment', 'salesperson')
                    ->where('treatment_plan_status_id', '1')
                    ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                        $query->where('treatment_plans.user_id', '=', $user->id);
                    })
                    ->when($user->hasRole('Doctor'), function ($query) use ($user) {
                        $query->where('treatment_plans.doctor_id', '=', $user->id);
                    })
                    ->whereNull('treatment_plans.arrival_date')
                    ->orderBy('created_date', 'desc');
                    return DataTables::of($data)
                        ->editColumn('action', function ($item, User $user) {
                            $action = '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="'.route('treatmentplan.edit', ['id' => $item->id]).'" class="btn btn-success treatmentplan-next-btn">Complete TP <i class="fa fa-chevron-right"></i></a>
                                    </li>
                                    <li>
                                    <a href="'.route('treatmentplan.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a>
                                </li>
                                <li>
                                    <a href="'.route('treatmentplan.destroy', ['id' => $item->id]).'" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a>
                                </li>
                            </ul>
                        </div>';
                        return $action;
                    })
                    ->editColumn('id', function ($item) {
                        $action = date('ymd', strtotime($item->created_at)) . $item->patient->id . $item->id;
                        return $action;
                    })
                    ->editColumn('status.name', function ($item) {
                        $url = '<span class="badge badge-danger">'.$item->status->name.'</span>';
                        return $url;
                    })
                    ->editColumn('patient.name_surname', function ($item) {
                        if($item->patient->gender == "Male"){
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'"><i class="fa fa-male"></i> '.$item->patient->name_surname.'</a>';
                        }
                        if($item->patient->gender == "Female"){
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'"><i class="fa fa-female"></i> '.$item->patient->name_surname.'</a>';
                        }
                        else {
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'">'.$item->patient->name_surname.'</a>';
                        }
                    })
                    ->editColumn('height', function ($item) {
                        $url = $item->height . ' ' . $item->height_unit;
                        return $url;
                    })
                    ->editColumn('weight', function ($item) {
                        $url = $item->weight . ' ' . $item->weight_unit;
                        return $url;
                    })
                    ->editColumn('is_alcohol', function ($item) {
                        if ($item->is_alcohol == "yes"){
                            return '<p class="text-center"><i class="fa fa-check check-icon"></i></p>';
                        }
                        else {
                            return '<p class="text-center"><i class="fa fa-times non-icon"></i></p>';
                        }
                    })
                    ->editColumn('is_smoking', function ($item) {
                        if ($item->is_smoking == "yes"){
                            return '<p class="text-center"><i class="fa fa-check check-icon"></i></p>';
                        }
                        else {
                            return '<p class="text-center"><i class="fa fa-times non-icon"></i></p>';
                        }
                    })
                    ->rawColumns(['action', 'id', 'status.name', 'patient.name_surname', 'is_alcohol', 'is_smoking'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status.name', 'name' => 'status.name', 'title' => 'Status'],
                    ['data' => 'patient.name_surname', 'name' => 'patient.name_surname', 'title' => 'Patient'],
                    ['data' => 'treatment.name_en', 'name' => 'treatment.name_en', 'title' => 'Treatment'],
                    ['data' => 'salesperson.name_surname', 'name' => 'salesperson.name_surname', 'title' => 'Sales Person'],
                    ['data' => 'patient.age', 'name' => 'patient.age', 'title' => 'Age'],
                    ['data' => 'height', 'name' => 'height', 'title' => 'Height'],
                    ['data' => 'weight', 'name' => 'weight', 'title' => 'Weight'],
                    ['data' => 'is_alcohol', 'name' => 'is_alcohol', 'title' => 'Alcohol'],
                    ['data' => 'is_smoking', 'name' => 'is_smoking', 'title' => 'Smoking'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);
    
            return view('admin.treatmentplans.requested', compact('html'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reconsult(Builder $builder)
    {
        try {
            $user = auth()->user();
            if (request()->ajax()) {
                $data = TreatmentPlan::with('status', 'patient', 'treatment', 'salesperson')
                ->where('treatment_plan_status_id', '3')
                ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                    $query->where('treatment_plans.user_id', '=', $user->id);
                })
                ->when($user->hasRole('Doctor'), function ($query) use ($user) {
                    $query->where('treatment_plans.doctor_id', '=', $user->id);
                })
                ->whereNull('treatment_plans.arrival_date')
                ->orderBy('created_date', 'desc');
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        $action = '<div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="'.route('treatmentplan.edit', ['id' => $item->id]).'" class="btn btn-success treatmentplan-next-btn">Complete TP <i class="fa fa-chevron-right"></i></a>
                                </li>
                                <li>
                                    <a href="'.route('treatmentplan.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a>
                                </li>
                                <li>
                                    <a href="'.route('treatmentplan.destroy', ['id' => $item->id]).'" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a>
                                </li>
                            </ul>
                        </div>';
                        return $action;
                    })
                    ->editColumn('id', function ($item) {
                        $action = date('ymd', strtotime($item->created_at)) . $item->patient->id . $item->id;
                        return $action;
                    })
                    ->editColumn('status.name', function ($item) {
                        $url = '<span class="badge badge-warning">'.$item->status->name.'</span>';
                        return $url;
                    })
                    ->editColumn('patient.name_surname', function ($item) {
                        if($item->patient->gender == "Male"){
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'"><i class="fa fa-male"></i> '.$item->patient->name_surname.'</a>';
                        }
                        if($item->patient->gender == "Female"){
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'"><i class="fa fa-female"></i> '.$item->patient->name_surname.'</a>';
                        }
                        else {
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'">'.$item->patient->name_surname.'</a>';
                        }
                    })
                    ->editColumn('height', function ($item) {
                        $url = $item->height . ' ' . $item->height_unit;
                        return $url;
                    })
                    ->editColumn('weight', function ($item) {
                        $url = $item->weight . ' ' . $item->weight_unit;
                        return $url;
                    })
                    ->editColumn('is_alcohol', function ($item) {
                        if ($item->is_alcohol == "yes"){
                            return '<p class="text-center"><i class="fa fa-check check-icon"></i></p>';
                        }
                        else {
                            return '<p class="text-center"><i class="fa fa-times non-icon"></i></p>';
                        }
                    })
                    ->editColumn('is_smoking', function ($item) {
                        if ($item->is_smoking == "yes"){
                            return '<p class="text-center"><i class="fa fa-check check-icon"></i></p>';
                        }
                        else {
                            return '<p class="text-center"><i class="fa fa-times non-icon"></i></p>';
                        }
                    })
                    ->rawColumns(['action', 'id', 'status.name', 'patient.name_surname', 'is_alcohol', 'is_smoking'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status.name', 'name' => 'status.name', 'title' => 'Status'],
                    ['data' => 'patient.name_surname', 'name' => 'patient.name_surname', 'title' => 'Patient'],
                    ['data' => 'treatment.name_en', 'name' => 'treatment.name_en', 'title' => 'Treatment'],
                    ['data' => 'salesperson.name_surname', 'name' => 'salesperson.name_surname', 'title' => 'Sales Person'],
                    ['data' => 'patient.age', 'name' => 'patient.age', 'title' => 'Age'],
                    ['data' => 'height', 'name' => 'height', 'title' => 'Height'],
                    ['data' => 'weight', 'name' => 'weight', 'title' => 'Weight'],
                    ['data' => 'is_alcohol', 'name' => 'is_alcohol', 'title' => 'Alcohol'],
                    ['data' => 'is_smoking', 'name' => 'is_smoking', 'title' => 'Smoking'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.treatmentplans.reconsult', compact('html'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function completed(Builder $builder)
    {
        try {
            $user = auth()->user();
                if (request()->ajax()) {
                    $data = TreatmentPlan::with('status', 'patient', 'treatment', 'salesperson')
                    ->where('treatment_plan_status_id', '2')
                    ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                        $query->where('treatment_plans.user_id', '=', $user->id);
                    })
                    ->when($user->hasRole('Doctor'), function ($query) use ($user) {
                        $query->where('treatment_plans.doctor_id', '=', $user->id);
                    })
                    ->whereNull('treatment_plans.arrival_date')
                    ->orderBy('created_date', 'desc');
                    return DataTables::of($data)
                        ->editColumn('action', function ($item) {
                            if($item->is_suitable == 0){
                                return '<div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="'.route('treatmentplan.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a>
                                        </li>
                                        <li>
                                            <a href="'.route('treatmentplan.edit', ['id' => $item->id]).'?page=doctor_recommended" class="btn btn-primary edit-btn">View Doctor Result <i class="fa fa-arrow-right"></i></a>
                                        </li>
                                    </ul>
                                </div>';
                            }
                            else if($item->is_suitable == 1){
                                return '<div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="'.route('treatmentplan.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a>
                                        </li>
                                        <li>
                                            <a href="'.route('treatmentplan.destroy', ['id' => $item->id]).'" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a>
                                        </li>
                                        <li>
                                            <a href="/treatmentplans/download/'.$item->id.'?lang=en&theme=1" class="btn btn-success edit-btn"><i class="fa fa-download"></i> Download</a>
                                        </li>
                                        <li>
                                            <a href="'.route('treatmentplan.edit', ['id' => $item->id]).'?page=doctor_recommended" class="btn btn-primary edit-btn">View Doctor Result <i class="fa fa-arrow-right"></i></a>
                                        </li>
                                        <li>
                                            <a data-toggle="modal" data-target="#ticketReceived" class="btn btn-warning edit-btn received-btn" id="'.$item->id. '"><i class="fa fa-check"></i> Ticket Received</a>
                                        </li>
                                    </ul>
                                </div>';
                            }
                        })
                        ->editColumn('id', function ($item) {
                            $param = date('ymd', strtotime($item->created_at)) . $item->patient->id . $item->id;
                            return $param;
                        })
                        ->editColumn('status.name', function ($item) {
                            $url = '<span class="badge badge-success">'.$item->status->name.'</span>';
                            return $url;
                        })
                        ->editColumn('is_suitable', function ($item) {
                            if($item->is_suitable == 1){
                                return '<p class="text-center"><i class="fa fa-check check-icon"></i></p>';
                            }
                            else {
                                return '<p class="text-center"><i class="fa fa-times non-icon"></i></p>';
                            }
                        })
                        ->editColumn('patient.name_surname', function ($item) {
                            if($item->patient->gender == "Male"){
                                return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'"><i class="fa fa-male"></i> '.$item->patient->name_surname.'</a>';
                            }
                            if($item->patient->gender == "Female"){
                                return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'"><i class="fa fa-female"></i> '.$item->patient->name_surname.'</a>';
                            }
                            else {
                                return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'">'.$item->patient->name_surname.'</a>';
                            }
                        })
                        ->editColumn('height', function ($item) {
                            return $item->height . ' ' . $item->height_unit;
                        })
                        ->editColumn('weight', function ($item) {
                            return $item->weight . ' ' . $item->weight_unit;
                        })
                        ->editColumn('is_alcohol', function ($item) {
                            if ($item->is_alcohol == "yes"){
                                return '<p class="text-center"><i class="fa fa-check check-icon"></i></p>';
                            }
                            else {
                                return '<p class="text-center"><i class="fa fa-times non-icon"></i></p>';
                            }
                        })
                        ->editColumn('is_smoking', function ($item) {
                            if ($item->is_smoking == "yes"){
                                return '<p class="text-center"><i class="fa fa-check check-icon"></i></p>';
                            }
                            else {
                                return '<p class="text-center"><i class="fa fa-times non-icon"></i></p>';
                            }
                        })
                        ->rawColumns(['action', 'id', 'status.name', 'is_suitable', 'patient.name_surname', 'is_alcohol', 'is_smoking'])
                            
                        ->toJson();
                    };
                    $columns = [
                        ['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false],
                        ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                        ['data' => 'status.name', 'name' => 'status.name', 'title' => 'Status'],
                        ['data' => 'is_suitable', 'name' => 'is_suitable', 'title' => 'Is Suitable'],
                        ['data' => 'patient.name_surname', 'name' => 'patient.name_surname', 'title' => 'Patient'],
                        ['data' => 'treatment.name_en', 'name' => 'treatment.name_en', 'title' => 'Treatment'],
                        ['data' => 'salesperson.name_surname', 'name' => 'salesperson.name_surname', 'title' => 'Sales Person'],
                        ['data' => 'patient.age', 'name' => 'patient.age', 'title' => 'Age'],
                        ['data' => 'height', 'name' => 'height', 'title' => 'Height'],
                        ['data' => 'weight', 'name' => 'weight', 'title' => 'Weight'],
                        ['data' => 'is_alcohol', 'name' => 'is_alcohol', 'title' => 'Alcohol'],
                        ['data' => 'is_smoking', 'name' => 'is_smoking', 'title' => 'Smoking'],
                    ];
                    $html = $builder->columns($columns)->parameters([
                        "pageLength" => 50
                    ]);
    
                return view('admin.treatmentplans.completed', compact('html'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ticketreceived(Builder $builder)
    {
        try {
            if (request()->ajax()) {
                $data = TreatmentPlan::with('status', 'patient', 'treatment', 'salesperson')
                ->whereNotNull('treatment_plans.arrival_date');
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        $param = '<div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/operationbydate/edit/'.$item->id.'" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Edit / Show</a>
                                </li>
                                <li>
                                    <a href="/operation/cancel/'.$item->id.'" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger edit-btn"><i class="fa fa-ban"></i> Cancel</a>
                                </li>
                                <li>
                                    <a href="/treatmentplans/download/'.$item->id.'?lang=en&theme=1" class="btn btn-success edit-btn"><i class="fa fa-download"></i> Download</a>
                                </li>
                            </ul>
                        </div>';
                        return $param;
                    })
                    ->editColumn('id', function ($item) {
                        $param = date('ymd', strtotime($item->created_at)) . $item->patient->id . $item->id;
                        return $param;
                    })
                    ->editColumn('name', function ($item) {
                        return '<span class="badge badge-dark text-white">Ticket Recevied</span>';
                    })
                    ->editColumn('patient.name_surname', function ($item) {
                        if($item->patient->gender == "Male"){
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'"><i class="fa fa-male"></i> '.$item->patient->name_surname.'</a>';
                        }
                        if($item->patient->gender == "Female"){
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'"><i class="fa fa-female"></i> '.$item->patient->name_surname.'</a>';
                        }
                        else {
                            return '<a href="'.route('patient.edit', ['id' => $item->patient->id]).'">'.$item->patient->name_surname.'</a>';
                        }
                    })
                    ->editColumn('arrival_date', function ($item) {
                        $param = date('d-m-Y', strtotime($item->arrival_date));
                        return $param;
                    })
                    ->editColumn('operation_date', function ($item) {
                        $param = date('d-m-Y', strtotime($item->operation_date));
                        return $param;
                    })
                    ->editColumn('departure_date', function ($item) {
                        $param = date('d-m-Y', strtotime($item->departure_date));
                        return $param;
                    })
                    ->rawColumns(['action', 'id', 'status.name', 'patient.name_surname', 'is_alcohol', 'is_smoking'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status.name', 'name' => 'status.name', 'title' => 'Status'],
                    ['data' => 'patient.name_surname', 'name' => 'patient.name_surname', 'title' => 'Patient'],
                    ['data' => 'treatment.name_en', 'name' => 'treatment.name_en', 'title' => 'Treatment'],
                    ['data' => 'arrival_date', 'name' => 'arrival_date', 'title' => 'Arrival Date'],
                    ['data' => 'operation_date', 'name' => 'operation_date', 'title' => 'Operation Date'],
                    ['data' => 'departure_date', 'name' => 'departure_date', 'title' => 'Departure Date'],
                    ['data' => 'salesperson.name_surname', 'name' => 'salesperson.name_surname', 'title' => 'Sales Person'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.treatmentplans.ticket_received', compact('html'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function download(Request $request, $id)
    {
        try {
            $treatment_plan = TreatmentPlan::find($id);            
            $lang = $request->input('lang');
            $theme = $request->input('theme');

            $data = array('treatment_plan' => $treatment_plan, 'theme' => $theme, 'lang' => $lang);
            return view('admin.treatmentplans.languages.tp_'.$lang.'')->with($data);
            switch ($lang) {
                case "en":
                    return view('admin.treatmentplans.languages.tp_en')->with($data);
                    break;
                case "de":
                    return view('admin.treatmentplans.languages.tp_de')->with($data);
                    break;
                case "fr":
                    return view('admin.treatmentplans.languages.tp_fr')->with($data);
                    break;
                case "it":
                    return view('admin.treatmentplans.languages.tp_it')->with($data);
                    break;
                case "es":
                    return view('admin.treatmentplans.languages.tp_es')->with($data);
                    break;
                case "tr":
                    return view('admin.treatmentplans.languages.tp_tr')->with($data);
                    break;
                case "ru":
                    return view('admin.treatmentplans.languages.tp_ru')->with($data);
                    break;
                case "pl":
                    return view('admin.treatmentplans.languages.tp_pl')->with($data);
                    break;
                case "pt":
                    return view('admin.treatmentplans.languages.tp_pt')->with($data);
                    break;
                case "tr":
                    return view('admin.treatmentplans.languages.tp_tr')->with($data);
                    break;
                case "ar":
                    return view('admin.treatmentplans.languages.tp_ar')->with($data);
                    break;
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function calendar()
    {
        try {
            $user = auth()->user();
                
            $calendarCount = TreatmentPlan::select('treatment_plans.created_date as date', 'treatment_plan_statuses.id as pId', 'treatment_plan_statuses.color', 'treatment_plan_statuses.name', DB::raw('count(name) as countR'))
                ->leftJoin('treatment_plan_statuses', 'treatment_plans.treatment_plan_status_id', '=', 'treatment_plan_statuses.id')
                ->leftJoin('patients', 'treatment_plans.patient_id', '=', 'patients.id')
                ->leftJoin('sales_persons', 'treatment_plans.sales_person_id', '=', 'sales_persons.id')
                ->whereNotNull('treatment_plans.treatment_plan_status_id')
                ->whereIn('treatment_plans.treatment_plan_status_id', array(1, 2, 3))
                ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                    $query->where('treatment_plans.user_id', '=', $user->id);
                })
                ->when($user->hasRole('Doctor'), function ($query) use ($user) {
                    $query->where('treatment_plans.doctor_id', '=', $user->id);
                })
                ->groupBy(['date', 'pId']);
    
                $listCountByMonth = DB::select($calendarCount->groupBy(DB::raw('pId'))->toSql(),
                $calendarCount->getBindings());
    
                $data = array('listCountByMonth' => $listCountByMonth);
                return view('admin.calendars.approval_calendar')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function operationcalendar()
    {
        try {
            $user = auth()->user();

            $calendarCount = TreatmentPlan::select('treatment_plans.operation_date as date', 'sales_persons.id as sId', 'sales_persons.name_surname', 'treatments.name_en', DB::raw('count(name_en) as countR'))
                ->leftJoin('sales_persons', 'treatment_plans.sales_person_id', '=', 'sales_persons.id')
                ->leftJoin('patients', 'treatment_plans.patient_id', '=', 'patients.id')
                ->leftJoin('treatments', 'treatment_plans.treatment_id', '=', 'treatments.id')
                ->whereNotNull('treatment_plans.sales_person_id')
                ->whereIn('treatment_plans.treatment_plan_status_id', array(2))
                ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                    $query->where('treatment_plans.user_id', '=', $user->id);
                })
                ->groupBy(['date', 'sId']);

            $listCountByMonth = DB::select($calendarCount->groupBy(DB::raw('sId'))->toSql(),
            $calendarCount->getBindings());

            $data = array('listCountByMonth' => $listCountByMonth);
            return view('admin.calendars.operation_calendar')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function allTreatmentPlanByDate(Request $request)
    {
        try {
            $user = auth()->user();

            $searchDate = $request->input('s');
            $tpStatus = $request->input('ps');

            $treatments = Treatment::orderBy('name_en', 'asc')->get();
            $sales_persons = SalesPerson::orderBy('name_surname', 'asc')->get();

            $arrivalsA = TreatmentPlan::select('treatment_plans.created_date as date', 'treatment_plans.*', 'treatment_plans.id as tId', 'sales_persons.name_surname as salesName', 'treatment_plan_statuses.color', 'treatment_plan_statuses.name', 'patients.name_surname as Pname', 'sales_persons.name_surname', 'treatments.*')
                ->leftJoin('treatment_plan_statuses', 'treatment_plans.treatment_plan_status_id', '=', 'treatment_plan_statuses.id')
                ->leftJoin('sales_persons', 'treatment_plans.sales_person_id', '=', 'sales_persons.id')
                ->leftJoin('patients', 'treatment_plans.patient_id', '=', 'patients.id')
                ->leftJoin('medical_departments', 'treatment_plans.medical_department_id', '=', 'medical_departments.id')
                ->leftJoin('treatments', 'treatment_plans.treatment_id', '=', 'treatments.id')
                ->whereDate('treatment_plans.created_date', '=', $searchDate)
                ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                    $query->where('treatment_plans.user_id', '=', $user->id);
                })
                ->orderBy('created_date');

            if (!empty($tpStatus)) {
                $arrivalsA->where('treatment_plans.treatment_plan_status_id', '=', $tpStatus);
            }

            $listAllByDates = DB::select($arrivalsA->orderByRaw('DATE_FORMAT(date, "%y-%m-%d")')->toSql(), $arrivalsA->getBindings());

            $datePrmtr = date('d.m.Y', strtotime($searchDate));

            if (!empty($tpStatus)) {
                $datePrmtr = $datePrmtr . "  -  " . $tpStatus;
            }

            $data = array('listAllByDates' => $listAllByDates, 'tpStatus' => $tpStatus, 'treatments' => $treatments, 'tableTitle' => 'All Treament Plans Request By ' . $datePrmtr);
            return view('admin.treatmentplans.all_treatmentplan')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function allOperationByDate(Request $request)
    {
        try {
            $user = auth()->user();
            $searchDate = $request->input('s');
            $tpStatus = $request->input('ps');

            $sales_persons = SalesPerson::orderBy('name_surname', 'asc')->get();

            $arrivalsA = TreatmentPlan::select('treatment_plans.operation_date as date', 'treatment_plans.*', 'treatment_plans.id as tId', 'sales_persons.name_surname as salesName', 'treatment_plan_statuses.color', 'treatment_plan_statuses.name', 'patients.name_surname as Pname', 'sales_persons.name_surname', 'treatments.*')
                ->leftJoin('treatment_plan_statuses', 'treatment_plans.treatment_plan_status_id', '=', 'treatment_plan_statuses.id')
                ->leftJoin('sales_persons', 'treatment_plans.sales_person_id', '=', 'sales_persons.id')
                ->leftJoin('patients', 'treatment_plans.patient_id', '=', 'patients.id')
                ->leftJoin('medical_departments', 'treatment_plans.medical_department_id', '=', 'medical_departments.id')
                ->leftJoin('treatments', 'treatment_plans.treatment_id', '=', 'treatments.id')
                ->whereDate('treatment_plans.operation_date', '=', $searchDate)
                ->when($user->hasRole('Sales Person'), function ($query) use ($user) {
                    $query->where('treatment_plans.user_id', '=', $user->id);
                })
                ->orderBy('operation_date');

            if (!empty($tpStatus)) {
                $arrivalsA->where('treatment_plans.treatment_plan_status_id', '=', $tpStatus);
            }

            $listAllByDates = DB::select($arrivalsA->orderByRaw('DATE_FORMAT(date, "%y-%m-%d")')->toSql(), $arrivalsA->getBindings());

            $datePrmtr = date('d.m.Y', strtotime($searchDate));

            if (!empty($tpStatus)) {
                $datePrmtr = $datePrmtr . "  -  " . $tpStatus;
            }

            $data = array('listAllByDates' => $listAllByDates, 'treatments' => $treatments, 'tableTitle' => 'All Operations By ' . $datePrmtr);
            return view('admin.treatmentplans.all_operation')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function changeTreatmentPlanDates(Request $request, $id)
    {
        try {
            $temp['arrival_date'] = $request->input('arrival_date');
            $temp['departure_date'] = $request->input('departure_date');
            $temp['operation_date'] = $request->input('operation_date');

            if (TreatmentPlan::where('id', '=', $id)->update($temp)) {
                return response(true, 200);
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $treatment_plan = TreatmentPlan::find($id);
            $treatments = Treatment::orderBy('name_en', 'asc')->get();
            $treatment_plan_statuses = TreatmentPlanStatus::orderBy('name', 'asc')->get();
            $sales_persons = SalesPerson::all();

            $treatment_plan_photos = TreatmentPlanPhoto::where('treatment_plans_photos.treatment_plan_id', '=', $id);

            $hasPhotos = false;
            $hasPhotos = $treatment_plan_photos->count() > 0 ? true : false;

            $photosCount = $treatment_plan_photos->count();

            $data = array('treatment_plan' => $treatment_plan, 'treatments' => $treatments, 'treatment_plan_statuses' => $treatment_plan_statuses, 'sales_persons' => $sales_persons, 'hasPhotos' => $hasPhotos, 'photosCount' => $photosCount);

            if($user->hasRole('Doctor')){
                return view('doctor.edit_treatmentplan')->with($data);
            }
            else {
                return view('admin.treatmentplans.edit_treatmentplan')->with($data);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function post(Request $request, $id)
    {
        try {
            $user = auth()->user();

            if($request->input('tratment_plan_status_id') == 3){
                $temp['post_time'] = Carbon::now()->toDateTimeString();
                $temp['treatment_plan_status_id'] = $request->input('tratment_plan_status_id');
                $temp['doctor_explanation'] = $request->input('doctor_explanation');
                $temp['recommended_treatment_id'] = NULL;
                $temp['is_suitable'] = NULL;
                $temp['answered_user_id'] = $user->id;
                
                if (TreatmentPlan::where('id', '=', $id)->update($temp)) {
                    return response(true, 200);
                }
                else {
                    return response(false, 500);
                }
            }

            else {
                $temp['post_time'] = Carbon::now()->toDateTimeString();
                $temp['treatment_plan_status_id'] = $request->input('tratment_plan_status_id');
                $temp['doctor_explanation'] = $request->input('doctor_explanation');
                $temp['recommended_treatment_id'] = $request->input('recommended_treatment_id');
                $temp['is_suitable'] = $request->input('is_suitable');
                $temp['answered_user_id'] = $user->id;

                if (TreatmentPlan::where('id', '=', $id)->update($temp)) {
                    return response(true, 200);
                }
                else {
                    return response(false, 500);
                }
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editOperationDates($id)
    {
        try {
            $treatment_plans = TreatmentPlan::find($id);
            return view('edit_operation', ['treatment_plans' => $treatment_plans]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function cancelOperation(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['arrival_date'] = NULL;
            $temp['operation_date'] = NULL;
            $temp['departure_date'] = NULL;

            if (TreatmentPlan::where('id', '=', $id)->update($temp)) {
                return redirect()->route('treatmentplan.completed')->with('message', 'Ticket Successfully Canceled!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['treatment_id'] = $request->input('treatment_id');
            $temp['sales_person_id'] = $request->input('sales_person_id');
            // $temp['doctor_id'] = $request->input('doctor_id');
            $temp['duration_of_stay'] = $request->input('duration_of_stay');
            $temp['hospitalization'] = $request->input('hospitalization');
            $temp['total_price'] = $request->input('total_price');
            $temp['price_currency'] = $request->input('price_currency');
            $temp['weight'] = $request->input('weight');
            $temp['weight_unit'] = $request->input('weight_unit');
            $temp['height'] = $request->input('height');
            $temp['height_unit'] = $request->input('height_unit');
            $temp['is_asthma'] = $request->input('is_asthma');
            $temp['is_diabetes'] = $request->input('is_diabetes');
            $temp['is_hyper_tension'] = $request->input('is_hyper_tension');
            $temp['is_breathing_problem'] = $request->input('is_breathing_problem');
            $temp['is_chronic_illness'] = $request->input('is_chronic_illness');
            $temp['is_hiv'] = $request->input('is_hiv');
            $temp['is_stroke'] = $request->input('is_stroke');
            $temp['is_hepatitis'] = $request->input('is_hepatitis');
            $temp['is_cancer'] = $request->input('is_cancer');
            $temp['is_sickle'] = $request->input('is_sickle');
            $temp['is_anaemia'] = $request->input('is_anaemia');
            $temp['is_kidney_problem'] = $request->input('is_kidney_problem');
            $temp['is_smoking'] = $request->input('is_smoking');
            $temp['is_alcohol'] = $request->input('is_alcohol');
            $temp['is_allergie'] = $request->input('is_allergie');
            $temp['is_surgery_history'] = $request->input('is_surgery_history');
            $temp['is_covid_vaccine'] = $request->input('is_covid_vaccine');
            $temp['note'] = $request->input('note');

            if (TreatmentPlan::where('id', '=', $id)->first()->update($temp)) {
                return back()->with('message', 'Treatment Plan Updated Successfully!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateOperationDate(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['arrival_date'] = $request->input('arrival_date');
            $temp['departure_date'] = $request->input('departure_date');
            $temp['operation_date'] = $request->input('operation_date');

            if (TreatmentPlan::where('id', '=', $id)->update($temp)) {
                return redirect()->route('treatmentplan.ticketreceived')->with('message', 'Treatment Plan Updated Successfully!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            TreatmentPlan::find($id)->delete();
            return back()->with('message', 'Treatment Plan Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
