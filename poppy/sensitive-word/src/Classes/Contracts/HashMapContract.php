<?php

namespace Poppy\Classes\Contracts;

/**
 * HashMap
 */
interface HashMapContract
{
    /**
     * @param string $key   key
     * @param mixed  $value value
     * @return mixed
     */
    public function put($key, $value);

    /**
     * @param string $key key
     * @return mixed|null
     */
    public function get($key);

}