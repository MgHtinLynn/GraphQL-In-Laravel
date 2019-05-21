<?php
/**
 * Created by PhpStorm.
 * User: @htinlynn
 * Date: 2019-05-15
 * Time: 17:15
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A user'
    ];

    /*
    * Uncomment following line to make the type input object.
    * http://graphql.org/learn/schema/#input-types
    */
    // protected $inputObject = true;

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    /**
     * @param $root
     * @param $args
     * @return string
     */
    protected function resolveEmailField($root, $args): string
    {
        return strtolower($root->email);
    }
}