<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use SoftDeletes;
    protected $table = 'discounts';

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
