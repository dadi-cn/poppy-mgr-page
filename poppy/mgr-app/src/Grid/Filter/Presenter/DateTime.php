<?php

namespace Poppy\MgrApp\Grid\Filter\Presenter;


use Poppy\MgrApp\Form\Traits\UsePlaceholder;

/**
 * 默认是时间日期选择器
 */
class DateTime extends Presenter
{
    use UsePlaceholder;

    protected string $type = 'datetime';

    public function datetime($placeholder = ''): self
    {
        $this->setAttribute([
            'type'   => 'datetime',
            'format' => 'YYYY-MM-DD HH:mm:ss',
        ]);
        $this->placeholder($placeholder);
        return $this;
    }

    /**
     * 月份
     * @return $this
     */
    public function month($placeholder = ''): self
    {
        $this->setAttribute([
            'type'   => 'month',
            'format' => 'YYYY-MM',
        ]);
        $this->placeholder($placeholder);
        return $this;
    }

    /**
     * 日期
     * @return $this
     */
    public function date($placeholder = ''): self
    {
        $this->setAttribute([
            'type'   => 'date',
            'format' => 'YYYY-MM-DD',
        ]);
        $this->placeholder($placeholder);
        return $this;
    }

    /**
     * 年份
     * @return $this
     */
    public function year($placeholder = ''): self
    {
        $this->setAttribute([
            'type'   => 'year',
            'format' => 'YYYY',
        ]);
        $this->placeholder($placeholder);
        return $this;
    }
}
