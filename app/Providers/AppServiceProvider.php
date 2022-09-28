<?php

namespace App\Providers;

use App\Models\User;
use App\Models\TreatmentPlan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $users = User::all();

        $user = auth()->user();

        $requested_count = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '1')->count();
        $reconsult_count = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '3')->count();
        $completed_count = TreatmentPlan::where('treatment_plans.treatment_plan_status_id', '=', '2')->count();

        $data = array('users' => $users, 'requested_count' => $requested_count, 'completed_count' => $completed_count, 'reconsult_count' => $reconsult_count);
        view()->share($data);
    }
}
