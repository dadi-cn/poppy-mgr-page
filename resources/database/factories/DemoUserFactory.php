<?php

use Demo\Models\DemoUser;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

// php artisan poppy:seed module.demo --class='\Demo\Database\Seeds\DemoUserDatabaseSeeder'

/** @var Factory $factory */
$factory->define(DemoUser::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'nickname' => $faker->name(),
    ];
});
