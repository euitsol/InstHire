<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobFairStallOption extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'institute_id',
        'stall_size',
        'maximum_representative',
        'description',
        'status',
        'creater_id',
        'updater_id',
        'deleter_id',
        'creater_type',
        'updater_type',
        'deleter_type',
    ];

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
}
