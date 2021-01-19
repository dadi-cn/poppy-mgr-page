<?php namespace Op\Tests;

use Op\Action\StsAction;
use Poppy\System\Tests\Base\SystemTestCase;

class StsTest extends SystemTestCase
{
    /**
     * @var array config
     */
    private $config;

    public function setUp(): void
    {
        parent::setUp();
        $this->config = $this->readJson('module.op', 'tests/config/account.fadan.json');
    }

    public function testTempKey()
    {
        $config = $this->config;
        $Sts    = new StsAction();
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
