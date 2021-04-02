<?php

namespace Poppy\Sms\Tests;

use Poppy\System\Tests\Base\SystemTestCase;

/**
 * 发送短信
 */
class BaseSms extends SystemTestCase
{

    /**
     * 手机
     * @var array|mixed
     */
    protected $mobile;

    /**
     * 配置文件
     * @var array
     */
    protected $conf;

    public function setUp(): void
    {
        parent::setUp();
        $this->conf   = $this->readJson('poppy.sms', 'tests/config/account.json');
        $this->mobile = data_get($this->conf, 'mobile');
    }
}