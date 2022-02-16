<?php

namespace Poppy\MgrApp\Grid\Tools;

use Poppy\MgrApp\Grid\Filter;
use Throwable;

/**
 * 筛选按钮
 */
class FilterButton extends AbstractTool
{
    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function render()
    {
        $variables = [
            'url_no_scopes' => $this->filter()->urlWithoutScopes(),
            'filter_id'     => $this->filter()->getFilterId(),
        ];

        return view($this->view, $variables)->render();
    }

    /**
     * @return Filter
     */
    protected function filter(): Filter
    {
        return $this->grid->getFilter();
    }
}