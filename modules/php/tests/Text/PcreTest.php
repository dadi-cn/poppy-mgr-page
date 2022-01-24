<?php

namespace Php\Tests\Text;

use Poppy\System\Tests\Base\SystemTestCase;

class PcreTest extends SystemTestCase
{

    public function testReplace()
    {
        $str = '    TAB SPACE';
        $this->assertEquals('TABSPACE', preg_replace('/\s+/', '', $str));
    }
}