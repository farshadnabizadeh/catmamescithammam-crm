<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Auth;
use App\Models\Treatment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        try {
            $lastCustomers = Customer::latest()->take(5)->get();

            $customerCount = Customer::all()->count();

            $userID = Auth::user()->id;
            $user = auth()->user();

            $dashboard = array('lastCustomers' => $lastCustomers, 'customerCount' => $customerCount);

            return view('home')->with($dashboard);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
