<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/16/20
 * Time: 1:06 PM
 */

namespace App\Repositories;


use App\Order;

class OrderRepository
{
    protected $orders;

    public function __construct(Order $orders)
    {
        $this->orders = $orders;

    }
    public function getUserOrders($user)
    {
        return  $this->orders::where("user_id",$user->id)->with('orderBooks')->get();
    }

}
