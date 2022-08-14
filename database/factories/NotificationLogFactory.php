<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\NotificationLog;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(NotificationLog::class, function (Faker $faker) {
    return [
        'body' => $this->faker->sentence,
        'type' => 'Notification',
        'data' => $this->faker->boolean ?: Arr::random([
            'some' => $this->faker->word,
            'www' => $this->faker->word,
            'eeee' => $this->faker->word,
            'qqqq' => $this->faker->word,
        ], 2),
    ];
});
