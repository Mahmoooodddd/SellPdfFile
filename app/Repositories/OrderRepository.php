<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/16/20
 * Time: 1:06 PM
 */

namespace App\Repositories;


use App\Order;
use Illuminate\Support\Facades\DB;

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

    public function getOrdersByPaginations($page,$email,$userId,$status)
    {
        $orders = DB::table('orders')
            ->join('users','orders.user_id','=','users.id')
            ->select('orders.*','users.email as userEmail');
        if ($email != "") {
            $orders->where('users.email',$email);
        };
        if ($userId != "") {
            $orders->where('user_id', '=' ,$userId);
        }
        if ($status != "") {
            $orders->where('status', '=' ,$status);
        }
        $orders =$orders->skip($page * 10)->take(10)->get();
        return $orders;
    }

}
