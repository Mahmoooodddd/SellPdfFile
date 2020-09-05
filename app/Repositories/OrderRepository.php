<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/16/20
 * Time: 1:06 PM
 */

namespace App\Repositories;


use App\Order;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    protected $orders;
    protected $cacheManager;


    public function __construct(Order $orders,CacheManager $cacheManager)
    {
        $this->orders = $orders;
        $this->cacheManager = $cacheManager;


    }
    public function getUserOrders($user)
    {
        $data=$this->cacheManager->remember('orders'.$user->id,600,function () use($user) {

            return $this->orders::where("user_id", $user->id)->with('orderBooks')->get();
        });
        return $data;
    }

    public function getOrdersByPaginations($page,$email,$userId,$status)
    {
        $data=$this->cacheManager->remember('orders'.$page.$email.$userId.$status,600,function () use ($page,$email,$userId,$status) {


            $orders = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.*', 'users.email as userEmail');
            if ($email != "") {
                $orders->where('users.email', $email);
            };
            if ($userId != "") {
                $orders->where('user_id', '=', $userId);
            }
            if ($status != "") {
                $orders->where('status', '=', $status);
            }
            $orders = $orders->skip($page * 10)->take(10)->get();
            return $orders;
        });
        return $data;
    }

}
