<?php

use Demo\Models\DemoComment;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

// php artisan poppy:seed module.demo --class='\Demo\Database\Seeds\DemoUserDatabaseSeeder'

/** @var Factory $factory */
$factory->define(DemoComment::class, function (Faker $faker) {
    $id = rand(1, 500);
    return [
        /* 内容
         * ---------------------------------------- */
        'title'       => 'Comment@' . $id . $faker->sentence(5),
        'note'        => $faker->sentence(50),
        'content'     => $faker->sentence(200),

        /* 连表
        * ---------------------------------------- */
        'webapp_id'   => $id,
    ];
});

