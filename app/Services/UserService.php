<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/24/20
 * Time: 4:25 PM
 */

namespace App\Services;


use App\Repositories\UserRepository;
use App\Traits\serviceResponseTrait;

class UserService
{
    use serviceResponseTrait;
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserList($page,$name)
    {
        $users = $this->userRepository->getUsersByPaginations($page,$name);
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
            ];
        }
        return $this->success($data);
    }
}
