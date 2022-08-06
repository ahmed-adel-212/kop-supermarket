<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        "name_ar" => $faker->words(2, true),
        "name_en" => $faker->words(2, true),
        "description_ar" => $faker->sentence,
        "description_en" => $faker->sentence,
    ];
});
