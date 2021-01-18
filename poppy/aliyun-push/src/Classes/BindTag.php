<?php namespace Poppy\AliyunPush\Classes;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Poppy\AliyunPush\Classes\Sender\BaseClient;

/**
 * @url https://help.aliyun.com/document_detail/30082.html
 */
class BindTag extends BaseClient
{

    public const DEVICE_TYPE_ANDROID = 'android';
    public const DEVICE_TYPE_IOS     = 'ios';

    /**
     * @param string       $device_type 设备类型 [ANDROID|IOS]
     * @param string       $tag         标签
     * @param string|array $client_key  客户端代码
     * @return bool
     */
    public function bindDevice(string $device_type, string $tag, $client_key)
    {
        $device_type = strtolower($device_type);

        if ($device_type === 'android') {
            $appKey = $this->androidAppKey;
        }
        else {
            $appKey = $this->iosAppKey;
        }

        if (is_array($client_key)) {
            $client_key = implode(',', $client_key);
        }
        try {
            $result = $this->rpc()
                ->action('BindTag')
                ->options([
                    'query' => [
                        'AppKey'    => $appKey,
                        'ClientKey' => $client_key,
                        'KeyType'   => "DEVICE",
                        'TagName'   => $tag,
                    ],
                ])
                ->request();
            $this->saveResult($result);
            return true;
        } catch (ClientException | ServerException $e) {
            return $this->setError($e->getErrorMessage());
        }
    }
}