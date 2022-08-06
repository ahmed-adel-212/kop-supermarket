<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {

    $serviceTypesArray = ['takeaway', 'delivery'];

    return [
        "name_ar" => $faker->word,
        "name_en" => $faker->word,
        "city_id" => function(){
            return factory(App\Models\City::class)->create()->id;
        },
        "area_id" => function(){
            return factory(App\Models\Area::class)->create()->id;
        },
        "address_description" => $faker->word,
        "first_phone" => $faker->e164PhoneNumber,
        "second_phone" => $faker->e164PhoneNumber,
        "email" => $faker->safeEmail,
        "service_type" => $serviceTypesArray[rand(0,1)],
        "created_by" => function() {
            return factory(App\Models\User::class)->create()->id;
        }
    ];
});
