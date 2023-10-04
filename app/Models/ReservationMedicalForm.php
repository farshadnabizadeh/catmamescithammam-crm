<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationMedicalForm extends Model
{
    use HasFactory;

    protected $table = 'reservations_medical_forms';

    public function medicalForm()
    {
        return $this->belongsTo(MedicalForm::class, 'medical_form_id');
    }
}
