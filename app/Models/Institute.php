<?php

namespace App\Models;

use App\Models\AuthBaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institute extends AuthBaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'valid_to',
        'responsible_person_name',
        'responsible_person_phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'valid_to' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
