<?php namespace Poppy\CanalEs\Tests;

use Poppy\Framework\Application\TestCase;

class RecordsTest extends TestCase
{
    public function testFormat()
    {
        $arr = [
            [
                "create" => ['..'],
            ],
            [
                "delete" => ['..'],
            ],
            [
                "delete" => ['..'],
            ],
            [
                "update" => ['..'],
            ],
            [
                "update" => ['..'],
            ],
            [
                "doc" => ['..'],
            ],
            [
                "doc" => ['..'],
            ],
            [
                "doc" => ['..'],
            ],
        ];


        $new    = array_reduce($arr, function ($carry, $item) {
            return array_merge($carry, array_keys($item));
        }, []);
        $values = array_count_values($new);
        $this->assertCount(4, $values);
    }
}