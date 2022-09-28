<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSource extends Model
{
    use SoftDeletes;
    protected $table = 'lead_sources';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
