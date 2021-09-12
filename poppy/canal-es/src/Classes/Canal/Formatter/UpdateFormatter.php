<?php
declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal\Formatter;

class UpdateFormatter extends Formatter
{

    public function format()
    {
        $data                  = [];
        $this->primaryKeyValue = null;
        foreach ($this->columns as $column) {
            $data[$column->getName()] = $column->getValue();
            $this->setPrimaryKey($column);
        }

        if ($this->primaryKeyValue) {
            $this->values[$this->tableName][$this->primaryKeyValue] = $data;
        }
    }
}