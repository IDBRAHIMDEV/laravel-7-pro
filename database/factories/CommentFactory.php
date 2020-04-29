<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'updated_at' => $faker->dateTimeBetween('-1 years')
    ];
});
