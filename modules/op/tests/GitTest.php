<?php

namespace Op\Tests;

use Poppy\Framework\Application\TestCase;

class GitTest extends TestCase
{
    public function testSubtree()
    {
        $projets = [
            'ad',
            'aliyun-oss',
            'aliyun-push',
            'area',
            'core',
            'demo',
            'ext-alipay',
            'ext-aliyun',
            'ext-ip_store',
            'ext-netease',
            'ext-pinyin',
            'ext-wxpay',
            'faker',
            'framework',
            'mgr-page',
            'origin',
            'project',
            'sms',
            'system',
        ];
        foreach ($projets as $remote) {
            echo "\"py-{$remote}\": [" . PHP_EOL;
            echo "\"git push {$remote} `git subtree split --prefix=poppy/{$remote} feature/3.0`:3.0 --force\"" . PHP_EOL;
            echo "]," . PHP_EOL;
        }
    }
}
