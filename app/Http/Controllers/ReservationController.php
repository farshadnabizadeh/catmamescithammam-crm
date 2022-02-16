<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Source;
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
        $data = array('reservations' => $reservations, 'services' => $services, 'sources' => $sources);
        return view('admin.reservations.reservations_list')->with($data);
    }
}
