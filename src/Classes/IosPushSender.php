<?php

namespace Poppy\AliyunPush\Classes;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Poppy\AliyunPush\Classes\Config\Config;
use Poppy\AliyunPush\Classes\Sender\BaseClient;
use Poppy\AliyunPush\Exceptions\PushException;

/**
 * @url https://help.aliyun.com/document_detail/30082.html
 */
class IosPushSender extends BaseClient
{

    /**
     * SendIos 构建器.
     * @param Config $config
     * @throws PushException
     */
    public function __construct(Config $config)
    {
        parent::__construct($config);
        if (!$this->iosAppKey) {
            throw new PushException('IOS 应用KEY 未设置');
        }
    }


    /**
     * 发送 IOS 设备
     * @param string $title          标题
     * @param string $body           内容
     * @param string $broadcast_type 推送目标
     * @param array  $ids            注册ID
     * @param string $tags           注册标签
     * @param string $extra          附加参数
     * @return bool
     * @throws PushException
     */
    public function sendNotice(string $title, string $body, string $broadcast_type, array $ids, $tags = '', $extra = ''): bool
    {

        $targets    = $this->getTargetSetting($broadcast_type, $ids, $tags);
        $iosApnsEnv = is_production() ? 'PRODUCT' : 'DEV';
        try {
            $this->initClient();
            $result = $this->rpc()
                ->action('PushNoticeToiOS')
                ->options([
                    'query' => [
                        'AppKey'        => $this->iosAppKey,
                        'ExtParameters' => $extra,
                        'ApnsEnv'       => $iosApnsEnv,
                        'Title'         => $title,
                        'Body'          => $body,
                        'Target'        => $targets['target'],
                        'TargetValue'   => $targets['value'],
                    ],
                ])
                ->request();
            $this->saveResult($result);
            return true;
        } catch (ClientException | ServerException $e) {
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 检测发送参数
     * @param string $title          标题
     * @param string $body           内容
     * @param string $broadcast_type 类型
     * @param array  $ids            注册ID
     * @param string $tags           注册标签
     * @return bool
     * @throws PushException
     * @url https://api.aliyun.com/#/?product=Push&version=2016-08-01&api=PushMessageToiOS&params={}&tab=DOC&lang=PHP
     */
    public function sendMessage(string $title, string $body, string $broadcast_type, array $ids, $tags = ''): bool
    {
        $targets = $this->getTargetSetting($broadcast_type, $ids, $tags);
        try {
            $this->initClient();
            $result = $this->rpc()
                ->action('PushMessageToiOS')
                ->options([
                    'query' => [
                        'AppKey'      => $this->iosAppKey,
                        'Title'       => $title,
                        'Body'        => $body,
                        'Target'      => $targets['target'],
                        'TargetValue' => $targets['value'],
                    ],
                ])
                ->request();
            $this->saveResult($result);
            return true;
        } catch (ClientException | ServerException $e) {
            return $this->setError($e->getMessage());
        }
    }
}