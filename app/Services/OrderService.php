<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/16/20
 * Time: 1:05 PM
 */

namespace App\Services;


use App\Order;
use App\OrderBook;
use App\Traits\serviceResponseTrait;

class OrderService
{
    use serviceResponseTrait;
    protected $basketService;
    protected $bookService;
    protected $paymentService;


    public function __construct(BasketService $basketService,BookService $bookService,PaymentService $paymentService)
    {
        $this->basketService = $basketService;
        $this->bookService = $bookService;
        $this->paymentService = $paymentService;
    }

    public function createOrder($user)
    {
        $books = $this->basketService->getBasketBook();
        $order = new Order();
        $order->user_id = 1;
        $order->status = 'pending';
        $order->save();
        $booksData = $books['data'];
        if (!$booksData || empty($booksData)){
            return $this->error('empty basket',200);
        }
        $amount = 0;
        foreach ($booksData as $book){
            $orderBook = new OrderBook();
            $orderBook->book_id = $book['id'];
            $orderBook->order_id = $order->id;
            $amount+=$book['price'];
            $orderBook->save();
        }
        $paymentId=$this->paymentService->createPayment($user->id,$order->id,$amount);
        $this->basketService->removeBasket();
        return $this->success(['paymentId'=>$paymentId]);

    }

    public function updateOrderStatus(Order $order,$paymentStatus)
    {
        $order->status = $paymentStatus;
        $order->save();
    }

}
