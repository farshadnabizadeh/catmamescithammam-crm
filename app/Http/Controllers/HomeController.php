<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hotel;
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

            $customerCount = Customer::all()->count();
            $hotelCount = Hotel::all()->count();

            $userID = Auth::user()->id;
            $user = auth()->user();

            $dashboard = array('lastCustomers' => $lastCustomers, 'customerCount' => $customerCount, 'hotelCount' => $hotelCount);

            return view('home')->with($dashboard);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
