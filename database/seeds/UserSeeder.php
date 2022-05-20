<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 100; $i++) {
            User::create([
                'name'          => $faker->name,
                'email'         => $faker->unique()->safeEmail,
                'password'      => Hash::make('ciaociao')
            ]);
        }
    }
}
