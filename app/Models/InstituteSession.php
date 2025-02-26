<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteSession extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'institute_id'
    ];

    protected $table = 'institute_sessions';

    // Institute relationship
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
}
