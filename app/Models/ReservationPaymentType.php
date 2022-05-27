<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPaymentType extends Model
{
    use HasFactory;

    protected $table = 'reservations_payments_types';
}
