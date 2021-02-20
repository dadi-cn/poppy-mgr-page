<?php

use Poppy\CanalEs\Classes\Formatter\KoubeiCarFormatter;
use Poppy\CanalEs\Classes\Formatter\OrderFormatter;
use Poppy\System\Classes\Api\Sign\DefaultApiSignProvider;
use xingwenge\canal_php\CanalClient;

return [

    'system' => [

        /* 用户默认跳转地址
         * ---------------------------------------- */
        'user_location'   => '/login',

        /*
        |--------------------------------------------------------------------------
        | 跨域来源
        |--------------------------------------------------------------------------
        |
        */
        'cross_origin'    => '*',

        /*
        |--------------------------------------------------------------------------
        | 允许的Header
        |--------------------------------------------------------------------------
        |
        */
        'cross_headers'   => [

        ],


        /* 是否启用接口加密[默认开启]
         * ---------------------------------------- */
        'api_enable_sign' => env('POPPY_ENABLE_SIGN', true),
    ],

    'core' => [
        'op_mail' => 'zhaody901@126.com',

        /*
        |--------------------------------------------------------------------------
        | 接口文档的定义
        |--------------------------------------------------------------------------
        | 需要运行 `php artisan system:doc api` 来生成技术文档
        */
        'apidoc'  => [
            'web' => [
                // 标题
                'title'       => '前台接口',
                // 默认访问地址
                'default_url' => 'api_v1/system/auth/login',

                'method' => 'post',

                'sign_certificate' => [
                    [
                        'name'        => 'timestamp',
                        'title'       => 'TimeStamp',
                        'type'        => 'String',
                        'is_required' => 'Y',
                    ],
                ],
                'sign_generate'    => DefaultApiSignProvider::js(),
            ],
        ],
    ],

    'framework' => [

        /*
        |--------------------------------------------------------------------------
        | Seo 相关
        |--------------------------------------------------------------------------
        |
        */
        'title' => '网站名称',


        'description' => '网站描述',
    ],

    'sms' => [
        'sign'  => 'Poppy',

        /* 短信类型
         * ---------------------------------------- */
        'types' => [
            [
                'type'        => 'captcha',
                'title'       => '验证码',
                'description' => '可用变量名称[code:验证码], 遵循 laravel translate 写法, 会显示在日志中',
            ],
        ],
    ],

    'canal-es' => [
        'canal' => [
            'client_type'     => CanalClient::TYPE_SWOOLE,
            'host'            => env('CANAL_HOST', '127.0.0.1'),
            'port'            => env('CANAL_PORT', 11111),
            'client_id'       => env('CANAL_CLIENT_ID', 1001),
            'destination'     => env('CANAL_DESTINATION', 'test'),
            'filter'          => env('CANAL_FILTER', '.*\\..*'),
            //    'filter'          => env('CANAL_FILTER', 'shop.user'),
            'connect_timeout' => env('CANAL_CONNECT_TIMEOUT', 10),
            'message_size'    => 100,
            'mapper'          => [
                'formatter' => [
                    'fadan.pt_order'           => OrderFormatter::class,
                    'canal_example.koubei_car' => KoubeiCarFormatter::class,
                ],
                'index'     => [
                    // tableName => 'index_name',
                    'order' => 'pt_order',
                ],
            ],
        ],

        'elasticsearch' => [
            'concurrency' => env('ELASTICSEARCH_CONCURRENCY', 100),

            'hosts' => value(function () {
                $settings = env('ELASTICSEARCH_HOSTS');
                $hosts    = array_filter(explode(';', $settings));

                return $hosts ? array_map(function ($url) {
                    return array_merge(parse_url($url), [
                        'user' => env('ELASTICSEARCH_USER', null),
                        'pass' => env('ELASTICSEARCH_PASS', null),
                    ]);
                }, $hosts) : [
                    [
                        'host'   => '127.0.0.1',
                        'port'   => '9200',
                        'scheme' => 'http',
                        'user'   => env('ELASTICSEARCH_USER', null),
                        'pass'   => env('ELASTICSEARCH_PASS', null),
                    ],
                ];
            }),
        ],
    ],
];