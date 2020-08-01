<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:43 PM
 */

namespace App\Services;


use App\Repositories\BookRepository;

class BookService
{
    protected $bookRepository;


    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    public function getBookList()
    {
        dd('test');
    }

}
