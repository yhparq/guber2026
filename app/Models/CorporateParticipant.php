<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateParticipant extends Model
{
    protected $fillable = [
        'company_name',
        'ruc',
        'address',
        'contact_email',
        'contact_name',
        'contact_phone',
    ];
}
