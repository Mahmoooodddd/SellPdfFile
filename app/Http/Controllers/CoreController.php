<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:23 PM
 */

namespace App\Http\Controllers;


class CoreController extends Controller
{
    public function response($result)
    {
        return $this->response($result,$result['statusCode']);
    }

}
