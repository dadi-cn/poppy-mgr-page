<?php

namespace Php\Tests\Laravel;

use Illuminate\Support\Arr;
use Poppy\System\Tests\Base\SystemTestCase;

class ArrTest extends SystemTestCase
{
    public function testOnly()
    {
        $input = [
            'null'         => null,
            'int'          => 1,
            'string'       => 'string',
            'string_space' => 'string    ',
        ];
        $arr   = Arr::only($input, ['null', 'int', 'string', 'string_space']);
        $arr   = array_map('trim', $arr);
        $this->assertEquals([
            'null'         => '',
            'int'          => 1,
            'string'       => 'string',
            'string_space' => 'string',
        ], $arr);
    }
}