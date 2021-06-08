<?php

namespace Php\Tests\Other;

use Poppy\System\Tests\Base\SystemTestCase;

class UrlTest extends SystemTestCase
{

    public function testBuild()
    {
        $params = [
            'a' => ['b', 'c', 'd'],
        ];
        $string = urldecode(http_build_query($params));
        $this->assertEquals('a[0]=b&a[1]=c&a[2]=d', $string);
    }
}