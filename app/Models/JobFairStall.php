<?php

namespace App\Models;

use App\Traits\AuditColumnsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobFairStall extends Model
{
    use HasFactory, SoftDeletes, AuditColumnsTrait;

    protected $fillable = [
        'job_fair_id',
        'job_fair_stall_option_id',
        'creater_id',
        'creater_type',
        'updater_id',
        'updater_type',
        'deleter_id',
        'deleter_type',
    ];

    public function jobFair()
    {
        return $this->belongsTo(JobFair::class);
    }

    public function stallOption()
    {
        return $this->belongsTo(JobFairStallOption::class, 'job_fair_stall_option_id');
    }
}
