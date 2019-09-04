<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class TagsTest extends TestCase
{
    use WithFaker;

    /**
     * @var User|null
     */
    public $user;

    /**
     * @var Tag|null
     */
    public $tag;

    /**
     * @var Achievement|null
     */
    public $achievement;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $achievementCreate = function () {
            $this->achievement = factory(Achievement::class, 1)->create()->pop();
        };
        $tagCreate = function () {
            $this->tag = factory(tag::class, 1)->create()->pop();
        };
        $setUser = function () {
            $this->user = User::where('email', 'admin@mail.com')->first();
        };

        array_push($this->afterApplicationCreatedCallbacks, $achievementCreate, $setUser, $tagCreate);
    }

    public function testCreateTagSuccess()
    {
        $response = $this->actingAs($this->user, 'api')->post(route('tag.create'), [
            'name' => $this->faker->name
        ]);

        $response->assertStatus(201);
    }

    public function testUpdateTagSuccess()
    {
        $response = $this->actingAs($this->user, 'api')->post(route('tag.update', [
            'tag' => $this->tag->id
        ]), [
            'name' => $this->faker->name
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteTagSuccess()
    {
        $response = $this->actingAs($this->user, 'api')->delete(route('tag.delete', [
            'tag' => $this->tag->id
        ]));

        $response->assertStatus(204);
    }

    public function testAttachTagToAchievementSuccess()
    {
        $response = $this->actingAs($this->user, 'api')->post(route('achievement.attach.tag', [
            'achievement' => $this->achievement->id,
            'entity' => $this->tag->id,
        ]));

        $response->assertStatus(200);
    }

    public function testDetachTagToAchievementSuccess()
    {
        $this->achievement->categories()->attach($this->tag->id);
        $response = $this->actingAs($this->user, 'api')->delete(route('achievement.detach.tag', [
            'achievement' => $this->achievement->id,
            'entity' => $this->tag->id,
        ]));

        $response->assertStatus(200);
    }
}
