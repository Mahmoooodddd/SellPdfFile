<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/17/20
 * Time: 11:16 AM
 */

namespace App\Services;


use App\Events\PaymentStatusChangedEvent;
use App\Payment;
use App\Repositories\PaymentRepository;
use App\Traits\serviceResponseTrait;
use Illuminate\Events\Dispatcher;
class PaymentService
{

    use serviceResponseTrait;
    protected $paymentRepository;
    protected $dispatcher;

    public function __construct(PaymentRepository $paymentRepository,Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment($userId,$orderId,$amount)
    {
        $payment = new Payment();
        $payment->user_id = $userId;
        $payment->order_id =$orderId;
        $payment->amount = $amount;
        $payment->status = 'pending';
        $payment->save();

        return $payment->id;
    }

    public function getPaymentById($paymentId)
    {
        $payment=$this->paymentRepository->getPaymentById($paymentId);

        $data = [
            'amount' => $payment->amount
        ];
        return $this->success($data);
    }

    public function handlePaymentStatus($paymentId,$status)
    {
        $payment = $this->paymentRepository->getPaymentById($paymentId);

        if (!$payment) {

            return $this->error(404, "not found");
        }
        $payment->status = $status;
        $payment->save();

        $event= new PaymentStatusChangedEvent($payment);
        $this->dispatcher->dispatch($event);
        return $this->success([]);
    }

}
