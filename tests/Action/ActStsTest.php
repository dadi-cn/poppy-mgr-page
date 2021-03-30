<?php

namespace Poppy\AliyunOss\Tests;

use Poppy\AliyunOss\Action\ActSts;
use Poppy\System\Tests\Base\SystemTestCase;

class ActStsTest extends SystemTestCase
{
    /**
     * @var array config
     */
    private $config;

    public function setUp(): void
    {
        parent::setUp();
        $this->config = $this->readJson('poppy.aliyun-oss', 'tests/config/account.test.json');
    }

    public function testTempKey()
    {
        $config = $this->config;
        $Sts    = new ActSts();
        $Sts->setConfig($config['temp_key'], $config['temp_secret'], $config['bucket'], $config['endpoint'], $config['arn'], $config['url']);
        if ($Sts->tempOss()) {
            $temp = $Sts->getTempKey();
            $this->outputVariables($temp);
            $this->assertIsArray($temp);
        }
        else {
            $this->assertTrue(false, $Sts->getError());
        }
    }
}
