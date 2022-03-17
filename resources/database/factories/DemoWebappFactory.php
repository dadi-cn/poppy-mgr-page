<?php

use Demo\Models\DemoWebapp;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Carbon;

// php artisan poppy:seed module.demo --class='\Demo\Database\Seeds\DemoWebappDatabaseSeeder'

/** @var Factory $factory */
$factory->define(DemoWebapp::class, function (Faker $faker) {
    return [
        /* 日期
         * ---------------------------------------- */
        'birth_at'    => Carbon::now()->addDays(rand(-1000, 1000))->toDateTimeString(),
        'birth_date'  => Carbon::now()->addDays(rand(-1000, 1000))->toDate(),
        'post_at'     => Carbon::now()->addDays(rand(-30, 30))->toDateTimeString(),
        'modify_at'   => Carbon::now()->addDays(rand(-30, 30))->toDateTimeString(),
        'delete_at'   => Carbon::now()->addDays(rand(-30, 30))->toDateTimeString(),
        'rename_at'   => Carbon::now()->addDays(rand(-30, 30))->toDateTimeString(),
        'updated_at'  => Carbon::now()->addDays(rand(-30, 30))->toDateTimeString(),
        'created_at'  => Carbon::now()->addDays(rand(-30, 30))->toDateTimeString(),

        /* 日期
         * ---------------------------------------- */
        'title'       => $faker->sentence(20),
        'description' => $faker->sentence(30),
        'note'        => $faker->sentence(50),
        'content'     => $faker->sentence(1000),

        /* 用户
         * ---------------------------------------- */
        'email'       => $faker->email,
        'last_name'   => $faker->userName,
        'first_name'  => $faker->lastName,
        'age'         => $faker->randomElement(range(30, 80)),
        'score'       => $faker->randomElement(range(1, 100)),

        /* 自定义 排序 | 样式
         * ---------------------------------------- */
        'sort'        => $faker->randomElement(range(1, 1000)),
        'style'       => 'color:' . $faker->randomElement(['red', 'green', 'blue', 'black']),

        /* 状态
         * ---------------------------------------- */
        'status'      => $faker->randomElement(range(1, 5)),
        'progress'    => rand(1, 100),

        'is_open'    => $faker->randomElement(range(1, 0)),
        'is_enable'  => $faker->randomElement(range(1, 0)),
        'trashed'    => rand(0, 1),
        'loading'    => rand(0, 1),

        /* File | Image | Link | Images
        * ---------------------------------------- */
        'file'       => $faker->randomElement([
            'https://test-oss.iliexiang.com/_res/pdf/2022-damo.pdf',
            'https://test-oss.iliexiang.com/_res/rpm/percona-xtrabackup-24-2.4.21-1.el7.x86_64.rpm',
            'https://test-oss.iliexiang.com/_res/video/h-918k.mp4',
        ]),
        'pdf'        => $faker->randomElement([
            'https://test-oss.iliexiang.com/_res/pdf/2022-damo.pdf',
        ]),
        'video'      => $faker->randomElement([
            'https://test-oss.iliexiang.com/_res/video/h-918k.mp4',
            'https://test-oss.iliexiang.com/_res/video/v-8m.mp4',
            'https://test-oss.iliexiang.com/_res/video/h-15m-actor.mp4',
        ]),
        'audio'      => $faker->randomElement([
            'https://test-oss.iliexiang.com/_res/audio/actor.mp3',
        ]),
        'files'      => implode(',', [
            'https://test-oss.iliexiang.com/_res/pdf/2022-damo.pdf',
            'https://test-oss.iliexiang.com/_res/rpm/percona-xtrabackup-24-2.4.21-1.el7.x86_64.rpm'
        ]),
        'image'      => $faker->randomElement([
            $faker->imageUrl(),
            'https://test-oss.iliexiang.com/_res/avatar/07.jpg',
            'https://test-oss.iliexiang.com/_res/avatar/10.jpg',
        ]),
        'images'     => implode(',', [
            $faker->imageUrl(),
            'https://test-oss.iliexiang.com/_res/avatar/07.jpg',
            'https://test-oss.iliexiang.com/_res/avatar/10.jpg',
        ])
        ,
        'link'       => $faker->url,


        /* Cast
         * ---------------------------------------- */
        'setting'    => json_encode([
            'is_open' => $faker->randomElement(['Y', 'N']),
            'blog'    => $faker->randomElement(['weibo', 'twitter', 'fb', 'github']),
        ]),

        /* 连表
         * ---------------------------------------- */
        'account_id' => rand(1, 50),
    ];
});
