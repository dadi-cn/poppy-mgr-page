<?php

namespace Poppy\MgrApp\Grid\Concerns;

use Closure;
use Poppy\MgrApp\Widgets\GridWidget;
use Poppy\MgrApp\Grid\Tools;

trait HasTools
{
    use HasQuickSearch;

    /**
     * Header tools.
     *
     * @var Tools
     */
    public $tools;

    /**
     * Setup grid tools.
     *
     * @param Closure $callback
     *
     * @return void
     */
    public function tools(Closure $callback)
    {
        call_user_func($callback, $this->tools);
    }

    /**
     * Render custom tools.
     *
     * @return string
     */
    public function renderHeaderTools(): string
    {
        return $this->tools->render();
    }

    /**
     * Setup grid tools.
     *
     * @param GridWidget $grid
     * @return $this
     */
    protected function initTools(GridWidget $grid): self
    {
        $this->tools = new Tools($grid);
        return $this;
    }
}
