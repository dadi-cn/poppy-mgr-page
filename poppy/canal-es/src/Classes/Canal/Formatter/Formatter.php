<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Es\DocumentFormatter;

use Com\Alibaba\Otter\Canal\Protocol\Column;
use Google\Protobuf\Internal\RepeatedField;

abstract class Formatter
{
    /**
     * @var array|Column[]
     */
    protected $columns = [];

    /**
     * @var string $primaryKeyValue
     */
    protected $primaryKeyValue;

    /**
     * @var array $values
     */
    protected $values = [];

    /**
     * @var string $tableName
     */
    protected $tableName;

    /**
     * @return array|Column[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @param RepeatedField $columns
     * @return $this
     */
    public function addColumns(RepeatedField $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @param string $tableName
     * @return Formatter
     */
    public function setTableName(string $tableName): self
    {
        $this->tableName = $tableName;
        return $this;
    }


    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    abstract public function format();

    /**
     * @param Column $column
     */
    protected function setPrimaryKey(Column $column): void
    {
        if ($column->getIsKey()) {
            $this->primaryKeyValue = $column->getValue();
        }
    }
}