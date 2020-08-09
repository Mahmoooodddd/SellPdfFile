<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/9/20
 * Time: 1:32 PM
 */

namespace App\Repositories;


use App\Author;

class AuthorRepository
{

    protected $authors;

    public function __construct(Author $authors)
    {
        $this->authors = $authors;

    }


    public function getAuthorsByPaginations()
    {
        $authors = $this->authors::all();
        return $authors;
        
    }

}
