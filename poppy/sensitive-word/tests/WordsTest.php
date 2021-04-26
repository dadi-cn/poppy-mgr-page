<?php

namespace Poppy\SensitiveWord\Tests;

use Poppy\SensitiveWord\Classes\Sensitive\SensitiveWords;
use Poppy\System\Tests\Base\SystemTestCase;

class WordsTest extends SystemTestCase
{
    public function testFilter(): void
    {
        $value = words_filter('暴政', SensitiveWords::TYPE_CHECK);
        dump($value);
        $value = words_filter('嬴政暴政', SensitiveWords::TYPE_WORDS);
        dump($value);
        $value = words_filter('嬴政暴政', SensitiveWords::TYPE_REPLACE);
        dump($value);
    }
}
