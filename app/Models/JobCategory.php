<?php

namespace App\Models;

class JobCategory extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'status',
        'creater_id',
        'updater_id',
        'deleter_id',
        'creater_type',
        'updater_type',
        'deleter_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $casts = [
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'creater_id' => 'integer',
        'updater_id' => 'integer',
        'deleter_id' => 'integer',
    ];


}
