<?php

namespace Poppy\Area\Classes\Form\Field;

use Poppy\Area\Models\PyArea;
use Poppy\Framework\Helper\TreeHelper;
use Poppy\System\Classes\Form\Field;

final class Area extends Field
{

    /**
     * @inheritDoc
     */
    protected $view = 'py-area::tpl.form.area';

    public function render()
    {
        $items = PyArea::selectRaw("id,title,parent_id")->where('level', '<', 4)->get()->keyBy('id')->toArray();
        $Tree  = new TreeHelper();
        $Tree->init($items, 'id', 'parent_id', 'title');
        $this->addVariables([
            'area' => $Tree->getTreeArray(0),
        ]);
        return parent::render();
    }
}
