<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/15/20
 * Time: 10:48 AM
 */

namespace App\Services;
use App\Traits\serviceResponseTrait;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

class BasketService
{
    use serviceResponseTrait;
    protected $session;
    
    public function __construct(Store $session){

        $this->session =$session;
    }


    public function addToBasket($id)
    {
        $ids =$this->session->get('ids');
        if(!$ids || empty($ids)){
            $ids=[];
            $ids[]=$id;
        }else{
            if(!in_array($id,$ids)){
                $ids[]=$id;
            }
        }
        $this->session->put('ids',$ids);
        return $this->success();

    }
}
