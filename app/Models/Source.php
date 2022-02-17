<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Source extends Model
{
    use HasFactory;
    protected $table = 'sources';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
