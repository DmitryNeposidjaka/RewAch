<?php


class AchievementsTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $user = \App\Models\User::where('email', 'admin@mail.com')->first();

        factory(\App\Models\Achievement::class, 3)->create()->each(function ($achievement) use ($user) {
            /**
             * @var \App\Models\Achievement $achievement
             */
            $achievement->authoredBy()->associate($user)->save();
        });
    }
}