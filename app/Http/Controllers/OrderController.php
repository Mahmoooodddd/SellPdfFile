<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends CoreController
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $user =$this->getUser();
        $result =$this->orderService->getUserOrdersList($user);
        return $this->response($result);
    }

    public function create()
    {
        $user=$this->getUser();
        return $this->orderService->createOrder($user);

    }
}
