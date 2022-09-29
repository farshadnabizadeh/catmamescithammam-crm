<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ReservationComission extends Model
{
    use SoftDeletes;
    protected $table = 'reservations_comissions';

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    
    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }
}
