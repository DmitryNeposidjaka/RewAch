<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class AchievementsTest extends TestCase
{
    use WithFaker;

    public function testCreateAchievementSuccess()
    {
        /**
         * @var User $user
         */
        $user = User::where('email', 'admin@mail.com')->first();

        $response = $this->actingAs($user, 'api')->post(route('achievement.create'), [
            'name' => $this->faker->name,
            'description' => $this->faker->realText()
        ]);

        $response->assertStatus(200);
    }

    public function testCreateAchievementFails()
    {
        /**
         * @var User $user
         */
        $user = User::where('email', 'admin@mail.com')->first();

        $response = $this->actingAs($user, 'api')->post(route('achievement.create'), [
            'description' => $this->faker->realText()
        ]);

        $response->assertStatus(302);
    }

    public function testGetAchievementsSuccess()
    {
        /**
         * @var User $user
         */
        $user = User::where('email', 'admin@mail.com')->first();

        $response = $this->actingAs($user, 'api')->get(route('achievement.all'));

        $response->assertStatus(200);
    }


    public function testGetAchievementDetailSuccess()
    {
        /**
         * @var User $user
         */
        $user = User::where('email', 'admin@mail.com')->first();

        $response = $this->actingAs($user, 'api')->get(route('achievement.all', ['id' => 1]));

        $response->assertStatus(200);
    }

    public function testDeleteAchievementSuccess()
    {
        /**
         * @var User $user
         */
        $user = User::where('email', 'admin@mail.com')->first();

        $achievement = factory(Achievement::class)->create();

        $response = $this->actingAs($user, 'api')->delete(route('achievement.delete', ['id' => $achievement->id]));

        $response->assertStatus(200);
    }


}
