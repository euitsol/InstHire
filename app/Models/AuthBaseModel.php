<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthBaseModel extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Status constants
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 2;

    // Gender constants
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_OTHERS = 3;

    protected $appends = ['status_label','status_labels', 'gender_label', 'gender_labels', 'status_badge_color', 'status_btn_color', 'status_btn_label', 'gender_badge_color'];

    // Status labels
    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DEACTIVE => 'Deactive',
        ];
    }
    public static function getStatusBtnLabels(): array
    {
        return [
            self::STATUS_ACTIVE => 'Deactive',
            self::STATUS_DEACTIVE => 'Active',
        ];
    }

    // Gender labels
    public static function getGenderLabels(): array
    {
        return [
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female',
            self::GENDER_OTHERS => 'Others',
        ];
    }

    // Accessor for status label
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusLabels()[$this->status] ?? 'Unknown';
    }

    public function getStatusLabelsAttribute(): array
    {
        return self::getStatusLabels();
    }
    public function getGenderLabelsAttribute(): array
    {
        return self::getGenderLabels();
    }
    // Accessor for status btn label
    public function getStatusBtnLabelAttribute(): string
    {
        return self::getStatusBtnLabels()[$this->status] ?? 'Unknown';
    }

    // Accessor for gender label
    public function getGenderLabelAttribute(): string
    {
        return self::getGenderLabels()[$this->gender] ?? 'Unknown';
    }


    // Status badge colors
    public static function getStatusBadgeColors(): array
    {
        return [
            self::STATUS_ACTIVE => 'badge bg-success', // Green for active
            self::STATUS_DEACTIVE => 'badge bg-warning', // Red for deactive
        ];
    }

    // Status btn colors
    public static function getStatusBtnColors(): array
    {
        return [
            self::STATUS_ACTIVE => 'btn btn-warning', // Green for active
            self::STATUS_DEACTIVE => 'btn btn-success', // Red for deactive
        ];
    }

    // Gender badge colors
    public static function getGenderBadgeColors(): array
    {
        return [
            self::GENDER_MALE => 'badge bg-primary',   // Blue for male
            self::GENDER_FEMALE => 'badge bg-warning', // Yellow for female
            self::GENDER_OTHERS => 'badge bg-info',    // Light blue for others
        ];
    }

    // Accessor for status badge color
    public function getStatusBadgeColorAttribute(): string
    {
        return self::getStatusBadgeColors()[$this->status] ?? 'badge bg-secondary';
    }

    // Accessor for status btn color
    public function getStatusBtnColorAttribute(): string
    {
        return self::getStatusBtnColors()[$this->status] ?? 'btn btn-secondary';
    }

    // Accessor for gender badge color
    public function getGenderBadgeColorAttribute(): string
    {
        return self::getGenderBadgeColors()[$this->gender] ?? 'badge bg-secondary';
    }

    public function created_admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function updated_admin()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
    public function deleted_admin()
    {
        return $this->belongsTo(Admin::class, 'deleted_by');
    }

    public function creater()
    {
        return $this->morphTo();
    }
    public function updater()
    {
        return $this->morphTo();
    }
    public function deleter()
    {
        return $this->morphTo();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function getImageAttribute($image): string
    {
        return auth_storage_url($image, $this);
    }
}
