<?php

namespace App\Http\Controllers;

use App\Models\TreatmentPlan;
use App\Models\User;
use \OwenIt\Auditing\Models\Audit;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $logs = Audit::with('user')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.logs.index', ['logs' => $logs]);  
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

}
