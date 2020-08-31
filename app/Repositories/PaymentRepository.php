<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/17/20
 * Time: 11:15 AM
 */

namespace App\Repositories;


use App\Payment;
use Illuminate\Cache\CacheManager;

class PaymentRepository
{
    protected $payments;
    protected $cacheManager;


    public function __construct(Payment $payments,CacheManager $cacheManager)
    {
        $this->payments = $payments;
        $this->cacheManager = $cacheManager;
    }

    public function getPaymentById($paymentId)
    {
        $data=$this->cacheManager->remember('payment'.$paymentId,600,function () use ($paymentId) {
            $payment = $this->payments->find($paymentId);
            return $payment;
        });
        return $data;
    }
}
