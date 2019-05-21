<?php
/**
 * Created by PhpStorm.
 * User: @htinlynn
 * Date: 2019-05-15
 * Time: 17:13
 */

namespace App\GraphQL\Query\User;

use GraphQL\Type\Definition\ListOfType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Query;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users'
    ];

    /**
     * @return ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(GraphQL::type('User'));
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return User[]|Collection
     */
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return User::where('id' , $args['id'])->get();
        } else if(isset($args['email'])) {
            return User::where('email', $args['email'])->get();
        } else {
            return User::all();
        }
    }
}