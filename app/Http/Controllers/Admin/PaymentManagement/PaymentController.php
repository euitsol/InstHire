<?php

namespace App\Http\Controllers\Admin\PaymentManagement;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\View\View;

class PaymentController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the payments.
     */
    public function index(): View
    {
        $payments = $this->paymentService->getAllPayments();
        return view('admin.payment-management.payment.index', compact('payments'));
    }
}
