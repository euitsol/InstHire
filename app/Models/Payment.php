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

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'institute_id'=> 'integer',
        'institute_subscription_id' => 'integer',
        'amount' => 'decimal:2',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'creater_id' => 'integer',
        'updater_id' => 'integer',
        'deleter_id' => 'integer',

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
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status === 1 ? 'Accepted' : 'Pending';
    }
}
