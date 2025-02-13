<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Institute;
use App\Models\InstituteSubscription;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends BaseModel
{
    protected $fillable = [
        'institute_id',
        'institute_subscription_id',
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the institute that owns the payment.
     */
    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    /**
     * Get the institute subscription that owns the payment.
     */
    public function instituteSubscription(): BelongsTo
    {
        return $this->belongsTo(InstituteSubscription::class)->where('status', 1);
    }

    /**
     * Get the formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        return '৳' . number_format($this->amount, 2);
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status === 1 ? 'Accepted' : 'Pending';
    }
}
