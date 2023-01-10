<?php

namespace App\Http\Controllers;

use App\Models\FormStatuses;
use Illuminate\Http\Request;

class FormStatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $form_statuses = FormStatuses::orderBy('name', 'asc')->get();
            $data = array('form_statuses' => $form_statuses);
            return view('admin.formstatuses.form_statuses')->with($data);   
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new FormStatuses();
            $newData->name = $request->input('name');
            $newData->color = $request->input('color');
            $newData->user_id = auth()->user()->id;

            $result = $newData->save();

            if ($result){
                return redirect()->route('formstatus.index')->with('message', 'Form Durumu Başarıyla Eklendi!');
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
        $form_status = FormStatuses::where('id','=', $id)->first();
        return view('admin.formstatuses.edit_form_statuses', ['form_status' => $form_status]);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['name'] = $request->input('name');
            $temp['color'] = $request->input('color');

            if (FormStatuses::where('id', '=', $id)->update($temp)) {
                return redirect()->route('formstatus.index')->with('message', 'Form Durumu Başarıyla Güncellendi!');
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
        FormStatuses::where('id', '=', $id)->delete();
        return redirect()->route('formstatus.index')->with('message', 'Form Durumu Başarıyla Silindi!');
    }
}
