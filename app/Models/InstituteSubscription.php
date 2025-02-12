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
    ];

    protected $casts = [
        'status' => 'boolean',
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
