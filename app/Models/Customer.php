<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Customer extends Model
{
    use SoftDeletes;
    protected $table = 'customers';

    public function sob()
    {
        return $this->belongsTo(Source::class, 'customer_sob_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
