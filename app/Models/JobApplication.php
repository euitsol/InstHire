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
}
