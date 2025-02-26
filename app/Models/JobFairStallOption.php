<?php

namespace App\Models;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class JobFairStallOption extends BaseModel
{
    protected $filleable = [
        'stall_size',
        'maximum_representative',
        'description',
        'creater_id',
        'updater_id',
        'deleter_id',
        'status',
        'creater_type',
        'updater_type',
        'deleter_type',
    ];

}
