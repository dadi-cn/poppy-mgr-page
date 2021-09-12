<?php

namespace Poppy\AliyunPush\Classes\Sender;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Request\RpcRequest;
use Poppy\AliyunPush\Classes\Config\Config;
use Poppy\AliyunPush\Exceptions\PushException;
use Poppy\Framework\Classes\Traits\AppTrait;
use Throwable;

/**
 * @url https://help.aliyun.com/document_detail/30082.html
 */
abstract class BaseClient
{

    use AppTrait;

    /**
     * @var string
     */
    protected $iosAppKey;

    /**
     * @var string
     */
    protected $androidChannel;

    /**
     * @var string
     */
    protected $androidAppKey;


    /**
     * Aliyun Access Key
     * @var string
     */
    protected $accessKey;


    /**
     * Aliyun Access Secret
     * @var string
     */
    protected $accessSecret;

    /**
     * @var string
     */
    protected $androidActivity;

    protected $result;


    /**
     * SendBase constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->androidAppKey   = $config->getAndroidAppKey();
        $this->iosAppKey       = $config->getIosAppKey();
        $this->androidChannel  = $config->getAndroidChannel();
        $this->androidActivity = $config->getAndroidActivity();
        $this->accessKey       = $config->getAccessKey();
        $this->accessSecret    = $config->getAccessSecret();

    }

    public function setAppConfig($ak, $sk, $android_app_id, $android_channel = '', $ios_key = '')
    {
        $this->accessKey      = $ak;
        $this->accessSecret   = $sk;
        $this->androidAppKey  = $android_app_id;
        $this->androidChannel = $android_channel;
        $this->iosAppKey      = $ios_key;
    }

    public function getResult()
    {
        return $this->result;
    }

    /**
     * 获取推送RPC
     * @return RpcRequest
     * @throws ClientException
     */
    protected function rpc(): RpcRequest
    {
        return AlibabaCloud::rpc()
            ->product('Push')
            ->scheme('https')
            ->version('2016-08-01')
            ->method('POST')
            ->host('cloudpush.aliyuncs.com');
    }

    /**
     * 初始化
     * @throws PushException
     */
    protected function initClient()
    {
        try {
            AlibabaCloud::accessKeyClient($this->accessKey, $this->accessSecret)
                ->regionId('cn-hangzhou')
                ->asDefaultClient();
        } catch (Throwable $e) {
            throw new PushException($e->getMessage());
        }
    }
}