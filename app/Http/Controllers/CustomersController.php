<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Source;
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
                                        <a href="/definitions/customers/edit/'.$item->id.'" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Güncelle</a>
                                    </li>
                                    <li>
                                        <a href="/definitions/customers/destroy/'.$item->id.'" onclick="return confirm(Are you sure?);" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a>
                                    </li>
                                </ul>
                            </div>';
                    })
                    ->rawColumns(['action'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'customer_name_surname', 'name' => 'customer_name_surname', 'title' => 'Adı Soyadı'],
                    ['data' => 'customer_phone', 'name' => 'customer_phone', 'title' => 'Telefon Numarası'],
                    ['data' => 'customer_country', 'name' => 'customer_country', 'title' => 'Ülkesi'],
                    ['data' => 'customer_email', 'name' => 'customer_email', 'title' => 'Email Adresi'],
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
            $newCustomer = new Customer();
            $newCustomer->customer_name_surname = $request->input('customerNameSurname');
            $newCustomer->customer_phone = $request->input('customerPhone');
            $newCustomer->customer_country = $request->input('customerCountry');
            $newCustomer->customer_email = $request->input('customerEmail');

            $newCustomer->user_id = auth()->user()->id;
            $result = $newCustomer->save();

            if ($result){
                return redirect('/definitions/customers')->with('message', 'Müşteri Başarıyla Kaydedildi!');
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
            $newCustomer = new Customer();
            $newCustomer->customer_name_surname = $request->input('customerNameSurname');
            $newCustomer->customer_phone = $request->input('customerPhone');
            $newCustomer->customer_country = $request->input('customerCountry');
            $newCustomer->customer_email = $request->input('customerEmail');

            $newCustomer->user_id = auth()->user()->id;
            $result = $newCustomer->save();

            if ($result) {
                return response($newCustomer->id, 200);
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
            $sources = Source::orderBy('source_name', 'asc')->get();

            return view('admin.customers.edit_customer', ['customer' => $customer, 'sources' => $sources, 'customer' => $customer]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['customer_name_surname'] = $request->input('customerNameSurname');
            $temp['customer_phone'] = $request->input('customerPhone');
            $temp['customer_country'] = $request->input('customerCountry');
            $temp['customer_email'] = $request->input('customerEmail');

            if (Customer::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/customers')->with('message', 'Müşteri Başarıyla Güncellendi!');
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
            return redirect('definitions/customers')->with('message', 'Müşteri Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
