<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends AuthBaseModel
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
        'image',
        'phone',
        'gender',
        'status',
        'verified_by_type',
        'verified_by_id',
        'creater_type',
        'creater_id',
        'updater_type',
        'updater_id',
        'deleter_type',
        'deleter_id',
        'session_id',
        'department_id',
        'institute_id',
        'roll',
        'registration',
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
        'verified_by_id' => 'integer',
    ];

    /**
     * Get the verified by that owns the employee
     */
    public function verified_by()
    {
        return $this->morphTo();
    }


    // Status constants
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_DECLINED = 2;

    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_DECLINED => 'Declined',
        ];
    }
    // Accessor for status label
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusLabels()[$this->status] ?? 'Unknown';
    }
    // Status badge colors
    public static function getStatusBadgeColors(): array
    {
        return [
            self::STATUS_PENDING => 'badge bg-info',
            self::STATUS_ACCEPTED => 'badge bg-success',
            self::STATUS_DECLINED => 'badge bg-danger',
        ];
    }
    // Accessor for status badge color
    public function getStatusBadgeColorAttribute(): string
    {
        return self::getStatusBadgeColors()[$this->status] ?? 'badge bg-secondary';
    }

    public function session()
    {
        return $this->belongsTo(InstituteSession::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
