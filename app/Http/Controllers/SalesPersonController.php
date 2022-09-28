<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesPersonController extends Controller
{
    public function index()
    {
        try {
            $sales_persons = SalesPerson::orderBy('name_surname', 'asc')->get();
            $data = array('sales_persons' => $sales_persons, 'pageTitle' => 'New Sales Person');
            return view('admin.salespersons.salespersons_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new SalesPerson();
            $newData->name_surname = $request->input('name');
            $newData->phone_number = $request->input('phone');
            $newData->email_address = $request->input('email');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('salesperson.index')->with('message', 'New Sales Person Added Successfully!');
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
            $sales_person = SalesPerson::where('id', '=', $id)->first();

            return view('admin.salespersons.edit_salesperson', ['sales_persons' => $sales_person]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['name_surname'] = $request->input('name');
            $temp['phone_number'] = $request->input('phone');
            $temp['email_address'] = $request->input('email');

            if (SalesPerson::where('id', '=', $id)->update($temp)) {
                return redirect()->route('salesperson.index')->with('message', 'Sales Person Updated Successfully!');
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
            SalesPerson::find($id)->delete();
            return redirect()->route('salesperson.index')->with('message', 'Sales Person Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
