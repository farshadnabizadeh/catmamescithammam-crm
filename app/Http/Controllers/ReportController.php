<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {

            $data = \DB::table("reservations")
                ->select("users.name", \DB::raw("(SELECT count(*) FROM reservations a WHERE a.user_id = users.id and a.deleted_at is null) as aCount"))
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->get();

            // return view('admin.reports.report', array('data' => $data));
            return json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }

    }
}
