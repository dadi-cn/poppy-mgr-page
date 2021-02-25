<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Es;

interface DocumentFormatInterface
{
    /**
     * @return array
     */
    public function format(): array;
}