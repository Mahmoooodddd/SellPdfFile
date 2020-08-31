<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/9/20
 * Time: 1:32 PM
 */

namespace App\Repositories;


use App\Author;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\DB;

class AuthorRepository extends CoreRepository
{

    protected $authors;
    protected $cacheManager;


    public function __construct(Author $authors,CacheManager $cacheManager)
    {
        $this->authors = $authors;
        $this->cacheManager = $cacheManager;
    }

    public function getAuthorsByPaginations($name,$page)
    {
        $data=$this->cacheManager->remember('authors'.$name.$page,600,function ()use ($name,$page){
            $authors = DB::table('authors');
            if ($name!="") {

                $authors->where('name', 'like', '%' . $name . '%');
            }

            return $authors->skip($page* 10)->take(10)->get();
        });
        return $data;

    }

    public function getAuthorById($id)
    {
        $data=$this->cacheManager->remember('authors'.$id,600, function () use($id){
            return $this->authors::with('books')->find($id);
        });
        return $data;
    }

}
