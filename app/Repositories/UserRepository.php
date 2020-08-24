<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/24/20
 * Time: 4:26 PM
 */

namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;

    }

    public function getUsersByPaginations($page,$name)
    {
        if ($name!="") {

            User::where('name', 'like', '%' . $name . '%')->skip($page* 10)->take(10)->get();
        }

        $users = DB::table('users')->skip($page* 10)->take(10)->get();
        return $users;
    }
}
