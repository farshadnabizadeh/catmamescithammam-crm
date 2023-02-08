<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Whatsapp extends Model
{
    use SoftDeletes;
    protected $table = 'whatsapp_numbers';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
