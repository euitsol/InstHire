<?php

namespace App\Models;

use App\Traits\AuditColumnsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobFairRegistration extends Model
{
    use HasFactory, SoftDeletes, AuditColumnsTrait;

    protected $fillable = [
        'job_fair_id',
        'status',
        'creater_id',
        'creater_type',
    ];

    // Relationship with JobFair
    public function jobFair()
    {
        return $this->belongsTo(JobFair::class);
    }

}
