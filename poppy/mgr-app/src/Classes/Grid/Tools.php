<?php

namespace Poppy\MgrApp\Classes\Grid;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Poppy\MgrApp\Actions\GridAction;
use Poppy\MgrApp\Classes\Grid\Filter\Render\AbstractFilterItem;
use Poppy\MgrApp\Classes\Grid\Tools\AbstractTool;
use Poppy\MgrApp\Classes\Widgets\GridWidget;

class Tools extends AbstractFilterItem implements Renderable
{
    /**
     * Parent grid.
     *
     * @var GridWidget
     */
    protected $grid;

    /**
     * Collection of tools.
     *
     * @var Collection
     */
    protected $tools;

    /**
     * Create a new Tools instance.
     *
     * @param GridWidget $grid
     */
    public function __construct(GridWidget $grid)
    {
        $this->grid = $grid;

        $this->tools = new Collection();
    }

    /**
     * Append tools.
     *
     * @param AbstractTool|string $tool
     *
     * @return $this
     */
    public function append($tool)
    {
        if ($tool instanceof GridAction) {
            $tool->setGrid($this->grid);
        }

        $this->tools->push($tool);

        return $this;
    }

    /**
     * Prepend a tool.
     *
     * @param AbstractTool|string $tool
     *
     * @return $this
     */
    public function prepend($tool)
    {
        $this->tools->prepend($tool);

        return $this;
    }

    /**
     * Disable refresh button.
     *
     * @param bool $disable
     * @return void
     *
     * @deprecated
     */
    public function disableRefreshButton(bool $disable = true)
    {
        //
    }

    /**
     * Disable batch actions.
     *
     * @param bool $disable
     * @return void
     */
    public function disableBatchActions(bool $disable = true)
    {
        $this->tools = $this->tools->map(function ($tool) use ($disable) {
            return $tool;
        });
    }

    /**
     * Render header tools bar.
     *
     * @return string
     */
    public function render()
    {
        return $this->tools->map(function ($tool) {
            if ($tool instanceof AbstractTool) {
                if (!$tool->allowed()) {
                    return '';
                }

                return $tool->setGrid($this->grid)->render();
            }

            if ($tool instanceof Renderable) {
                return $tool->render();
            }
            return (string) $tool;
        })->implode(' ');
    }
}
