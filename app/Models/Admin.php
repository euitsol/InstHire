<?php

namespace App\Models;

use DateTimeInterface;
use App\Models\AuthBaseModel;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends AuthBaseModel
{


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'phone',
        'gender',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

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
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //         'status' => 'integer',
    //         'created_at' => 'datetime',
    //         'updated_at' => 'datetime',
    //         'deleted_at' => 'datetime',
    //     ];
    // }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer',
        'gender' => 'integer',
    ];
}
