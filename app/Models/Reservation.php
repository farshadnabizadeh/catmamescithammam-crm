<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Reservation extends Model
{
    use SoftDeletes;
    protected $table = 'reservations';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function sob()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }

    public function subCustomers()
    {
        return $this->belongsToMany(Customer::class, 'reservations_customers', 'reservation_id', 'customer_id')
            ->selectRaw('customers.*, reservations_customers.*');
    }

    public function subServices()
    {
        return $this->belongsToMany(Service::class, 'reservations_services', 'reservation_id', 'service_id')
            ->selectRaw('services.*, reservations_services.*');
    }

    public function subTherapists()
    {
        return $this->belongsToMany(Therapist::class, 'reservations_therapists', 'reservation_id', 'therapist_id')
            ->selectRaw('therapists.*, reservations_therapists.*');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
