<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{


    // Status constants
    public const STATUS_ACTIVE = 1;
    public const STATUS_DEACTIVE = 2;

    protected $appends = [
        'status_label','status_labels',
        'status_badge_color',
        'status_btn_color',
        'status_btn_label'
    ];

    protected function casts(): array
    {
        return [
            'status' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }


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

    // Accessor for status label
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusLabels()[$this->status] ?? 'Unknown';
    }
    // Accessor for status btn label
    public function getStatusBtnLabelAttribute(): string
    {
        return self::getStatusBtnLabels()[$this->status] ?? 'Unknown';
    }

    public function getStatusLabelsAttribute(): array
    {
        return self::getStatusLabels();
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
        return $date->format(timeFormat());

    }


}
