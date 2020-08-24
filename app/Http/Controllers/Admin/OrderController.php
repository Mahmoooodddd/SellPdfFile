<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/24/20
 * Time: 5:30 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CoreController;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends CoreController
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page');
        $email = $request->input('email');
        $userId = $request->input('user_id');
        $status = $request->input('status');

        $result =$this->orderService->getOrderList($page,$email,$userId,$status);
        return $this->response($result);
    }
}
