<?php

namespace Poppy\MgrApp\Form\Field;

class DatetimeRange extends DateRange
{
    protected string $type   = 'datetimerange';
    protected string $format = 'YYYY-MM-DD HH:mm:ss';
}
