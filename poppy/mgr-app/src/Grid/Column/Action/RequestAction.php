<?php

namespace Poppy\MgrApp\Grid\Column\Action;

/**
 * 请求操作
 */
final class RequestAction extends AbstractAction
{
    /**
     * 是否是确认, 此项目在 type 为 request 时候存在
     * @var bool
     */
    protected bool $confirm = false;


    /**
     * 启用请求确认
     * @return $this
     */
    public function confirm(): self
    {
        $this->confirm = true;
        return $this;
    }

    /**
     * Action  渲染
     * @return array
     */
    public function render(): array
    {
        $params = [
            'method' => 'request'
        ];
        if ($this->confirm) {
            $params['confirm'] = true;
        }
        return array_merge(parent::render(), $params);
    }
}
