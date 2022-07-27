<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BookingForm extends Model
{
    use SoftDeletes;
    protected $table = 'booking_forms';

    public function status()
    {
        return $this->belongsTo(FormStatuses::class, 'form_status_id');
    }
}
