<?php

namespace Poppy\Area\Tests;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Area\Models\PyArea;
use Poppy\System\Tests\Base\SystemTestCase;

class AreaTest extends SystemTestCase
{
    public function testCountryKv(): void
    {
        $countryKv = PyArea::kvCountry();
        $this->assertEquals('中国', $countryKv['CN']);
    }


    public function testAreaKv(): void
    {
        $city = PyArea::kvCity('3701');
        $this->assertEquals('济南市', $city);

        $city = PyArea::kvArea(1);
        $this->assertEquals('北京市', $city);
    }

}
