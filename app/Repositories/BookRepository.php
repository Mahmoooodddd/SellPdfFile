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
use Illuminate\Support\Facades\DB;

class BookRepository extends CoreRepository
{

    protected $books;

    public function __construct(Book $books)
    {
        $this->books = $books;

    }


    public function getBooksByPaginations($page,$name)
    {
        if ($name!="") {

            Book::where('name', 'like', '%' . $name . '%')->skip($page* 10)->take(10)->get();
    }

        $books = DB::table('books')->skip($page* 10)->take(10)->get();
        return $books;

    }


    public function getBookById($id)
    {
        $book = $this->books->find($id);
        return $book;
    }

}
