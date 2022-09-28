<?php

namespace App\Http\Controllers\API;

use App\Models\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class PatientApiController extends Controller
{
    public function getPatientDetail(Request $request, $id)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($loginData)) {

            $user = auth()->user();

            $patient = Patient::where('id', '=', $id)->first();
            return response($patient, 200);
        }
    }
}