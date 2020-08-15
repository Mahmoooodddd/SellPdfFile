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


    public function getBooksByPaginations($page, $name, $authorId)
    {
        $books = DB::table('books')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->select('books.*', 'authors.name as authorName');
        if ($name != "") {
            $books->where('books.name', 'like', '%' . $name . '%');
        };
        if ($authorId != "") {
            $books->where('author_id', '=' ,$authorId);
        }
        $books =$books->skip($page * 10)->take(10)->get();
        return $books;

    }


    public function getBookById($id)
    {
        $book = $this->books->find($id);
        return $book;
    }

    public function getBooksByIds($ids)
    {
        $books = $this->books->whereIn('id', $ids)->get();
        return $books;
    }

}
