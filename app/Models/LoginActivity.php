<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;

    protected $fillable=[
        'ip',
        'user_id',
        'login_at',
        'country_code',
        'city',
        'latitude',
        'longitude',
    ];
}
