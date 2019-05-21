<?php
/**
 * Created by PhpStorm.
 * User: @htinlynn
 * Date: 2019-05-15
 * Time: 17:12
 */

namespace App\GraphQL\Mutation\User;


use App\Repositories\UserRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser'
    ];

    /**
     * @return mixed
     * @throws \Exception
     */
    public function type()
    {
        return GraphQL::type('User');
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()]

        ];
    }

    /**
     * @return array
     */
    public function rules(array $args = [])
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'max:255']
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return mixed
     */
    public function resolve($root, $args)
    {
        $userRepo = new UserRepository();
        $args['password'] = bcrypt($args['password']);
        return $userRepo->createUser($args);
    }
}