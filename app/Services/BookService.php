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
        return $this->bookRepository->getBooksByPaginations($page,$name);

    }

    public function getBookDetail($id)
    {
        if (!($book= $this->bookRepository->getBooksId($id))) {

            return $this->error(404, "not found");
        }

        return $this->bookRepository->getBooksId($id);

    }

}
