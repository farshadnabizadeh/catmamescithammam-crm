<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Form extends Model
{
    use HasFactory;
    protected $table = 'forms';
    protected $appends = ['age'];

    public function salesPerson()
    {
        return $this->belongsTo(SalesPerson::class,'sales_person_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
