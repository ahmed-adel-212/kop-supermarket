<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        'city_id' => factory(App\Models\City::class)->create()->id,
        'name_ar' => $faker->city,
        'name_en' => $faker->city,
        'description_ar' => $faker->sentence,
        'description_ar' => $faker->sentence,
        'delivery_fees' => $faker->randomNumber(2),
        'min_delivery_ammount' => $faker->randomNumber(3)
    ];
});

