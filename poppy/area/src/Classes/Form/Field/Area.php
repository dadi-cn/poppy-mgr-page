<?php

namespace Poppy\Area\Classes\Form\Field;

use Poppy\Area\Models\PyArea;
use Poppy\System\Classes\Form\Field;

final class Area extends Field
{

    /**
     * @inheritDoc
     */
    protected $view = 'py-area::tpl.form.area';

    public function render()
    {
        $this->addVariables([
            'area' => PyArea::cityTree(),
        ]);
        return parent::render();
    }
}
