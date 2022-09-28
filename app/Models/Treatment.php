<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Treatment extends Model
{
    use SoftDeletes;

    protected $table = 'treatments';

    public function medicalDepartments()
    {
      return $this->hasOne('App\Models\MedicalDepartment', 'id', 'medical_department_id');
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
