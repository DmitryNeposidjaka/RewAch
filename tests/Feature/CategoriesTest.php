<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class CategoriesTest extends TestCase
{
    use WithFaker;

    /**
     * @var User|null
     */
    public $user;

    /**
     * @var Category|null
     */
    public $category;

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
        $categoryCreate = function () {
            $this->category = factory(Category::class, 1)->create()->pop();
        };
        $setUser = function () {
            $this->user = User::where('email', 'admin@mail.com')->first();
        };

        array_push($this->afterApplicationCreatedCallbacks, $achievementCreate, $setUser, $categoryCreate);
    }

    public function testAttachCategoryToAchievementSuccess()
    {
        $response = $this->actingAs($this->user, 'api')->post(route('achievement.attach.category', [
            'achievement' => $this->achievement->id,
            'category' => $this->category->id,
        ]));

        $response->assertStatus(200);
    }
}
