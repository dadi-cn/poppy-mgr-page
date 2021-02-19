<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal\Formatter;


class InsertFormatter extends Formatter
{
    public function format()
    {
        $this->primaryKeyValue = null;

        $data = [];
        foreach ($this->columns as $column) {
            $data[$column->getName()] = $column->getValue();
            $this->setPrimaryKey($column);
        }

        if ($this->primaryKeyValue) {
            $this->values[$this->tableName][$this->primaryKeyValue] = $data;
        }
    }
}