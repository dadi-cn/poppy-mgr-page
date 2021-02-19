<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Formatter;

interface FormatInterface
{
    /**
     * @return array
     */
    public function format(): array;
}