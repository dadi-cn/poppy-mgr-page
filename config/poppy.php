<?php

use Php\Classes\EsFormatter\KoubeiCarDocumentFormatter;
use Php\Classes\EsFormatter\OrderDocumentFormatter;
use Php\Classes\EsProperty\CsdnUser;
use Php\Classes\EsProperty\KoubeiCar;
use Php\Classes\EsProperty\Order;
use Poppy\System\Classes\Api\Sign\DefaultApiSignProvider;
use xingwenge\canal_php\CanalClient;

return [

    'system' => [

        /* 用户默认跳转地址
         * ---------------------------------------- */
        'user_location' => '/login',

        /*
        |--------------------------------------------------------------------------
        | 跨域来源
        |--------------------------------------------------------------------------
        |
        */
        'cross_origin'  => '*',

        /*
        |--------------------------------------------------------------------------
        | 允许的Header
        |--------------------------------------------------------------------------
        |
        */
        'cross_headers' => [

        ],

        /*
        |--------------------------------------------------------------------------
        | 接口debug key, 当 _py_sys_secret 和此值相等, 则不进行加密的签名验证
        |--------------------------------------------------------------------------
        |
        */
        'secret'        => env('PY_SYS_SECRET', ''),
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
                
                // 额外添加的脚本
                'scripts'     => '',

                'method' => 'post',

                'sign_token' => true,

                'sign_certificate' => [
                    [
                        'name'        => 'timestamp',
                        'title'       => 'TimeStamp',
                        'description' => '时间戳',
                        'type'        => 'String',
                        'default'     => DefaultApiSignProvider::timestamp(),
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
        'canal'  => [
            'client_type'     => CanalClient::TYPE_SWOOLE,
            'host'            => env('CANAL_HOST', '127.0.0.1'),
            'port'            => env('CANAL_PORT', 11111),
            'client_id'       => env('CANAL_CLIENT_ID', 1001),
            'connect_timeout' => env('CANAL_CONNECT_TIMEOUT', 10),
            'message_size'    => 100,
        ],

        // filter .*\\..*,shop.user
        //
        'mapper' => [
            'pt_order'   => [
                'formatter' => OrderDocumentFormatter::class,
                'table'     => 'fadan.pt_order',
                'property'  => Order::class,
            ],
            'koubei_car' => [
                'formatter' => KoubeiCarDocumentFormatter::class,
                'property'  => KoubeiCar::class,
                'table'     => 'canal_example.koubei_car',
            ],
            'csdn_user'  => [
                'formatter'   => '',
                'property'    => CsdnUser::class,
                'table'       => 'canal_example.csdn_users',
                'destination' => 'csdn_user',
                'filter'      => 'canal_example.csdn_users',
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