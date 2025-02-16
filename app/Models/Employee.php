<?php

namespace App\Models;

use App\Models\AuthBaseModel;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\AdminResetPasswordNotification;

class Employee extends AuthBaseModel
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
        'verifier_type',
        'verifier_id',
        'verified_by_type',
        'verified_by_id',
        'creater_type',
        'creater_id',
        'updater_type',
        'updater_id',
        'deleter_type',
        'deleter_id'
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'status' => 'integer',
        ];
    }
    /**
     * Get the verifier that owns the employee
     */
    public function verifier()
    {
        return $this->morphTo();
    }

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
              self::STATUS_PENDING => 'badge bg-secondary',
              self::STATUS_ACCEPTED => 'badge bg-success',
              self::STATUS_DECLINED => 'badge bg-danger',
          ];
      }
  // Accessor for status badge color
      public function getStatusBadgeColorAttribute(): string
      {
          return self::getStatusBadgeColors()[$this->status] ?? 'badge bg-secondary';
      }
}
