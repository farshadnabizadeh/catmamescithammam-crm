<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use App\Models\TreatmentPlan;
use App\Models\TreatmentPlanStatus;
use App\Models\TreatmentPlanPhoto;
use App\Models\Treatment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class SalesAdminController extends Controller
{
    public function editTreatmentplan(Request $request, $id)
    {
        try {
            $treatment_plan = TreatmentPlan::where('id','=',$id)->first();
            $treatments = Treatment::orderBy('name_en', 'asc')->get();
            $treatment_plan_statuses = TreatmentPlanStatus::all();
            $treatment_plan_photos = TreatmentPlanPhoto::where('treatment_plans_photos.treatment_plan_id', '=', $id);

            $hasPhotos = false;
            $hasPhotos = $treatment_plan_photos->count() > 0 ? true : false;

            $photosCount = $treatment_plan_photos->count();

            $data = array('treatment_plan' => $treatment_plan, 'treatments' => $treatments, 'treatment_plan_statuses' => $treatment_plan_statuses, 'photosCount' => $photosCount, 'hasPhotos' => $hasPhotos);

            $page = $request->input("page");

            if($page == "photos"){
                return view('salesadmin.photos_treatment_plan')->with($data);
            }
            else if($page == "doctor_recommended"){
                return view('salesadmin.doctor_recommended')->with($data);
            }
            else {
                return view('salesadmin.edit_treatmentplan')->with($data);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateTreatmentPlanTreatment(Request $request, $id)
    {
        try {
            $temp['explanation'] = $request->input('explanation');
            $temp['treatment_id'] = $request->input('recommendedTreatmentId');
            $temp['is_suitable'] = $request->input('isSuitable');

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

    public function view($id)
    {
        try {
            $treatment_plans = TreatmentPlan::find($id);
            $sales_persons = SalesPerson::all();
            $treatment_plan_statuses = TreatmentPlanStatus::all();
            $data = array('treatment_plans' => $treatment_plans, 'sales_persons' => $sales_persons, 'treatment_plan_statuses' => $treatment_plan_statuses);
            return view('sales.view')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}