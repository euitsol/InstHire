<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Subscription extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'price',
        'validity',
        'status',
        'image',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'double',
        'validity' => 'integer',
        'status' => 'boolean',
    ];


    protected function getImageAttribute($image): string
    {
        return $image ? asset('storage/' . $image) : '';
    }

}
