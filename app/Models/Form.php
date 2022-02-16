<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Form extends Model
{
    use HasFactory;
    protected $table = 'forms';
    protected $appends = ['age'];

    public function salesPerson()
    {
        return $this->belongsTo(SalesPerson::class,'sales_person_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class,'agent_id');
    }

    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class,'lead_source_id');
    }

    public function treatmentPlans()
    {
        return $this->hasMany(TreatmentPlan::class);
    }

    public function medicalHistories()
    {
        return $this->hasMany(MedicalHistory::class);
    }

    public function requestTreatments()
    {
        return $this->hasMany(RequestTreatment::class);
    }
}
