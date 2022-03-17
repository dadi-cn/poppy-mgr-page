<?php

namespace Php\Tests\Laravel\Eloquent;

use Demo\Models\DemoWebapp;
use Illuminate\Support\Arr;
use Poppy\System\Tests\Base\SystemTestCase;

class RelationshipsTest extends SystemTestCase
{
    public function testRelCase()
    {
       $val =  DemoWebapp::with('demoComment')->first();
       $val =  DemoWebapp::with('demo_comment')->first();
       dd($val);
    }
}