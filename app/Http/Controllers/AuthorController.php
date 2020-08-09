<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends CoreController
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page');
        $name = $request->input('name');

        $result =$this->authorService->getAuthorList($name,$page);
        return $this->response($result);


    }

    public function detail($id)
    {
        return $this->authorService->getAuthorDetail($id);

    }
}
