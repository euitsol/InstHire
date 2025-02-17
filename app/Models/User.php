<?php

namespace App\Models;

use App\Models\AuthBaseModel;

class User extends AuthBaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'image',
    //     'phone',
    //     'gender',
    //     'status',
    //     'verifier_type',
    //     'verifier_id',
    //     'verified_by_type',
    //     'verified_by_id',
    //     'creater_type',
    //     'creater_id',
    //     'updater_type',
    //     'updater_id',
    //     'deleter_type',
    //     'deleter_id'
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'creater_id' => 'integer',
        'updater_id' => 'integer',
        'deleter_id' => 'integer',
        'gender' => 'integer',
    ];
}
