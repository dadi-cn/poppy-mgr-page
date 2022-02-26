<?php

namespace Poppy\MgrApp\Classes\Grid\Concerns;


use Poppy\MgrApp\Classes\Tools\Action\AbstractAction;

/**
 * 快捷操作
 */
trait HasQuickAction
{
    protected array $quickActions = [];

    /**
     * 添加 QuickAction
     * @param AbstractAction[]|AbstractAction $action
     */
    public function addQuickAction($action): void
    {
        if (is_array($action)) {
            $this->quickActions = array_merge($this->quickActions, $action);
        } else {
            $this->quickActions[] = $action;
        }
    }

    /**
     * 快捷操作
     * @return array
     */
    public function structQuickAction(): array
    {
        $append = [];
        /** @var AbstractAction $quickButton */
        foreach ($this->quickActions as $quickButton) {
            $append[] = $quickButton->struct();
        }
        return $append;
    }
}
