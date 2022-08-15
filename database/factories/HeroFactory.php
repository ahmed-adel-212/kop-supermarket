<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Hero;
use Faker\Generator as Faker;

$factory->define(Hero::class, function (Faker $faker) {
    return [
        'page' => 'aboutus',
        'image' => '/gallery/aboutus/asd.png',
    ];
});
