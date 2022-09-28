<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use SoftDeletes;
    protected $table = 'agents';

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
