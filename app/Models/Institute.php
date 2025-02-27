<?php

namespace App\Models;

use App\Models\AuthBaseModel;
use App\Notifications\InstituteResetPasswordNotification;
use DateTimeInterface;
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'creater_id' => 'integer',
        'updater_id' => 'integer',
        'deleter_id' => 'integer',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new InstituteResetPasswordNotification($token));
    }

    /**
     * Get the institute's subscriptions.
     */
    public function instituteSubscriptions()
    {
        return $this->hasMany(InstituteSubscription::class);
    }
}
