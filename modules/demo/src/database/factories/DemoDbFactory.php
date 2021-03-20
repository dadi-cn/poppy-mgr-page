<?php

use Demo\Models\DemoDb;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(DemoDb::class, function (Faker $faker) {
    return [
        'tiny_integer' => $faker->numberBetween(0, 100),
        'u_integer'    => $faker->numberBetween(100, 500),
        'var_char_20'  => $faker->words(8, true),
        'char_20'      => $faker->words(10, true),
        'text'         => $faker->sentence(30),
        'decimal'      => $faker->numberBetween(100, 6),
    ];
});
