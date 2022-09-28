<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    use SoftDeletes;
    protected $table = 'patients';

    public function agent()
    {
        return $this->belongsTo(Agent::class,'agent_id');
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class,'lead_source_id');
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function treatmentPlans()
    {
        return $this->hasMany(TreatmentPlan::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
