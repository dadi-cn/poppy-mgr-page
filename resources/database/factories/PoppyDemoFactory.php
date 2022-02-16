<?php

use Demo\Models\PoppyDemo;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

// php artisan poppy:seed module.demo --class='\Demo\Database\Seeds\PoppyDemoDatabaseSeeder'

/** @var Factory $factory */
$factory->define(PoppyDemo::class, function (Faker $faker) {
    return [
        'title'      => $faker->sentence(20),
        'status'     => $faker->randomElement(range(1, 5)),
        'is_open'    => $faker->randomElement(range(1, 0)),
        'desc'       => $faker->sentence(80),
        'email'      => $faker->email,
        'sort'       => $faker->randomElement(range(1, 1000)),
        'username'   => Str::random(rand(7, 10)),
        'file'       => $faker->url,
        'score'      => $faker->randomElement(range(1, 100)),
        'age'        => $faker->randomElement(range(30, 80)),
        'last_name'  => $faker->userName,
        'first_name' => $faker->lastName,
        'birth_at'   => $faker->dateTime(),
        'birth_date' => Carbon::now()->addDays(rand(-1000, 1000))->toDate(),
        'link'       => $faker->url,
        'image'      => $faker->imageUrl(),
        'progress'   => rand(1, 100),
        'trashed'    => rand(0, 1),
        'content'    => $faker->sentence(1000),
        'account_id' => rand(1, 100000),
    ];
});
