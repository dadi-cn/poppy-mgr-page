<?php

namespace Php\Tests\Text;

use Poppy\System\Tests\Base\SystemTestCase;

class StringTest extends SystemTestCase
{

    public function testExplode()
    {
        $str = 'abc';
        [$arg] = explode('|', $str);
        $this->assertEquals('abc', $arg);
    }
}