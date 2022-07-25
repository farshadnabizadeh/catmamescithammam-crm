<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hotel;
use App\Models\ContactForm;
use App\Models\Service;
use App\Models\Therapist;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $lastCustomers = Customer::latest()->take(5)->get();

            $customerCount = Customer::count();
            $hotelCount = Hotel::count();
            $serviceCount = Service::count();
            $therapistCount = Therapist::count();

            $userID = Auth::user()->id;
            $user = auth()->user();

            $dashboard = array('lastCustomers' => $lastCustomers, 'customerCount' => $customerCount, 'hotelCount' => $hotelCount, 'serviceCount' => $serviceCount, 'therapistCount' => $therapistCount);

            return view('home')->with($dashboard);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
