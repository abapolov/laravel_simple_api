<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();

    return [
        'title'   => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'content' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'user_id' => $faker->randomElement($users)
    ];
});
