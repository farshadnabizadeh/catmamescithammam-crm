<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TreatmentPlanStatus extends Model
{
    use SoftDeletes;
    protected $table = 'treatment_plan_statuses';

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
