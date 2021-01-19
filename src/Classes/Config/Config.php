<?php namespace Poppy\AliyunPush\Classes\Config;

class Config
{

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

    public function __construct($ak, $sk, $android_app_id, $android_channel = '', $ios_key = '')
    {
        $this->accessKey      = $ak;
        $this->accessSecret   = $sk;
        $this->androidAppKey  = $android_app_id;
        $this->androidChannel = $android_channel;
        $this->iosAppKey      = $ios_key;
    }

    /**
     * @return string
     */
    public function getIosAppKey(): string
    {
        return $this->iosAppKey;
    }

    /**
     * @return string
     */
    public function getAndroidChannel(): string
    {
        return $this->androidChannel;
    }

    /**
     * @return string
     */
    public function getAndroidAppKey(): string
    {
        return $this->androidAppKey;
    }

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * @return string
     */
    public function getAccessSecret(): string
    {
        return $this->accessSecret;
    }
}