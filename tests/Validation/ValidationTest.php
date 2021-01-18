<?php namespace Poppy\Framework\Tests\Validation;

use Poppy\Framework\Application\TestCase;
use Poppy\Framework\Validation\Rule;
use Validator;

class ValidationTest extends TestCase
{

    public function testMobile(): void
    {
        $mobile    = '17787876656';
        $validator = Validator::make([
            'mobile' => $mobile,
        ], [
            'mobile' => Rule::mobile(),
        ], [], [
            'mobile' => '手机号',
        ]);
        if ($validator->fails()) {
            $this->assertTrue(false);
        }
        else {
            $this->assertTrue(true);
        }
    }

    public function testPwd(): void
    {
        $password  = '123';
        $validator = Validator::make([
            'password' => $password,
        ], [
            'password' => Rule::simplePwd(),
        ], [], [
            'password' => '密码',
        ]);
        if ($validator->fails()) {
            $this->assertTrue(false);
        }
        else {
            $this->assertTrue(true);
        }
    }


    public function testJson(): void
    {
        $json      = '{}';
        $validator = Validator::make([
            'json' => $json,
        ], [
            'json' => Rule::json(),
        ], [], [
            'json' => 'Json',
        ]);
        if ($validator->fails()) {
            $this->assertTrue(false);
        }
        else {
            $this->assertTrue(true);
        }
    }


    public function testDate(): void
    {
        $date      = '2011-12-05';
        $validator = Validator::make([
            'date' => $date,
        ], [
            'date' => Rule::date(),
        ], [], [
            'date' => 'Date',
        ]);
        if ($validator->fails()) {
            $this->assertTrue(false);
        }
        else {
            $this->assertTrue(true);
        }
    }


    public function testChid(): void
    {
        $chid      = '640181200809108307';
        $validator = Validator::make([
            'chid' => $chid,
        ], [
            'chid' => Rule::chid(),
        ], [], [
            'chid' => 'Chid',
        ]);
        if ($validator->fails()) {
            $this->assertTrue(false);
        }
        else {
            $this->assertTrue(true);
        }
    }
}