<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends BaseModel
{

    // visibility constants
    public const VISIBLE_PUBLIC = 1;
    public const VISIBLE_INSTITUTE = 0;

    // type constants
    public const TYPE_SELF = 1;
    public const TYPE_EXTERNAL = 0;

    //job type constants
    public const FULL_TIME = 1;
    public const PART_TIME = 2;
    public const WORK_FROM_HOME = 3;
    public const CONTRACTUAL = 4;
    public const INTERN = 5;

    // Salary type constants
    public const SALARY_PER_MONTH = 1;
    public const SALARY_PER_YEAR = 2;
    public const SALARY_NEGOTIABLE = 3;

    public const STATUS_PENDING = 0;
    public const STATUS_ACCEPTED = 1;
    public const STATUS_DECLINED = 2;
    public const STATUS_CLOSED = 3;

    protected $fillable = [
        'title',
        'company_name',
        'category_id',
        'visibility',
        'institute_id',
        'type',
        'employee_id',
        'application_url',
        'email',
        'job_type',
        'salary',
        'salary_type',
        'deadline',
        'vacancy',
        'company_address',
        'job_responsibility',
        'additional_requirement',
        'job_location',
        'other_benefits',
        'special_instractions',
        'educational_requirement',
        'professional_requirement',
        'experience_requirement',
        'age_requirement',
        'status',
        'notify',
        'email_subject',
        'email_body'
    ];

    protected $appends = [
        'visibility_label',
        'visibility_labels',
        'type_label',
        'type_labels',
        'job_type_label',
        'job_type_labels',
        'salary_type_label',
        'salary_type_labels',
        'job_status_label',
        'job_status_labels',
        'status_badge_color'
    ];

    public function getVisibilityLabels()
    {
        return [
            self::VISIBLE_PUBLIC => 'Public',
            self::VISIBLE_INSTITUTE => 'Institute',
        ];
    }

    public function getVisibilityLabelAttribute(): string
    {
        return $this->getVisibilityLabels()[$this->visibility] ?? 'Unknown';
    }

    public function getVisibilityLabelsAttribute(): array
    {
        return $this->getVisibilityLabels() ?? [];
    }

    public function getTypeLabels()
    {
        return [
            self::TYPE_SELF => 'Self',
            self::TYPE_EXTERNAL => 'External',
        ];
    }

    public function getTypeLabelAttribute(): string
    {
        return $this->getTypeLabels()[$this->type] ?? 'Unknown';
    }

    public function getTypeLabelsAttribute(): array
    {
        return $this->getTypeLabels() ?? [];
    }

    public function getJobTypeLabels()
    {
        return [
            self::FULL_TIME => 'Full Time',
            self::PART_TIME => 'Part Time',
            self::WORK_FROM_HOME => 'Work From Home',
            self::CONTRACTUAL => 'Contractual',
            self::INTERN => 'Intern',
        ];
    }

    public function getJobTypeLabelAttribute(): string
    {
        return self::getJobTypeLabels()[$this->job_type] ?? 'Unknown';
    }
public function getJobTypeLabelsAttribute(): array
    {
        return self::getJobTypeLabels() ?? [];
    }

    public function getSalaryTypeLabels()
    {
        return [
            self::SALARY_PER_MONTH => 'Per Month',
            self::SALARY_PER_YEAR => 'Per Year',
            self::SALARY_NEGOTIABLE => 'Negotiable',
        ];
    }

    public function getSalaryTypeLabelAttribute(): string
    {
        return self::getSalaryTypeLabels()[$this->salary_type] ?? 'Unknown';
    }

    public function getSalaryTypeLabelsAttribute(): array
    {
        return self::getSalaryTypeLabels() ?? [];
    }

    public function getJobStatusLabels()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_DECLINED => 'Declined',
            self::STATUS_CLOSED => 'Closed',
        ];
    }
    public function getJobStatusBadgeColors()
    {
        return [
            self::STATUS_PENDING => 'badge bg-warning',
            self::STATUS_ACCEPTED => 'badge bg-success',
            self::STATUS_DECLINED => 'badge bg-danger',
            self::STATUS_CLOSED => 'badge bg-secondary',
        ];
    }

    public function getJobStatusBadgeColorAttribute(): string
    {
        return self::getJobStatusBadgeColors()[$this->status] ?? 'Unknown';
    }
    public function getJobStatusLabelAttribute(): string
    {
        return self::getJobStatusLabels()[$this->status] ?? 'Unknown';
    }

    public function getJobStatusLabelsAttribute(): array
    {
        return self::getJobStatusLabels() ?? [];
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }
}
