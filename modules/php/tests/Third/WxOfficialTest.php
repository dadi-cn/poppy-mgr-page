<?php

namespace Poppy\System\Tests\Action;

use EasyWeChat\Factory;
use Poppy\System\Tests\Base\SystemTestCase;

class WxOfficialTest extends SystemTestCase
{
    public function testJssdk(): bool
    {
        $appId     = 'wxdeee634e7aa5fada';
        $appSecret = 'a75adb6ee9a0ab160abae2fbf60d93e0';

        $instance = Factory::officialAccount([
            'app_id' => $appId,
            'secret' => $appSecret,
        ]);
        $config   = $instance->jssdk->buildConfig([]);
    }
}
