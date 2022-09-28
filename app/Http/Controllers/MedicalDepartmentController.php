<?php

namespace App\Http\Controllers;

use App\Models\MedicalDepartment;
use Illuminate\Http\Request;

class MedicalDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $medical_departments = MedicalDepartment::orderBy('name', 'asc')->get();
            $data = array('medical_departments' => $medical_departments);
            return view('admin.medicaldepartment.medicaldepartment_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new MedicalDepartment();
            $newData->name = $request->input('name');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('medicaldepartment.index')->with('message', 'New Medical Department Added Successfully!');
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
            $medical_department = MedicalDepartment::where('id', '=', $id)->first();

            return view('admin.medicaldepartment.edit_medicaldepartment', ['medical_department' => $medical_department]);
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

            if (MedicalDepartment::where('id', '=', $id)->update($temp)) {
                return redirect()->route('medicaldepartment.index')->with('message', 'Medical Department Updated Successfully!');
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
            MedicalDepartment::find($id)->delete();
            return redirect()->route('medicaldepartment.index')->with('message', 'Medical Department Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
