<?php

declare(strict_types = 1);

namespace Php\Classes\EsProperty;

use Poppy\CanalEs\Classes\Properties\Property;

class CsdnUser extends Property
{
    public function properties(): array
    {
        return [
            'id'   => [
                'type' => 'long',
            ],
            'name' => [
                'type' => 'keyword',
            ],
            'pass' => [
                'type' => 'keyword',
            ],
            'mail' => [
                'type' => 'keyword',
            ],
        ];
    }
}