<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $treatments = Treatment::orderBy('name_en', 'asc')->get();

            $data = array('treatments' => $treatments);
            return view('admin.treatments.treatments_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Treatment();
            $newData->name_en = $request->input('nameEn');
            $newData->name_de = $request->input('nameDe');
            $newData->name_fr = $request->input('nameFr');
            $newData->name_it = $request->input('nameIt');
            $newData->name_es = $request->input('nameEs');
            $newData->name_ar = $request->input('nameAr');
            $newData->medical_department_id = "1";
            $newData->desc = $request->input('desc');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('treatment.index')->with('message', 'New Treatment Added Successfully!');
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
            $treatment = Treatment::where('id', '=', $id)->first();
            return view('admin.treatments.edit_treatment', ['treatment' => $treatment]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $temp['name_en'] = $request->input('nameEn');
            $temp['name_de'] = $request->input('nameDe');
            $temp['name_fr'] = $request->input('nameFr');
            $temp['name_it'] = $request->input('nameIt');
            $temp['name_es'] = $request->input('nameEs');
            $temp['name_pt'] = $request->input('namePt');
            $temp['name_pl'] = $request->input('namePl');
            $temp['name_ru'] = $request->input('nameRu');
            $temp['name_tr'] = $request->input('nameTr');
            $temp['name_ar'] = $request->input('nameAr');
            $temp['desc'] = $request->input('desc');

            if (Treatment::where('id', '=', $id)->update($temp)) {
                return redirect()->route('treatment.index')->with('message', 'Treatment Updated Successfully!');
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
            Treatment::find($id)->delete();
            return redirect()->route('treatment.index')->with('message', 'Treatment Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
