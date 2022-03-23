<?php

namespace Php\Tests\Laravel;


use Illuminate\Support\Facades\Crypt;
use Poppy\System\Tests\Base\SystemTestCase;

class CryptTest extends SystemTestCase
{
    public function testMatch()
    {
        $stringOri = 'okijmunhyhgytrgd';
        $stringEn  = Crypt::encryptString($stringOri);
        $this->assertEquals(Crypt::decryptString($stringEn), $stringOri);
    }
}