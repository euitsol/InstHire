<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobFairStallOption extends BaseModel
{
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
