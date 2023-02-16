<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MedicalForm extends Model
{
    use SoftDeletes;
    protected $table = 'medical_forms';
    protected $fillable = ['name_surname','phone','country','email','birthday','gender','therapist_gender','heart_problems','blood_pressure','varicose_veins','asthma','vertebral_problem','joint_problems','fractures','skin_allergies','lodine_allergies','hyperthyroidism','diabetes','epilepsy','pregnant','back_problems','covid','covid_note','surgery','surgery_note' ];

}
