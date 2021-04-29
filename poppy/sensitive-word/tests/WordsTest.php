<?php

namespace Poppy\SensitiveWord\Tests;

use Poppy\SensitiveWord\Classes\Sensitive\Words;
use Poppy\System\Tests\Base\SystemTestCase;

class WordsTest extends SystemTestCase
{
    public function testFilter(): void
    {
        $value = sensitive_words('暴政', Words::TYPE_CHECK);
        dump($value);
        $value = sensitive_words('嬴政暴政', Words::TYPE_WORDS);
        dump($value);
        $value = sensitive_words('嬴政暴政', Words::TYPE_REPLACE);
        dump($value);
    }
}
