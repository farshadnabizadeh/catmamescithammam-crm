<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use SoftDeletes;
    protected $table = 'countries';

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
