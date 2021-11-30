<?php

namespace Php\Tests\Laravel;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Framework\Validation\Rule;
use Poppy\System\Tests\Base\SystemTestCase;
use Validator;

class ValidatorTest extends SystemTestCase
{
    public function testUrl(): void
    {
        $validator = Validator::make([
            'url' => '',
        ], [
            'url' => [
                Rule::string(),
                Rule::url(),
            ],
        ]);
        if ($validator->fails()) {
            $this->fail('Url Not Right');
        }
        else {
            $this->assertTrue(true);
        }
    }

    public function testInteger()
    {
        $validator = Validator::make([
            'integer' => '5',
        ], [
            'integer' => [
                Rule::integer(),
            ],
        ]);
        if ($validator->fails()) {
            $this->fail('Integer Not Right');
        }
        else {
            $this->assertTrue(true);
        }
    }

    public function testNumeric()
    {
        $validator = Validator::make([
            'numeric' => '5.3',
        ], [
            'numeric' => [
                Rule::numeric(),
            ],
        ]);
        if ($validator->fails()) {
            $this->fail('Numeric Not Right');
        }
        else {
            $this->assertTrue(true);
        }
    }


    public function testCharacter(): void
    {
        $validator = Validator::make([
            'chars' => '中国人1我是啥2',
        ], [
            'chars' => [
                Rule::string(),
                Rule::min(4),
                Rule::max(8),
            ],
        ]);
        if ($validator->fails()) {
            $this->fail($validator->errors());
        }
        else {
            $this->assertTrue(true);
        }
    }

    public function testHours(): void
    {
        $validator = Validator::make([
            'hours' => '0.00',
        ], [
            'chars' => [
                Rule::string(),
                Rule::min(4),
                Rule::max(8),
            ],
        ]);
        if ($validator->fails()) {
            $this->fail($validator->errors());
        }
        else {
            $this->assertTrue(true);
        }
    }
}