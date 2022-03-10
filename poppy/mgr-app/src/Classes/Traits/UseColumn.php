<?php

namespace Poppy\MgrApp\Classes\Traits;

trait UseColumn
{

    private function convertFieldName($name)
    {
        return str_replace('.', '-', $name);
    }
}
