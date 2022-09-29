<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationService extends Model
{
    use HasFactory;

    protected $table = 'reservations_services';

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
