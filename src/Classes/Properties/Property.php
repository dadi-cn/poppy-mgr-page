<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Properties;

abstract class Property implements PropertyInterface
{

    public function __invoke()
    {
        return [
            'settings' => method_exists($this, 'settings') ? $this->settings() : (object) [],
            'mappings' => $this->mappings(),
        ];
    }

    public function mappings(): array
    {
        return [
            'properties' => $this->properties(),
        ];
    }

    abstract public function properties(): array;

}