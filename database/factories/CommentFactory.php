<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $posts = App\Post::pluck('id')->toArray();
    $users = App\User::pluck('id')->toArray();

    return [
        'text'    => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'post_id' => $faker->randomElement($posts),
        'user_id' => $faker->randomElement($users)
    ];
});
