<?php

namespace App\Http\Controllers;

use App\Models\MedicalSubDepartment;
use App\Models\MedicalDepartment;
use Illuminate\Http\Request;

class MedicalSubDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $medical_sub_departments = MedicalSubDepartment::orderBy('name', 'asc')->get();
            $medical_departments = MedicalDepartment::orderBy('name', 'asc')->get();
            $data = array('medical_sub_departments' => $medical_sub_departments, 'medical_departments' => $medical_departments);
            return view('admin.medicalsubdepartment.medicalsubdepartment_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new MedicalSubDepartment();
            $newData->name = $request->input('name');
            $newData->medical_department_id = $request->input('departmentId');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('medicalsubdepartment.index')->with('message', 'New Medical Sub Department Added Successfully!');
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
            $medical_sub_department = MedicalSubDepartment::where('id','=',$id)->first();

            $medical_departments = MedicalDepartment::orderBy('name', 'asc')->get();
            $subDepartment = MedicalSubDepartment::where('id','=',$id)->first();

            return view('admin.medicalsubdepartment.edit_medicalsubdepartment', ['medical_departments' => $medical_departments, 'medical_sub_department' => $medical_sub_department, 'subDepartment' => $subDepartment]);
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
            $temp['medical_department_id'] = $request->input('departmentId');

            if (MedicalSubDepartment::where('id', '=', $id)->update($temp)) {
                return redirect()->route('medicalsubdepartment.index')->with('message', 'Medical Department Updated Successfully!');
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
            MedicalSubDepartment::find($id)->delete();
            return redirect()->route('medicalsubdepartment.index')->with('message', 'Medical Department Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
