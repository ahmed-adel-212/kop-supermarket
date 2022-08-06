<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'street' => $faker->streetName,
        'building_number' => $faker->buildingNumber,
        'floor_number' => $faker->randomDigit,
        'landmark' => $faker->word,
        'city_id' => function() {
            return factory(App\Models\City::class)->create()->id;
        },
        'area_id' => function(){
            return factory(App\Models\Area::class)->create()->id;
        },
        'customer_id' => function(){
            return factory(App\Models\Customer::class)->create()->id;
        },
    ];
});
