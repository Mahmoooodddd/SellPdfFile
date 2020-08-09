<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:44 PM
 */

namespace App\Http\Controllers;


use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends CoreController
{
    protected $bookService;


    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page');
        $name = $request->input('name');
        $authorId = $request->input('author_id');

        $result =$this->bookService->getBookList($page,$name,$authorId);
        return $this->response($result);

    }

    public function detail($id)
    {
        $result= $this->bookService->getBookDetail($id);
        return $this->response($result);
    }
    

}
