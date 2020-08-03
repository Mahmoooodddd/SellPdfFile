<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:43 PM
 */

namespace App\Services;


use App\Book;
use App\Repositories\BookRepository;
use App\Traits\serviceResponseTrait;
use Illuminate\Http\Request;

class BookService
{

    use serviceResponseTrait;
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    public function getBookList($page,$name)
    {
        $books =$this->bookRepository->getBooksByPaginations($page,$name);
        $data = [];
        foreach ($books as $book) {
            $data[] = [
                'name' => $book->name,
                'price' => $book->price,
            ];

//            return $this->bookRepository->getBooksByPaginations($page,$name);
        }
        return $this->success($data);

    }

    public function getBookDetail($id)
    {
        $book= $this->bookRepository->getBookById($id);

        if (!$book) {

            return $this->error(404, "not found");
        }
         $data = [
            'name' => $book->name,
            'price' => $book->price,
             ];
        return $this->success($data);

//        return $this->bookRepository->getBooksId($id);

    }

}
