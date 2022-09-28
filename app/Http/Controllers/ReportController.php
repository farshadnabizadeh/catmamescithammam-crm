<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use App\Models\TreatmentPlan;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $week = $request->input('W');
            $month = $request->input('M');

            $data = User::select("users.name", \DB::raw("(SELECT count(*) FROM treatment_plans a WHERE a.user_id = users.id and a.deleted_at is null) as aCount"))
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->get();

            return view('admin.reports.report', array('data' => $data));
            // return json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function userReport(Request $request)
    {
        try {

            $data = TreatmentPlan::select('users.name', DB::raw('user_id, count(*) as count'))
            ->leftJoin('users', 'treatment_plans.user_id', '=', 'users.id')
            ->groupBy('user_id')
            ->get();

            // return view('admin.reports.report', array('data' => $data));
            return json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function treatmentReport(Request $request)
    {
        try {

            $data = TreatmentPlan::select('treatments.name_en', DB::raw('treatment_id, count(*) as count'))
            ->leftJoin('treatments', 'treatment_plans.treatment_id', '=', 'treatments.id')
            ->groupBy('treatment_id')
            ->get();

            // return view('admin.reports.report', array('data' => $data));
            return json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
