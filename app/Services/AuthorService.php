<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/9/20
 * Time: 1:32 PM
 */

namespace App\Services;


use App\Repositories\AuthorRepository;

class AuthorService
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }



    public function getAuthorList()
    {
        return $this->authorRepository->getAuthorsByPaginations();
    }

}
