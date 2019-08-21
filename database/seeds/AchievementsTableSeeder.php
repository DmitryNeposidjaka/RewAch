<?php


class AchievementsTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        factory(\App\Models\Achievement::class, 5)->create();
    }
}