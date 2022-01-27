<?php

namespace Php\Tests\VariableType;

use Php\Classes\Emoji;
use Poppy\Framework\Application\TestCase;

class StringTest extends TestCase
{
    /**
     * 文字长度处理
     */
    public function testLength(): void
    {
        $str1 = '我和😀';
        $this->assertEquals(3, Emoji::length($str1));

        $str2 = '我和🇨🇳';
        $this->assertEquals(3, Emoji::length($str2));

        $str3 = '我和 ';
        $this->assertEquals(3, Emoji::length($str3));
    }

    public function testSet()
    {
        $str = 'abc';
        $this->assertEquals('b', $str[1]);

        $str[1] = 'a';
        $this->assertEquals('aac', $str);
    }
}