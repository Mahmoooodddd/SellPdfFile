<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends CoreController
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }


    public function show($paymentId)
    {
        $result =$this->paymentService->getPaymentById($paymentId);
         return $this->response($result);

    }

    public function callback($paymentId)
    {
         $result = $this->paymentService->handlePaymentStatus($paymentId);
        return $this->response($result);
    }
}
