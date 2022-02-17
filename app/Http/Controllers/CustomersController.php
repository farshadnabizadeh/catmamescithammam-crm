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

    public function getArrivalReservations($id)
    {
        $arrivalsC = DB::table('arrival_reservations_customers')
            ->select('arrival_reservations.*', 'arrival_reservations_customers.*', 'arrival_reservations_customers.arrival_reservation_id as reservation_id', 'arrival_reservations_customers.arrival_reservations_customers_id as reservation_c_id', 'patient_statuses.patient_status_color', 'patient_statuses.patient_status_name'
                , 'routes.route_name', 'contact_persons.person_name_surname', 'treatments.*', 'customers.*', 'hotels.hotel_name', 'hospitals.hospital_name')
            ->leftJoin('arrival_reservations', 'arrival_reservations_customers.arrival_reservation_id', '=', 'arrival_reservations.arrival_reservation_id', 'market_leaders.id as mlId')
            ->leftJoin('patient_statuses', 'arrival_reservations_customers.patient_status_id', '=', 'patient_statuses.patient_status_id')
            ->leftJoin('contact_persons', 'arrival_reservations_customers.contact_person_id', '=', 'contact_persons.id')
            ->leftJoin('routes', 'arrival_reservations_customers.route_id', '=', 'routes.route_id')
            ->leftJoin('hotels', 'arrival_reservations_customers.hotel_id', '=', 'hotels.hotel_id')
            ->leftJoin('hospitals', 'arrival_reservations_customers.hospital_id', '=', 'hospitals.hospital_id')
            ->leftJoin('treatments', 'arrival_reservations_customers.treatment_id', '=', 'treatments.treatment_id')
            ->leftJoin('market_leaders', 'arrival_reservations_customers.market_leaders_id', '=', 'market_leaders.id')
            ->leftJoin('customers', 'arrival_reservations_customers.customer_id', '=', 'customers.customer_id')
            ->where('arrival_reservations_customers.customer_id', '=', $id)
            ->orderByRaw('DATE_FORMAT(arrival_date, "%d-%m")')
            ->orderBy('arrival_time')
            ->first();

        return response()->json([$arrivalsC], 200);
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
