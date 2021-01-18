<?php namespace Poppy\Framework\Tests\Classes;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Framework\Application\TestCase;
use Poppy\Framework\Classes\RsaCrypt;

class RsaCryptTest extends TestCase
{

    /**
     * @var false|string
     */
    private $privateKey;

    /**
     * @var false|string
     */
    private $pubKey;

    public function setUp(): void
    {
        parent::setUp();
        $this->privateKey = file_get_contents(dirname(__DIR__) . '/files/demo-private.pem');
        $this->pubKey     = file_get_contents(dirname(__DIR__) . '/files/demo-pub.pem');
    }

    public function testEncrypt()
    {
        $rsa = new RsaCrypt();
        $rsa->setPrivateKey($this->privateKey);
        $rsa->setPublicKey($this->pubKey);
        $encrypt = $rsa->sign('abc');
        $this->outputVariables($encrypt);
        $this->assertTrue($rsa->verify('abc', $encrypt), 'crypt is not correct!');
    }

    public function testDecrypt()
    {
        $rsa = new RsaCrypt();
        $rsa->setPrivateKey($this->privateKey);
        $rsa->setPublicKey($this->pubKey);
        $content = $rsa->publicEncrypt('abc');
        $de      = $rsa->privateDecrypt($content);
        $this->assertEquals('abc', $de);
    }
}
