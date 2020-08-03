<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:42 PM
 */

namespace App\Repositories;


use App\Book;
use Illuminate\Http\Request;

class BookRepository extends CoreRepository
{

    protected $books;

    public function __construct(Book $books)
    {
        $this->books = $books;

    }


    public function getBooksByPaginations($page,$name)
    {

        $books=Book::latest()->paginate(2);

//        $books = $this->books->all();
        return $books;

    }

}
