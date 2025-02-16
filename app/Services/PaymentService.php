<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

class PaymentService
{
    /**
     * Get all payments.
     */
    public function getAllPayments(): Collection
    {
        return Payment::with(['institute', 'instituteSubscription.subscription'])->get();
    }
}
