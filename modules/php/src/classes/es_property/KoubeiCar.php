<?php

declare(strict_types = 1);

namespace Php\Classes\EsProperty;

use Poppy\CanalEs\Classes\Properties\Property;

class KoubeiCar extends Property
{
    public function properties(): array
    {
        return [
            'id'       => [
                'type' => 'long',
            ],
            'chengshi' => [
                'type' => 'keyword',
            ],
            'info'     => [
                'type'            => 'text',
                'analyzer'        => 'ik_smart',
                'search_analyzer' => 'ik_smart',
            ],
        ];
    }
}