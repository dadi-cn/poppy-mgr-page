<?php

namespace Poppy\Area\Classes\Grid\Filter\Presenter;

use Poppy\Area\Models\PyArea;
use Poppy\Framework\Helper\TreeHelper;
use Poppy\System\Classes\Grid\Filter\Presenter\Presenter;

class Area extends Presenter
{
    public function view(): string
    {
        return 'py-area::tpl.filter.area';
    }

    public function variables(): array
    {
        $items = PyArea::selectRaw("id,title,parent_id")->where('level', '<', 4)->get()->keyBy('id')->toArray();
        $Tree  = new TreeHelper();
        $Tree->init($items, 'id', 'parent_id', 'title');
        return [
            'area' => $Tree->getTreeArray(0),
        ];
    }
}
