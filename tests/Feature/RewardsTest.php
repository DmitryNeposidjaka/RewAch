<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

/**
 * Class RewardsTest
 * @package Tests\Feature
 */
class RewardsTest extends TestCase
{
    /**
     * @var Collection|null
     */
    public $achievements;
    /**
     * @var User|null
     */
    public $user;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $achievementsCreate = function () {
            $this->achievements = factory(Achievement::class, 3)->create();
        };
        $setUser = function () {
            $this->user = User::where('email', 'admin@mail.com')->first();
        };

        array_push($this->afterApplicationCreatedCallbacks, $achievementsCreate, $setUser);
    }


    public function testRewardCreateSuccess()
    {
        /**
         * @var Achievement $achievement
         */
        $achievement = $this->achievements->first();
        $response = $this->actingAs($this->user, 'api')->post(route('reward.create', [
            'achievement' => $achievement->id,
            'user' => $this->user->id,
        ]));
        $response->assertStatus(201);
    }

    public function testRewardDeleteSuccess()
    {
        /**
         * @var Achievement $achievement
         */
        $achievement = $this->achievements->first();
        Reward::create([
            'user_id' => $this->user->id,
            'achievement_id' => $achievement->id,
            'approved' => true
        ]);
        $response = $this->actingAs($this->user, 'api')->post(route('reward.delete', [
            'achievement' => $achievement->id,
            'user' => $this->user->id,
        ]));
        $response->assertStatus(204);
    }


}
