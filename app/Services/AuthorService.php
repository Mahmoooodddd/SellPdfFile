<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/9/20
 * Time: 1:32 PM
 */

namespace App\Services;


use App\Repositories\AuthorRepository;
use App\Traits\serviceResponseTrait;

class AuthorService
{
    use serviceResponseTrait;
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }



    public function getAuthorList($name,$page)
    {
        $authors =$this->authorRepository->getAuthorsByPaginations($name,$page);
        $data = [];
        foreach ($authors as $author) {
            $data[] = [
                'name' => $author->name,
            ];
        }
        return $this->success($data);
    }


    public function getAuthorDetail($id)
    {
        $author= $this->authorRepository->getAuthorById($id);

        if (!$author) {

            return $this->error(404, "not found");
        }
        $books =$author->books;
        $booksData = [];
        foreach ($books as $book) {
            $booksData[]= [
                'id' => $book->id,
                'name' => $book->name,
            ];
        }
            $data = [
                'name' => $author->name,
                "books" => $booksData,
            ];

        return $this->success($data);
//        $author= $this->authorRepository->getAuthorById($id);
//        return $author;


    }
}
