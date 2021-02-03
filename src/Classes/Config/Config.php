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

    /**
     * 需要打开的页面
     * @var mixed|string
     */
    protected $androidActivity;

    public function __construct($ak, $sk, $android_app_id, $android_channel = '', $android_activity = '', $ios_key = '')
    {
        $this->accessKey       = (string) $ak;
        $this->accessSecret    = (string) $sk;
        $this->androidAppKey   = (string) $android_app_id;
        $this->androidChannel  = (string) $android_channel;
        $this->androidActivity = (string) $android_activity;
        $this->iosAppKey       = (string) $ios_key;
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
    public function getAndroidActivity(): string
    {
        return $this->androidActivity;
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