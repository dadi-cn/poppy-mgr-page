<?php

declare(strict_types = 1);

namespace Php\Classes\EsFormatter;

use Php\Classes\EsProperty\KoubeiCar;
use Poppy\CanalEs\Classes\Formatter\Formatter;

class KoubeiCarFormatter extends Formatter
{

    public function format(): array
    {
        $properties = (new KoubeiCar())->properties();
        $keys = array_keys($properties);

        $item = [];
        foreach ($keys as $key) {
            $item[$key] = Arr::get($this->item, $key);
        }
        return $item;
    }

}