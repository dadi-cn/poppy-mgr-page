<?php namespace Poppy\AliyunPush\Classes;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Poppy\AliyunPush\Classes\Sender\BaseClient;
use Poppy\AliyunPush\Exceptions\PushException;

/**
 * @url https://help.aliyun.com/knowledge_detail/48089.html
 */
class AndroidPushSender extends BaseClient
{

    /**
     * SendAndroid constructor.
     * @throws PushException
     */
    public function __construct()
    {
        parent::__construct();
        if (!$this->androidAppKey) {
            throw new PushException('Android 应用 KEY 未设置');
        }

        if (!$this->androidChannel) {
            throw new PushException('Android 应用通知频道未设置');
        }
    }

    /**
     * 发送 Android 通知
     * @param string $title          标题
     * @param string $body           内容
     * @param string $broadcast_type 推送目标
     * @param array  $ids            注册ID
     * @param string $tags           注册标签
     * @param string $extra          附加的数据
     * @return bool
     * @throws PushException
     */
    public function sendNotice(string $title, string $body, string $broadcast_type, array $ids, string $tags = '', string $extra = ''): bool
    {
        $targets = $this->getTargetSetting($broadcast_type, $ids, $tags);
        try {
            $this->initClient();
            $result = $this->rpc()
                ->action('Push')
                ->options([
                    'query' => [
                        'AppKey'                     => $this->androidAppKey,
                        'PushType'                   => 'NOTICE',
                        'DeviceType'                 => 'ANDROID',
                        'Title'                      => $title,
                        'Body'                       => $body,
                        'Target'                     => $targets['target'],
                        'TargetValue'                => $targets['value'],
                        'AndroidExtParameters'       => $extra,
                        'AndroidNotificationChannel' => $this->androidChannel,
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
     * 发送 Android 消息
     * @param string $title
     * @param string $body
     * @param string $broadcast_type
     * @param array  $ids  注册ID
     * @param string $tags 注册标签
     * @return bool
     * @throws PushException
     */
    public function sendMessage(string $title, string $body, string $broadcast_type, array $ids, string $tags = ''): bool
    {
        $targets = $this->getTargetSetting($broadcast_type, $ids, $tags);
        try {
            $this->initClient();
            $result = $this->rpc()
                ->action('Push')
                ->options([
                    'query' => [
                        'AppKey'      => $this->androidAppKey,
                        'PushType'    => 'MESSAGE',
                        'DeviceType'  => 'ANDROID',
                        'Target'      => $targets['target'],
                        'TargetValue' => $targets['value'],
                        'Body'        => $body,
                        'Title'       => $title,
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