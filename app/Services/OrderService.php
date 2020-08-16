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


    public function __construct(BasketService $basketService,BookService $bookService)
    {
        $this->basketService = $basketService;
        $this->bookService = $bookService;
    }

    public function createOrder($user)
    {
        $books = $this->basketService->getBasketBook();
        $order = new Order();
        $order->user_id = 1;
        $order->save();
        $booksData = $books['data'];
        if (!$booksData || empty($booksData)){
            return $this->error('empty basket',200);
        }
        foreach ($booksData as $book){
            $orderBook = new OrderBook();
            $orderBook->book_id = $book['id'];
            $orderBook->order_id = $order->id;
            $orderBook->save();
        }
        $this->basketService->removeBasket();
        return $this->success([]);

    }

}
