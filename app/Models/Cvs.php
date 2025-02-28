<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cvs extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'title',
        'file_path',
        'creater_id',
        'creater_type',
    ];


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
