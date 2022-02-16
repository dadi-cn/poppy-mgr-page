<?php

namespace Poppy\MgrApp\Grid\Filter\Presenter;

use Illuminate\Support\Fluent;
use Poppy\MgrApp\Grid\Filter\Render\AbstractFilterItem;

/**
 * 表现
 */
abstract class Presenter extends Fluent
{
    /**
     * @var AbstractFilterItem
     */
    protected $filter;


    protected string $type;

    /**
     * Set parent filter.
     *
     * @param AbstractFilterItem $filter
     */
    public function setParent(AbstractFilterItem $filter)
    {
        $this->filter = $filter;
    }

    /**
     * 字段属性
     * @param string|array $attr
     * @param mixed        $value
     * @return $this
     */
    public function setAttribute($attr, $value = ''): self
    {
        if (is_array($attr)) {
            foreach ($attr as $att => $val) {
                $this->offsetSet($att, $val);
            }
        } else {
            $this->offsetSet($attr, $value);
        }
        return $this;
    }

    /**
     * 类型
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Set default value for filter.
     *
     * @param $default
     *
     * @return $this
     */
    public function default($default): self
    {
        $this->filter->default($default);

        return $this;
    }
}
