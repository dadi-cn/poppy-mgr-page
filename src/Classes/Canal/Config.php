<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal;


use Illuminate\Support\Str;

/**
 * @method getClientType()
 * @method getHost()
 * @method getPort()
 * @method getDestination()
 * @method getClientId()
 * @method getFilter()
 */
class Config
{
    /**
     * @var array $configs
     */
    private $configs = [];

    /**
     * Config constructor.
     * @param array $configs
     */
    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    public function __call($name, $arguments)
    {
        $prefix = strtolower(substr($name, 0, 3));
        if ($prefix === 'get') {
            $propertyName = Str::snake(substr($name, 3));
            return $this->__get($propertyName);
        }
    }

    public function __get($name)
    {
        return $this->configs[$name] ?? '';
    }

    public function __set($name, $value)
    {
        $this->configs[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->configs[$name]);
    }
}