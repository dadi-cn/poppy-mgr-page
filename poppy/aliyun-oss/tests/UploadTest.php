<?php

namespace Poppy\AliyunOss\Tests;

use Poppy\AliyunOss\Classes\Provider\OssDefaultUploadProvider;
use Poppy\Framework\Application\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Throwable;

/**
 * 上传测试
 */
class UploadTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $filePath = dirname(__DIR__) . '/tests/config/account.test.json';
        $config   = file_get_contents($filePath);
        $arrConf  = json_decode($config, true);

        // config
        config([
            'poppy.aliyun-oss.access_key'    => $arrConf['access_key'],
            'poppy.aliyun-oss.access_secret' => $arrConf['access_secret'],
            'poppy.aliyun-oss.bucket'        => $arrConf['bucket'],
            'poppy.aliyun-oss.url'           => $arrConf['url'],
            'poppy.aliyun-oss.endpoint'      => $arrConf['endpoint'],
        ]);
    }

    public function testUpload()
    {
        try {
            $file   = poppy_path('poppy.aliyun-oss', 'tests/files/demo.jpg');
            $image  = new UploadedFile($file, 'test.jpg', null, null, true);
            $Upload = new OssDefaultUploadProvider();

            $Upload->setExtension(['jpg']);
            if (!$Upload->saveFile($image)) {
                $this->assertFalse(true, $Upload->getError());
            }

            // 检测文件存在
            $url = $Upload->getUrl();
            if ($content = file_get_contents($url)) {
                $this->outputVariables($url);
                $this->assertTrue(true);
            }
            else {
                $this->assertTrue(false, "Url {$url} 不可访问!");
            }
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }
}