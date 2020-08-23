<?php

namespace App\Listeners;

use App\Events\PaymentStatusChangedEvent;
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

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->payment->order;
        $paymentStatus = $event->payment->status;
        $this->orderService->updateOrderStatus($order,$paymentStatus);
    }
}
