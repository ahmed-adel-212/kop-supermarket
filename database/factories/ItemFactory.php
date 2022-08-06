<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        "name_ar" => $faker->words(2, true),
        "name_en" => $faker->words(2, true),
        "description_ar" => $faker->sentence,
        "description_en" => $faker->sentence,
        "calories" => $faker->randomNumber(2),
        "price" => $faker->randomNumber(2),
        "category_id" => function() {
            return factory(App\Models\Category::class)->create()->id;
        }
    ];
});

