<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $randNumber = rand(1, 3);
            $newPost = new Post;
            $newPost->title = $faker->text(100);
            $newPost->body = $faker->text(200);
            $newPost->user_id = $randNumber;
            $newPost->save();
        }
    }
}
