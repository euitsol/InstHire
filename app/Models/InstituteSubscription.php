<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Institute;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstituteSubscription extends BaseModel
{
    protected $fillable = [
        'institute_id',
        'subscription_id',
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
        'institute_id'=> 'integer',
        'subscription_id' => 'integer',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'creater_id' => 'integer',
        'updater_id' => 'integer',
        'deleter_id' => 'integer',

    ];

    /**
     * Get the institute that owns the subscription.
     */
    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    /**
     * Get the subscription that owns the institute subscription.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status ? 'Current' : 'Previous';
    }
}
