<?php

namespace Poppy\MgrApp\Form\Field;

class Datetime extends Date
{
    protected string $type   = 'datetime';
    protected string $format = 'YYYY-MM-DD HH:mm:ss';
}
