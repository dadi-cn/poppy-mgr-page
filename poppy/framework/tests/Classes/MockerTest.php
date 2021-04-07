<?php

namespace Poppy\Framework\Tests\Classes;

use Poppy\Framework\Application\TestCase;
use Poppy\Framework\Classes\Mocker;
use Poppy\Framework\Helper\UtilHelper;

class MockerTest extends TestCase
{
    public function testRandom(): void
    {
        $json = <<<JSON
{
    "name" : "name",
    "unixTime" : "unixTime",
    "imageUrl" : "imageUrl|400,20",
    "faker" : "fakerName"
}
JSON;
        $gen  = Mocker::generate($json);
        $this->assertIsString($gen['name']);
        $this->assertTrue(UtilHelper::isUrl($gen['imageUrl']));
    }

    public function testEmpty()
    {
        $json = '';
        $gen  = Mocker::generate($json);
        $this->assertIsArray($gen);
    }
}