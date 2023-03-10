<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class SalesPersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sales_persons = SalesPerson::orderBy('name_surname', 'asc')->get();
        $data = array('sales_persons' => $sales_persons);
        return view('admin.sales_persons.sales_person_list')->with($data);
    }

    public function store(Request $request)
    {
        try {
            $newData = new SalesPerson();
            $newData->name_surname = $request->input('name_surname');
            $newData->phone_number = $request->input('phone_number');
            $newData->email_address = $request->input('email');
            $newData->note = $request->input('note');
            $newData->user_id = auth()->user()->id;

            $result = $newData->save();

            if ($result) {
                return redirect()->route('salesperson.index')->with('message', 'Satışçı Başarıyla Eklendi!');
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
        $sales_person = SalesPerson::where('id','=',$id)->first();
        return view('admin.sales_persons.edit_sales_person', ['sales_person' => $sales_person]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $temp['name_surname'] = $request->input('name_surname');
        $temp['phone_number'] = $request->input('phone_number');
        $temp['email_address'] = $request->input('email');

        if (SalesPerson::where('id', '=', $id)->update($temp)) {
            return redirect()->route('salesperson.index')->with('message', 'Satışçı Başarıyla Güncellendi!');
        }
        else {
            return back()->withInput($request->input());
        }
    }

    public function destroy($id)
    {
        SalesPerson::find($id)->delete();
        return redirect()->route('salesperson.index')->with('message', 'Satışçı Başarıyla Silindi!');
    }
}
