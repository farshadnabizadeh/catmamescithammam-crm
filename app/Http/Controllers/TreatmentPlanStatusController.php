<?php

namespace App\Http\Controllers;

use App\Models\TreatmentPlanStatus;
use Illuminate\Http\Request;

class TreatmentPlanStatusController extends Controller
{
    public function index()
    {
        try {
            $treatment_plan_statuses = TreatmentPlanStatus::all();
            $data = array('treatment_plan_statuses' => $treatment_plan_statuses);
            return view('admin.treatmentplan_status.treatmentplan_status_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            $newData = new TreatmentPlanStatus();
            $newData->name = $request->input('name');
            $newData->color = $request->input('color');
            $newData->user_id = $user->id;

            $result = $newData->save();

            if ($result) {
                return redirect()->route('treatmentplanstatus.index')->with('message', 'Treatment Plan Status Added Successfully!');
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
            $treatment_plan_status = TreatmentPlanStatus::where('id','=',$id)->first();
            return view('admin.treatmentplan_status.edit_treatmentplan_status', ['treatment_plan_status' => $treatment_plan_status]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['name'] = $request->input('name');
            $temp['color'] = $request->input('color');
            $temp['user_id'] = $user->id;

            if (TreatmentPlanStatus::where('id', '=', $id)->update($temp)) {
                return redirect()->route('treatmentplanstatus.index')->with('message', 'Treatment Plan Status Updated Successfully!');
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
            TreatmentPlanStatus::find($id)->delete();
            return redirect()->route('treatmentplanstatus.index')->with('message', 'Treatment Plan Status Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
