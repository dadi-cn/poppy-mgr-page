<?php

namespace Poppy\Version\Tests\Models;

use Poppy\System\Tests\Base\SystemTestCase;
use Poppy\Version\Models\SysAppVersion;

class SysAppVersionTest extends SystemTestCase
{

    /**
     * 最新版本号
     */
    public function testVersion(): void
    {
        $version = SysAppVersion::latestVersion();
        $this->assertIsArray($version);
    }
}