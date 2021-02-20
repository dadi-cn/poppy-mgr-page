<?php

declare(strict_types = 1);

namespace Php\Classes\EsProperty;

use Poppy\CanalEs\Classes\Properties\Property;

class Example extends Property
{
    public function properties(): array
    {
        return [
            'id'       => [
                'type' => 'long',
            ],
            'username' => [
                'type' => 'keyword',
            ],
            'nickname' => [
                'type'            => 'text',
                'analyzer'        => 'ik_smart',
                'search_analyzer' => 'ik_smart',
            ],
            'login_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
        ];
    }
}