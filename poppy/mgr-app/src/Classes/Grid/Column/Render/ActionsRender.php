<?php

namespace Poppy\MgrApp\Classes\Grid\Column\Render;

use Closure;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Fluent;
use Poppy\MgrApp\Classes\Tools\Action\AbstractAction;
use Poppy\MgrApp\Classes\Tools\Action\PageAction;
use Poppy\MgrApp\Classes\Tools\Action\RequestAction;
use function tap;

class ActionsRender extends AbstractRender
{
    /**
     * @var array
     */
    private array $actions = [];

    /**
     * 样式
     * @var string
     */
    private string $style = '';

    /**
     * @var int
     */
    private int $length = 5;


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


    public function dropdown($length = 5): self
    {
        $this->style  = 'dropdown';
        $this->length = $length;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function render($callback = null): Jsonable
    {
        if ($callback instanceof Closure) {
            $callback->call($this, $this);
        }

        $actions = [];
        foreach ($this->actions as $append) {
            if ($append instanceof AbstractAction) {
                $def       = $append->struct();
                $actions[] = $def;
            }
        }

        $params = [
            'items' => $actions
        ];
        if ($this->style) {
            $params['style'] = $this->style;
            if ($this->style === 'dropdown') {
                $params['length'] = $this->length;
            }
        }

        return new Fluent($params);
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
