<?php

namespace Poppy\MgrApp\Form\Field;

class MonthRange extends DateRange
{
    protected string $type = 'monthrange';

    protected string $format = 'YYYY-MM';
}
