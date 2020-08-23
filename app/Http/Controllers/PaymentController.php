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
        $result =$this->paymentService->getPaymentId($paymentId);
         return $this->response($result);

    }

    public function callback($paymentId,$status)
    {
         $result = $this->paymentService->handlePaymentStatus($paymentId,$status);
        return $this->response($result);
    }
}
