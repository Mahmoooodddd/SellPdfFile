<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/17/20
 * Time: 11:15 AM
 */

namespace App\Repositories;


use App\Payment;

class PaymentRepository
{
    protected $payments;

    public function __construct(Payment $payments)
    {
        $this->payments = $payments;

    }
    public function getPaymentId($paymentId)
    {
        $payment=$this->payments->find($paymentId);
        return $payment;
    }


    public function getPaymentById($paymentId)
    {
        $payment =$this->payments->find($paymentId);
        return $payment;
    }
}
