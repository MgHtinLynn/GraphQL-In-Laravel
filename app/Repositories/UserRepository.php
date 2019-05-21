<?php
/**
 * Created by PhpStorm.
 * User: @htinlynn
 * Date: 2019-05-15
 * Time: 17:19
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function createUser($data)
    {
        return User::create($data);
    }
}