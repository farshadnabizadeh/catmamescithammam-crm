<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use App\Models\Patient;
use App\Models\TreatmentPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')){
            $salespersonCount = SalesPerson::count();
            $treatmentPlanCount = TreatmentPlan::count();
            $userCount = User::count();
            $patientCount = Patient::count();
            $lastPatients = Patient::latest()->take(7)->get();
            $treatment_plans = TreatmentPlan::whereDate('created_at', Carbon::today())->get();

            $super_admin_dashboard = array('treatmentPlanCount' => $treatmentPlanCount,
                'patientCount' => $patientCount,
                'userCount' => $userCount,
                'lastPatients' => $lastPatients,
                'treatment_plans' => $treatment_plans
            );
            return view('home')->with($super_admin_dashboard);
        }

        else if ($user->hasRole('Admin')){
            $salespersonCount = SalesPerson::count();
            $treatmentPlanCount = TreatmentPlan::count();
            $patientCount = Patient::count();
            $lastPatients = Patient::latest()->take(5)->get();
            $treatment_plans = TreatmentPlan::whereDate('created_at', Carbon::today())->get();

            $admin_dashboard = array('treatmentPlanCount' => $treatmentPlanCount,
                'salespersons' => $salespersonCount,
                'patients' => $patientCount,
                'lastPatients' => $lastPatients,
                'treatment_plans' => $treatment_plans
            );
            return view('home')->with($super_admin_dashboard);
        }

        else if ($user->hasRole('Doctor')) {

            $user = auth()->user();

            $requested_treatment_plans = TreatmentPlan::orderBy('created_at', 'DESC')
                ->where('treatment_plans.treatment_plan_status_id', '=', '1 ')
                ->where('treatment_plans.doctor_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->get();

            $reconsult_treatment_plans = TreatmentPlan::orderBy('created_at', 'DESC')
                ->where('treatment_plans.treatment_plan_status_id', '=', '3')
                ->where('treatment_plans.doctor_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->get();

            $completed_treatment_plans = TreatmentPlan::orderBy('created_at', 'DESC')
                ->where('treatment_plans.treatment_plan_status_id', '=', '2')
                ->where('treatment_plans.doctor_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->get();

            $allRequestedTreatmentPlansCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '1')
            ->count();

            $requestedTreatmentPlansTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '1')
            ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
            ->count();

            $allReConsultCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '3')->count();
            $reconsultTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '3')->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])->count();

            $allCompletedTreatmentPlansCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '2')->count();
            $completedTreatmentPlansTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '2')->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])->count();

            $doctor_dashboard = array('requestedTreatmentPlansTodayCount' => $requestedTreatmentPlansTodayCount,
                'completedTreatmentPlansTodayCount' => $completedTreatmentPlansTodayCount,
                'reconsultTodayCount' => $reconsultTodayCount,
                'allRequestedTreatmentPlansCount' => $allRequestedTreatmentPlansCount,
                'allReConsultCount' => $allReConsultCount,
                'allCompletedTreatmentPlansCount' => $allCompletedTreatmentPlansCount,
                'requested_treatment_plans' => $requested_treatment_plans,
                'reconsult_treatment_plans' => $reconsult_treatment_plans,
                'completed_treatment_plans' => $completed_treatment_plans
            );

            return view('doctor.home')->with($doctor_dashboard);
        }

        else if ($user->hasRole('Sales Person')){
            
            $requestedTreatmentPlansTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '1')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->count();

            $reConsultTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '3')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->count();

            $completedTreatmentPlansTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '2')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->count();
     
            $requested_treatment_plans = TreatmentPlan::orderBy('created_at', 'DESC')
                ->where('treatment_plans.treatment_plan_status_id', '=', '1')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->get();

            $re_consult_treatment_plans = TreatmentPlan::orderBy('created_at', 'DESC')
                ->where('treatment_plans.treatment_plan_status_id', '=', '3')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->get();

            $completed_treatment_plans = TreatmentPlan::orderBy('created_at', 'DESC')
                ->where('treatment_plans.treatment_plan_status_id', '=', '2')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->get();

            $allRequestedTreatmentPlansCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '1')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->count();

            $allReConsultCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '3')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->count();

            $allCompletedTreatmentPlansCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '2')
                ->where('treatment_plans.user_id', '=', $user->id)
                ->count();

            $sales_person_dashboard = array(
                'requestedTreatmentPlansTodayCount' => $requestedTreatmentPlansTodayCount,
                'reConsultTodayCount' => $reConsultTodayCount,
                'completedTreatmentPlansTodayCount' => $completedTreatmentPlansTodayCount,
                'allRequestedTreatmentPlansCount' => $allRequestedTreatmentPlansCount,
                'allReConsultCount' => $allReConsultCount,
                'allCompletedTreatmentPlansCount' => $allCompletedTreatmentPlansCount,
                'requested_treatment_plans' => $requested_treatment_plans,
                're_consult_treatment_plans' => $re_consult_treatment_plans,
                'completed_treatment_plans' => $completed_treatment_plans
            );
            return view('sales.home')->with($sales_person_dashboard);
        }

        else if ($user->hasRole('Sales Admin')){

            $treatmentPlanCount = TreatmentPlan::count();
            $patientCount = Patient::count();
            $userCount = User::count();

            $requestedTreatmentPlansTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '1')
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->count();

            $allRequestedTreatmentPlansCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '1')
                ->count();

            $reConsultTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '3')
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->count();

            $reConsultCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '3')
                ->count();

            $completedTreatmentPlansTodayCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '2')
                ->whereBetween('treatment_plans.created_at', [Carbon::today('Europe/Istanbul'), Carbon::tomorrow('Europe/Istanbul')])
                ->count();

            $allCompletedTreatmentPlansCount = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '2')
                ->count();

            $requested_treatment_plans = TreatmentPlan::whereDate('created_at', Carbon::today())
                ->where('treatment_plans.treatment_plan_status_id', '=', '1')
                ->get();

            $reconsult_treatment_plans = TreatmentPlan::whereDate('created_at', Carbon::today())
                ->where('treatment_plans.treatment_plan_status_id', '=', '3')
                ->get();

            $completed_treatment_plans = TreatmentPlan::whereDate('created_at', Carbon::today())
                ->where('treatment_plans.treatment_plan_status_id', '=', '2')
                ->get();

            $sales_admin_dashboard = array('requestedTreatmentPlansTodayCount' => $requestedTreatmentPlansTodayCount,
                'completedTreatmentPlansTodayCount' => $completedTreatmentPlansTodayCount,
                'allRequestedTreatmentPlansCount' => $allRequestedTreatmentPlansCount,
                'allCompletedTreatmentPlansCount' => $allCompletedTreatmentPlansCount,
                'reConsultTodayCount' => $reConsultTodayCount,
                'reConsultCount' => $reConsultCount,
                'requested_treatment_plans' => $requested_treatment_plans,
                'reconsult_treatment_plans' => $reconsult_treatment_plans,
                'completed_treatment_plans' => $completed_treatment_plans,
                'treatmentPlanCount' => $treatmentPlanCount,
                'patientCount' => $patientCount,
                'userCount' => $userCount
            );
            return view('salesadmin.home')->with($sales_admin_dashboard);
        }

        else {
            return "";
        }
    }
}
