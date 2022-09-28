<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MedicalDepartment extends Model
{
    use SoftDeletes;

    protected $table = 'medical_departments';

}
