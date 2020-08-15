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


    public function getBookList($page,$name,$authorId)
    {
        $books =$this->bookRepository->getBooksByPaginations($page,$name,$authorId);
        $data = [];
        foreach ($books as $book) {
            $data[] = [
                'name' => $book->name,
                'price' => $book->price,
                'authorId' => $book->author_id,
                'authorName' => $book->authorName,
            ];
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
             'authorName' => $book->author->name,
             ];
        return $this->success($data);

//        return $this->bookRepository->getBooksId($id);

    }

    public function getBookById()
    {
        return $this->bookRepository->getBookById();
        
    }

}
