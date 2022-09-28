<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MedicalSubDepartment extends Model
{
    use SoftDeletes;
    protected $table = 'medical_sub_departments';

    public function parentDepartment()
    {
        return $this->belongsTo(MedicalDepartment::class,'medical_department_id');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'medical_sub_departments_doctors', 'medical_sub_department_id', 'doctor_id');
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
