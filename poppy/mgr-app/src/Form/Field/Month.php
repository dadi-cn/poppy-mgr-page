<?php

namespace Poppy\MgrApp\Form\Field;

class Month extends Date
{
    protected string $type = 'month';

    protected string $format = 'YYYY-MM';
}
