<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Photo;
use App\User;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            //prendiamo un utente a caso esistente
            $user = User::inRandomOrder()->first();

            //prendo i post associati a questo utente
            $posts = $user->posts;
            $rand = rand(0, count($posts) - 1);


            $newPhoto = new Photo;
            $newPhoto->path = $faker->imageUrl(640, 480);
            $newPhoto->title = $faker->text(50);
            $newPhoto->user_id = $user->id;
            $newPhoto->post_id = $user->posts[$rand]->id;

            $newPhoto->save();
        }
    }
}
