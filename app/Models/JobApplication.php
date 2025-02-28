<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory, SoftDeletes;

    // Status Constants
    public const STATUS_APPLIED = 0;
    public const STATUS_SHORTLISTED = 1;
    public const STATUS_REJECTED = -1;
    public const STATUS_CALLED_FOR_INTERVIEW = 2;
    public const STATUS_INTERVIEWED = 3;
    public const STATUS_ACCEPTED = 4;

    protected $fillable = [
        'job_post_id',
        'student_id',
        'cv_id',
        'status',
        'applicant_name',
        'applicant_email',
        'applicant_phone',
        'degree',
        'institute',
        'result',
        'cover_letter'
    ];

    protected $appends = [
        'status_color',
        'status_label'
    ];

    // Relationships
    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(JobPost::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function cv(): BelongsTo
    {
        return $this->belongsTo(Cvs::class);
    }

    // Status Color and Label Accessors
    public function getStatusColors()
    {
        return [
            self::STATUS_APPLIED => 'primary',
            self::STATUS_SHORTLISTED => 'info',
            self::STATUS_REJECTED => 'danger',
            self::STATUS_CALLED_FOR_INTERVIEW => 'warning',
            self::STATUS_INTERVIEWED => 'secondary',
            self::STATUS_ACCEPTED => 'success',
        ];
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_APPLIED => 'Applied',
            self::STATUS_SHORTLISTED => 'Shortlisted',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_CALLED_FOR_INTERVIEW => 'Interview Call',
            self::STATUS_INTERVIEWED => 'Interviewed',
            self::STATUS_ACCEPTED => 'Accepted',
        ];
    }

    public function getStatusColorAttribute(): string
    {
        return $this->getStatusColors()[$this->status] ?? 'secondary';
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->getStatusLabels()[$this->status] ?? 'Unknown';
    }
}
