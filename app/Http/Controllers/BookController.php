<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:44 PM
 */

namespace App\Http\Controllers;


use App\Services\BookService;

class BookController extends CoreController
{
    protected $BookService;


    public function __construct(BookService $BookService)
    {
        $this->BookService = $BookService;
    }


    public function index()
    {
        
    }
    

}
