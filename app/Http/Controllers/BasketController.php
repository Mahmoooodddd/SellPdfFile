<?php

namespace App\Http\Controllers;

use App\Services\BasketService;
use Illuminate\Http\Request;

class basketController extends CoreController
{
    protected $basketService;

    public function __construct(BasketService $basketService)
    {
        $this->basketService = $basketService;
    }

    public function index()
    {
       return $this->basketService->getBasketBook();
    }

    public function add($id)
    {
        return $this->basketService->addToBasket($id);
    }

    public function delete($id)
    {
      return $this->basketService->deleteFromBasket($id);
    }
}
