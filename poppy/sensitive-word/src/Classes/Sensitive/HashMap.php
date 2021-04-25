<?php

namespace Poppy\SensitiveWord\Classes\Sensitive;

use Poppy\Classes\Contracts\HashMapContract;

/**
 * 构建hash表
 */
class HashMap implements HashMapContract
{
    /**
     * @var array $hashTable
     */
    protected $hashTable = [];

    /**
     * @param string $key   key
     * @param mixed  $value value
     * @return mixed
     */
    public function put($key, $value)
    {
        $this->hashTable[$key] = $value;

        return $this;
    }

    /**
     * @param string $key key
     * @return mixed|null
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->hashTable)) {
            return $this->hashTable[$key];
        }

        return null;
    }

    /**
     * 获取所有key
     * @return array
     */
    public function keys(): array
    {
        return array_keys($this->hashTable);
    }

    /**
     * 获取所有值
     * @return array
     */
    public function values(): array
    {
        return array_values($this->hashTable);
    }
}