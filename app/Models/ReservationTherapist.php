<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTherapist extends Model
{
    use HasFactory;

    protected $table = 'reservations_therapists';

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }
}
