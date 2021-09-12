<?php

namespace Poppy\Area\Classes\Grid\Filter;

use Poppy\System\Classes\Grid\Filter\AbstractFilter;

class Area extends AbstractFilter
{


    public function render()
    {
        $this->presenter = new Presenter\Area();
        return parent::render();
    }

}
