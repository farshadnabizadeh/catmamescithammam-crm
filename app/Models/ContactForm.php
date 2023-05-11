<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ContactForm extends Model
{
    use SoftDeletes;
    protected $table = 'contact_forms';
    protected $fillable = ['name_surname','phone','country','email','form_status_id'];

    public function status()
    {
        return $this->belongsTo(FormStatuses::class, 'form_status_id');
    }
}
