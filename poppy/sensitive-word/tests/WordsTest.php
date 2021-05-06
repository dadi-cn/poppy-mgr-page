<?php

namespace Poppy\SensitiveWord\Tests;

use Poppy\SensitiveWord\Classes\Sensitive\Words;
use Poppy\System\Tests\Base\SystemTestCase;

class WordsTest extends SystemTestCase
{
    public function testFilter(): void
    {
        $value = sensitive_words('暴政');
        $this->assertFalse($value);
        $value = sensitive_words('嬴政暴政', Words::TYPE_WORDS);
        $this->assertEquals('暴政', $value[0] ?? '');
        $value = sensitive_words('嬴政暴政', Words::TYPE_REPLACE);
        $this->assertEquals('嬴政**', $value);
    }
}
