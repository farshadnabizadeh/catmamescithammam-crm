<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    public function sob()
    {
        return $this->belongsTo(Source::class, 'customer_sob_id');
    }

}
