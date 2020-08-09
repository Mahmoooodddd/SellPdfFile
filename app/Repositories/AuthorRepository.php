<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/9/20
 * Time: 1:32 PM
 */

namespace App\Repositories;


use App\Author;
use Illuminate\Support\Facades\DB;

class AuthorRepository
{

    protected $authors;

    public function __construct(Author $authors)
    {
        $this->authors = $authors;

    }


    public function getAuthorsByPaginations($name,$page)
    {
        if ($name!="") {

            Author::where('name', 'like', '%' . $name . '%')->skip($page* 10)->take(10)->get();
        }

        $authors = DB::table('authors')->skip($page* 10)->take(10)->get();
        return $authors;

    }

    public function getAuthorById($id)
    {
        $author = $this->authors->books()->find($id);
        return $author;
    }

}
