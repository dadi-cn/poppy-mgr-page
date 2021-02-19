<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal\Formatter;

class DeleteFormatter extends Formatter
{
    public function format()
    {
        $this->primaryKeyValue = null;
        foreach ($this->columns as $column) {
            $this->setPrimaryKey($column);
        }

        if ($this->primaryKeyValue) {
            $this->values[$this->tableName][] = $this->primaryKeyValue;
        }
    }
}