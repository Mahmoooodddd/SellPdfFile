<?php

namespace App\Listeners;

use App\Events\PaymentStatusChangedEvent;
use App\Services\MailerService;
use App\Services\OrderService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentStatusChangedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $orderService;
    protected $mailerService;

    public function __construct(OrderService $orderService,MailerService $mailerService)
    {
        $this->orderService = $orderService;
        $this->mailerService = $mailerService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $payment = $event->payment;
        $order =$payment->order;
        $paymentStatus = $event->payment->status;
        $this->orderService->updateOrderStatus($order,$paymentStatus);
        $this->mailerService->sendMailToUserForPayment($payment);
    }
}
