<?php

namespace Poppy\MgrApp\Form\Field;

class Week extends Date
{
    protected string $type = 'week';

    protected string $format = 'ww';
}
