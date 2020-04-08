<?php

use Illuminate\Database\Seeder;
use App\Avatar;
use App\User;
use Faker\Generator as Faker;


class AvatarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // one to one
        $users = User::all();
        foreach ($users as $user) {
            $newAvatar = new Avatar;
            $newAvatar->path = $faker->imageUrl(640, 480);
            $newAvatar->user_id =  $user->id;
            $newAvatar->save();
        }
    }
}
