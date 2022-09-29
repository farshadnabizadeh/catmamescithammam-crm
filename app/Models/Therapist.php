<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    use SoftDeletes;
    protected $table = 'therapists';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
