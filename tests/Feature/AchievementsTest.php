<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * Class AchievementsTest
 * @package Tests\Feature
 * @property User|null $user
 */
class AchievementsTest extends TestCase
{
    use WithFaker;

    public $user;


    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $setUser = function () {
            $this->user = User::where('email', 'admin@mail.com')->first();
        };

        //  Setting User for tests
        array_push($this->afterApplicationCreatedCallbacks, $setUser);
    }

    public function testCreateAchievementSuccess()
    {
        $response = $this->actingAs($this->user, 'api')->post(route('achievement.create'), [
            'name' => $this->faker->name,
            'description' => $this->faker->realText()
        ]);

        $response->assertStatus(200);
    }

    public function testCreateAchievementFails()
    {
        $response = $this->actingAs($this->user, 'api')->post(route('achievement.create'), [
            'description' => $this->faker->realText()
        ]);

        $response->assertStatus(302);
    }

    public function testGetAchievementsSuccess()
    {
        $response = $this->actingAs($this->user, 'api')->get(route('achievement.all'));

        $response->assertStatus(200);
    }


    public function testGetAchievementDetailSuccess()
    {
        $response = $this->actingAs($this->user, 'api')->get(route('achievement.all', ['id' => 1]));

        $response->assertStatus(200);
    }

    public function testDeleteAchievementSuccess()
    {
        $achievement = factory(Achievement::class)->create();

        $response = $this->actingAs($this->user, 'api')->delete(route('achievement.delete', ['id' => $achievement->id]));

        $response->assertStatus(200);
    }


}
