<?php

namespace Poppy\MgrApp\Classes\Grid\Tools;

use Illuminate\Support\Fluent;
use Poppy\MgrApp\Classes\Contracts\Structable;
use Poppy\MgrApp\Classes\Tools\Action\AbstractAction;
use Poppy\MgrApp\Classes\Tools\Action\PageAction;
use Poppy\MgrApp\Classes\Tools\Action\RequestAction;

class Actions implements Structable
{
    /**
     * @var array
     */
    private array $actions = [];


    /**
     * Append an action.
     *
     * @param array|AbstractAction $action
     *
     * @return $this
     */
    public function add($action): self
    {
        if (is_array($action)) {
            $this->actions = array_merge($this->actions, $action);
        } else {
            $this->actions[] = $action;
        }
        return $this;
    }

    /**
     *
     */
    public function struct(): array
    {
        $actions = [];
        foreach ($this->actions as $append) {
            if ($append instanceof AbstractAction) {
                $def       = $append->struct();
                $actions[] = $def;
            }
        }
        return (new Fluent($actions))->toArray();
    }


    /**
     * 返回请求
     * @param string $title
     * @param string $url
     * @return RequestAction
     */
    public function request(string $title, string $url): RequestAction
    {
        $action = new RequestAction($title, $url);
        return tap($action, function () use ($action) {
            $this->add($action);
        });
    }

    /**
     * 返回页面
     * @param string $title
     * @param string $url
     * @param string $type
     * @return PageAction
     */
    public function page(string $title, string $url, string $type): PageAction
    {
        $action = (new PageAction($title, $url))->type($type);
        return tap($action, function () use ($action) {
            $this->add($action);
        });
    }
}
