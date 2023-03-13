<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Country;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Builder $builder)
    {
        try {
             if (request()->ajax()) {
                $data = Customer::orderBy('created_at', 'desc');
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                            return '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="'.route('customer.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Güncelle</a>
                                    </li>
                                    <li>
                                        <a href="'.route('customer.destroy', ['id' => $item->id]).'" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a>
                                    </li>
                                </ul>
                            </div>';
                    })
                    ->rawColumns(['action'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'name_surname', 'name' => 'name_surname', 'title' => 'Adı Soyadı'],
                    ['data' => 'phone', 'name' => 'phone', 'title' => 'Telefon Numarası'],
                    ['data' => 'country', 'name' => 'country', 'title' => 'Ülkesi'],
                    ['data' => 'email', 'name' => 'email', 'title' => 'Email Adresi'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.customers.customers_list', compact('html'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Customer();
            $newData->name_surname = $request->input('name_surname');
            $newData->phone = $request->input('phone');
            $newData->country = $request->input('country');
            $newData->email = $request->input('email');

            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result){
                return redirect()->route('customer.index')->with('message', 'Müşteri Başarıyla Kaydedildi!');
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function save(Request $request)
    {
        try {
            $newData = new Customer();
            $newData->name_surname = $request->input('name_surname');
            $newData->phone = $request->input('phone');
            $newData->country = $request->input('country');
            $newData->email = $request->input('email');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return response($newData->id, 200);
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
            $customer = Customer::where('id','=',$id)->first();
            $countries = Country::where('name','!=',$customer->country)->get();

            return view('admin.customers.edit_customer', ['customer' => $customer,'countries'=>$countries]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['name_surname'] = $request->input('name_surname');
            $temp['phone'] = $request->input('phone');
            $temp['country'] = $request->input('country');
            $temp['email'] = $request->input('email');

            if (Customer::where('id', '=', $id)->update($temp)) {
                return redirect()->route('customer.index')->with('message', 'Müşteri Başarıyla Güncellendi!');
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
            Customer::where('id', '=', $id)->delete();
            return redirect()->route('customer.index')->with('message', 'Müşteri Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
