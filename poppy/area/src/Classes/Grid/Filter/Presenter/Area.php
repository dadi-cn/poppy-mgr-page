<?php

namespace Poppy\Area\Classes\Grid\Filter\Presenter;

use Poppy\Area\Models\PyArea;
use Poppy\System\Classes\Grid\Filter\Presenter\Presenter;

class Area extends Presenter
{
    public function view(): string
    {
        return 'py-area::tpl.filter.area';
    }

    public function variables(): array
    {
        return [
            'area' => PyArea::cityTree(),
        ];
    }
}
