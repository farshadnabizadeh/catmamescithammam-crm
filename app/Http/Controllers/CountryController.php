<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $countries = Country::orderBy('name', 'asc')->get();

            $data = array('countries' => $countries);
            return view('admin.countries.country_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Country();
            $newData->name = $request->input('name');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('country.index')->with('message', 'New Country Added Successfully!');
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
        $country = Country::where('id', '=', $id)->first();
        return view('admin.countries.edit_country', ['country' => $country]);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $temp['name'] = $request->input('name');

            if (Country::where('id', '=', $id)->update($temp)) {
                return redirect()->route('country.index')->with('message', 'Country Updated Successfully!');
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
        Country::find($id)->delete();
        return redirect()->route('country.index')->with('message', 'Treatment Deleted Successfully!');
    }
}
