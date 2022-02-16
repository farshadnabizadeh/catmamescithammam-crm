<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';

    public function customer()
    {
        return $this->belongsTo(Source::class, 'customer_id');
    }

}
