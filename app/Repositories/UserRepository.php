<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/24/20
 * Time: 4:26 PM
 */

namespace App\Repositories;


use App\User;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $users;
    protected $cacheManager;


    public function __construct(User $users,CacheManager $cacheManager)
    {
        $this->users = $users;
        $this->cacheManager = $cacheManager;
    }

    public function getUsersByPaginations($page,$name)
    {
        $data = $this->cacheManager->remember('users'.$page.$name,600,function () use ($page,$name){

            $users = DB::table('users');
            if ($name!="") {

                $users->where('name', 'like', '%' . $name . '%');
            }

            return $users->skip($page* 10)->take(10)->get();
        });
        return $data;

    }
}
