<?php

namespace App\Http\Controllers\Api;

use App\Models\Therapist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getTherapists(Request $request)
    {
        $therapists = Therapist::all();
        return json_encode($therapists, 200);
    }
}