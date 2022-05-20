<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->word;
    return [
        'title' => $title,
        'content' => $faker->text,
        'slug'      => Post::generateSlug($title) // function not working in factory, using seeder only
    ];
});
