<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        "name_ar" => $faker->word,
        "name_en" => $faker->word,
        "description_ar" => $faker->word,
        "description_en" => $faker->word
    ];
});
