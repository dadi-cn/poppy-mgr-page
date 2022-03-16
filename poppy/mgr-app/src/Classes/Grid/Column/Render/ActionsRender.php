<?php

namespace Poppy\MgrApp\Classes\Grid\Column\Render;

use Closure;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Fluent;
use Poppy\MgrApp\Classes\Action\Action;
use Poppy\MgrApp\Classes\Traits\UseActions;

class ActionsRender extends AbstractRender
{

    use UseActions;


    /**
     * @inheritDoc
     */
    public function render($callback = null): Jsonable
    {
        if ($callback instanceof Closure) {
            $callback->call($this, $this);
        }

        $actions = [];
        foreach ($this->items as $append) {
            if ($append instanceof Action) {
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
                $params['length']        = $this->length;
                $params['dropdown-icon'] = $this->dropdownIcon;
            }
        }

        return new Fluent($params);
    }
}
