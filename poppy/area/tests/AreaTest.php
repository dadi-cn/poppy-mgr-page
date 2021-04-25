<?php

namespace Poppy\Area\Tests;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Area\Models\AreaContent;
use Poppy\System\Tests\Base\SystemTestCase;

class AreaTest extends SystemTestCase
{
    public function testCountryKv(): void
    {
        $countryKv = AreaContent::kvCountry();
        $this->assertEquals('中国', $countryKv['CN']);
    }


    public function testAreaKv(): void
    {
        $city = AreaContent::kvCity('3701');
        $this->assertEquals('济南市', $city);
    }
}
