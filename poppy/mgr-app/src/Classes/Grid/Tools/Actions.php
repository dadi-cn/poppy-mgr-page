<?php

namespace Poppy\MgrApp\Classes\Grid\Tools;

use Illuminate\Support\Fluent;
use Poppy\MgrApp\Classes\Action\Action;
use Poppy\MgrApp\Classes\Action\PageAction;
use Poppy\MgrApp\Classes\Action\RequestAction;
use Poppy\MgrApp\Classes\Contracts\Structable;

class Actions implements Structable
{
    /**
     * @var array
     */
    private array $actions = [];


    /**
     * 默认样式
     * @var array
     */
    private array $defaultStyle = [];

    /**
     * Append an action.
     *
     * @param array|Action $action
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
     * 设置默认样式, 该样式需是可以调用的 Action 方法
     * @param array $style
     * @return $this
     */
    public function default(array $style = []): self
    {
        $this->defaultStyle = $style;
        return $this;
    }

    /**
     *
     */
    public function struct(): array
    {
        $actions = [];
        foreach ($this->actions as $append) {
            if ($append instanceof Action) {
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
        $action = $this->callDefaultStyle($action);
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
        $action = $this->callDefaultStyle($action);
        return tap($action, function () use ($action) {
            $this->add($action);
        });
    }


    /**
     * 调用默认的样式
     * @param $action
     * @return mixed
     */
    private function callDefaultStyle($action)
    {
        if (count($this->defaultStyle)) {
            foreach ($this->defaultStyle as $style) {
                if (is_callable([$action, $style])) {
                    call_user_func([$action, $style]);
                }
            }
        }
        return $action;
    }
}
