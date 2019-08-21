<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Achievement;
use Faker\Generator as Faker;

$factory->define(Achievement::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->realText(),
        'active' => true
    ];
});
