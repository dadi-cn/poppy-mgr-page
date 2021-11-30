<?php

namespace Poppy\MgrApp\Form\Field;

class Year extends Date
{
    protected string $type = 'year';

    protected string $format = 'YYYY';
}
