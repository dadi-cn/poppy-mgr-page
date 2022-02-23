<?php

namespace Poppy\MgrApp\Grid\Column\Action;


/**
 * 页面操作
 * 页面/抽屉方式打开
 */
class PageAction extends AbstractAction
{

    /**
     * 渲染类型, 需要明确指定 form:表单形式
     * @var string
     */
    private string $displayType = '';

    public function type($type): self
    {
        $this->displayType = strtolower($type);
        return $this;
    }

    /**
     * Action  渲染
     * @return array
     */
    public function render(): array
    {
        return array_merge(parent::render(), [
            'method' => 'page',
            'render' => $this->displayType,
        ]);
    }
}
