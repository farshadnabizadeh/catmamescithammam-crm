<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Source;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::orderBy('customer_name', 'asc')->get();
        $sources = Source::orderBy('source_name', 'asc')->get();
        $data = array('customers' => $customers, 'sources' => $sources);
        return view('admin.customers.customers_list')->with($data);
    }

    public function store(Request $request)
    {
        $newCustomer = new Customer();
        $newCustomer->customer_name = $request->input('customerName');
        $newCustomer->customer_surname = $request->input('customerSurname');
        $newCustomer->customer_phone = $request->input('customerPhone');
        $newCustomer->customer_country = $request->input('customerCountry');
        $newCustomer->customer_email = $request->input('customerEmail');
        $newCustomer->customer_sob_id = $request->input('customerSobId');

        $newCustomer->user_id = auth()->user()->id;
        $result = $newCustomer->save();

        if ($result){
            return redirect('/definitions/customers')->with('message', 'Customer Added Successfully!');
        }
        else {
            return response(false, 500);
        }
    }

    public function edit($id)
    {
        $customer = Customer::where('id','=',$id)->first();
        $sources = Source::orderBy('source_name', 'asc')->get();

        return view('admin.customers.edit_customer', ['customer' => $customer ,'sources' => $sources]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $temp['customer_name'] = $request->input('customerName');
        $temp['customer_phone'] = $request->input('customerPhone');
        $temp['customer_country'] = $request->input('customerCountry');
        $temp['customer_email'] = $request->input('customerEmail');
        $temp['customer_sob_id'] = $request->input('customerSobId');

        if ($updateSelectedData = Customer::where('id', '=', $id)->update($temp)) {
            return redirect('/definitions/customers')->with('message', 'Customer Updated Successfully!');
        }
        else {
            return back()->withInput($request->input());
        }
    }

    public function destroy($id){
        $customers = Customer::where('id', '=', $id)->delete();

        return redirect('definitions/customers')->with('message', 'Customer Deleted Successfully!');
    }
}
