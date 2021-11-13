<?php

namespace Poppy\MgrApp\Form\Field;

use DateTimeZone;

class Timezone extends Select
{
    protected $view = 'py-system::tpl.form.select';

    public function render()
    {
        $this->options = collect(DateTimeZone::listIdentifiers())->mapWithKeys(function ($timezone) {
            return [$timezone => $timezone];
        })->toArray();

        return parent::render();
    }
}
