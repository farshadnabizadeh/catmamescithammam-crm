<?php

namespace App\Http\Controllers;

use App\Models\LeadSource;
use Illuminate\Http\Request;

class LeadSourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $lead_sources = LeadSource::orderBy('name', 'asc')->get();
            $data = array('lead_sources' => $lead_sources);
            return view('admin.leadsources.leadsource_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $newData = new LeadSource();
            $newData->name = $request->input('name');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('leadsource.index')->with('message', 'New Lead Source Added Successfully!');
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
            $lead_source = LeadSource::where('id', '=', $id)->first();
            return view('admin.leadsources.edit_leadsource', ['lead_source' => $lead_source]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name'] = $request->input('name');

            if (LeadSource::where('id', '=', $id)->update($temp)) {
                return redirect()->route('leadsource.index')->with('message', 'Lead Source Updated Successfully!');
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
            LeadSource::find($id)->delete();
            return redirect()->route('leadsource.index')->with('message', 'Lead Source Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}