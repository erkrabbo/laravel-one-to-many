<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $posts = factory('App\Post', 2000)->create();
        for ($i=0; $i < 2000; $i++) {
            $title = $faker->word;
            Post::create([
                'title'     => $title,
                'content'   => $faker->text(rand(200, 1000)),
                'slug'      => Post::generateSlug($title),
                'user_id'   => User::inRandomOrder()->first()->id
            ]);
        }
    }
}
