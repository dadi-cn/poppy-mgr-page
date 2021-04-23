<?php

namespace Php\Tests\Text;

use Carbon\Carbon;
use Poppy\System\Models\PamAccount;
use Poppy\System\Tests\Base\SystemTestCase;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\JWTGuard;

class PcreTest extends SystemTestCase
{

    public function testReplace()
    {
        $str = '    TAB SPACE';
        $this->assertEquals('TABSPACE', preg_replace('/\s+/', '', $str));
    }
}