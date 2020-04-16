<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'content' => $faker->paragraphs(5, true),
        'updated_at' => $faker->dateTimeBetween('-3 years')
    ];
});

