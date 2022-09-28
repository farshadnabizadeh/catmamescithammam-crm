<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PatientPhoto extends Model
{
    use SoftDeletes;
    protected $table = 'patients_photos';
    protected $fillable = [
        'photo_path', 'patient_id'
    ];

    public function record()
    {
        return $this->belongsTo(PatientPhoto::class);
    }
}
