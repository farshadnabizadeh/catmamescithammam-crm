<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPaymentType extends Model
{
    use HasFactory;

    protected $table = 'reservations_payments_types';
    protected $fillable = ['reservation_id', 'payment_type_id', 'payment_price', 'user_id' ];

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
