<?php

namespace App\Models;

use App\Traits\AuditColumnsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobFair extends Model
{
    use HasFactory, SoftDeletes, AuditColumnsTrait;

    public const SCHEDULED = 1;
    public const ONGOING = 2;
    public const COMPLETED = 3;
    public const CANCELLED = 0;

    protected $fillable = [
        'institute_id',
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'maximum_companies',
        'status',
        'creater_id',
        'creater_type',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'maximum_companies' => 'integer',
        'status' => 'integer',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function stalls()
    {
        return $this->hasMany(JobFairStall::class);
    }

    public function stallOptions()
    {
        return $this->belongsToMany(JobFairStallOption::class, 'job_fair_stalls');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::SCHEDULED => __('Scheduled'),
            self::ONGOING => __('Ongoing'),
            self::COMPLETED => __('Completed'),
            self::CANCELLED => __('Cancelled'),
            default => __('Unknown'),
        };
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            self::SCHEDULED => 'primary',
            self::ONGOING => 'success',
            self::COMPLETED => 'info',
            self::CANCELLED => 'danger',
            default => 'secondary',
        };
    }

    public function isScheduled(): bool
    {
        return $this->status === self::SCHEDULED;
    }

    public function isOngoing(): bool
    {
        return $this->status === self::ONGOING;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::CANCELLED;
    }

    public function updateStatus(): void
    {
        $now = now();

        if ($this->isCancelled()) {
            return;
        }

        if ($now < $this->start_date) {
            $newStatus = self::SCHEDULED;
        } elseif ($now >= $this->start_date && $now <= $this->end_date) {
            $newStatus = self::ONGOING;
        } else {
            $newStatus = self::COMPLETED;
        }

        if ($this->status !== $newStatus) {
            $this->update(['status' => $newStatus]);
        }
    }
}
