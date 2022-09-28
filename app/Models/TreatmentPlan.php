<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TreatmentPlan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'treatment_plans';
    protected $fillable = ['user_id', 'treatment_id', 'sales_person_id', 'duration_of_stay', 'hospitalization', 'total_price'];

    public function salesPerson()
    {
        return $this->belongsTo(SalesPerson::class, 'sales_person_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function status()
    {
        return $this->belongsTo(TreatmentPlanStatus::class, 'treatment_plan_status_id');
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class,'lead_source_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function photos()
    {
        return $this->hasMany(TreatmentPlanPhoto::class);
    }

    public function treatment()
    {
      return $this->belongsTo(Treatment::class, 'treatment_id');
    }

    public function recommendedTreatment()
    {
      return $this->belongsTo(Treatment::class, 'recommended_treatment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
