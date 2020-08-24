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
use App\Repositories\OrderRepository;
use App\Traits\serviceResponseTrait;

class OrderService
{
    use serviceResponseTrait;
    protected $basketService;
    protected $bookService;
    protected $paymentService;
    protected $orderRepository;


    public function __construct(BasketService $basketService,BookService $bookService,PaymentService $paymentService,OrderRepository $orderRepository)
    {
        $this->basketService = $basketService;
        $this->bookService = $bookService;
        $this->paymentService = $paymentService;
        $this->orderRepository = $orderRepository;
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

    public function getUserOrdersList($user)
    {
        $orders=$this->orderRepository->getUserOrders($user);
        $finalOrders=[];

        foreach ($orders as $order){
            $books=[];
            $orderId = $order->id;
            $orderBooks=$order->orderBooks;
            foreach ($orderBooks as $orderBook){
                $books[]=[
                  'id' => $orderBook->book->id,
                'name' => $orderBook->book->name,
                  'price' => $orderBook->book->price,
                ];
            }
            $finalOrders[]=[
                'orderId' => $order->id,
                'books' => $books,
            ];


        }
        return $this->success($finalOrders);



    }

}
