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
        'image',
        'status',
        'slug',
        'creater_id',
        'updater_id',
        'deleter_id',
        'creater_type',
        'updater_type',
        'deleter_type',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'valid_to' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'integer',
    ];

    public function subscriptions()
    {
        return $this->hasMany(InstituteSubscription::class);
    }
}
