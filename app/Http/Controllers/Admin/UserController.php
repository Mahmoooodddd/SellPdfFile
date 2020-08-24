<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/24/20
 * Time: 4:25 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CoreController;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends CoreController
{
    protected $userService;


    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page');
        $name = $request->input('name');

        $result =$this->userService->getUserList($page,$name);
        return $this->response($result);
    }
}
