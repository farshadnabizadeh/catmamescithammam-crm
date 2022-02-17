<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Source;
use App\Models\Therapist;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reservations = Reservation::all();
        $services = Service::orderBy('service_name', 'asc')->get();
        $sources = Source::orderBy('source_name', 'asc')->get();
        $therapists = Therapist::orderBy('therapist_name', 'asc')->get();
        $data = array('reservations' => $reservations, 'services' => $services, 'sources' => $sources, 'therapists' => $therapists);
        return view('admin.reservations.reservations_list')->with($data);
    }

    public function store(Request $request)
    {
        $newReservation = new Reservation();
        $newReservation->arrival_date = $request->input('arrivalDate');
        $newReservation->arrival_time = $request->input('arrivalTime');
        $newReservation->total_customer = $request->input('totalCustomer');
        $newReservation->service_id	= $request->input('serviceId');
        $newReservation->service_currency = $request->input('serviceCurrency');
        $newReservation->service_cost = $request->input('serviceCost');
        $newReservation->service_commission = $request->input('serviceComission');

        $newReservation->user_id = auth()->user()->id;
        $result = $newReservation->save();

        if ($result) {
            return redirect('/definitions/reservations')->with('message', 'Reservation Added Successfully!');
        }
        else {
            return response(false, 500);
        }
    }

    public function destroy($id){
        Reservation::find($id)->delete();
        return redirect('definitions/patients')->with('message', 'Reservation Deleted Successfully!');
    }
}