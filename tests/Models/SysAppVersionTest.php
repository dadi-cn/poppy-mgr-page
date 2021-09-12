<?php
/*
 * This is NOT a Free software.
 * When you have some Question or Advice can contact Me.
 * @author     Duoli <zhaody901@126.com>
 * @copyright  Copyright (c) 2013-2021 Poppy Team
 */

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