<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Payment extends Model
{
    use SoftDeletes;
    protected $table = 'payments';

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
}
