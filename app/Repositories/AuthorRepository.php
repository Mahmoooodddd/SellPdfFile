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

class AuthorRepository extends CoreRepository
{

    protected $authors;

    public function __construct(Author $authors)
    {
        $this->authors = $authors;

    }


    public function getAuthorsByPaginations($name,$page)
    {
        $authors = DB::table('authors');
        if ($name!="") {

            $authors->where('name', 'like', '%' . $name . '%');
        }

        return $authors->skip($page* 10)->take(10)->get();

    }

    public function getAuthorById($id)
    {
        $author = $this->authors->find($id);
        return $author;
    }

}
