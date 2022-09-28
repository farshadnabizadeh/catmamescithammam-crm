<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TreatmentPlanPhoto extends Model
{
    use SoftDeletes;

    protected $table = 'treatment_plans_photos';

    public function treatmentPlan()
    {
        return $this->belongsTo(TreatmentPlan::class,'treatment_plan_id');
    }
}
