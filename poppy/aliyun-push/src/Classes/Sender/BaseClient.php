<?php namespace Poppy\AliyunPush\Classes\Sender;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Request\RpcRequest;
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
     * @var array 保存请求结果
     */
    protected $results;

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
     * SendBase constructor.
     * @throws PushException
     */
    public function __construct()
    {
        $this->androidAppKey  = config('poppy.aliyun-push.android_app_key');
        $this->iosAppKey      = config('poppy.aliyun-push.ios_app_key');
        $this->androidChannel = config('poppy.aliyun-push.android_channel');

        $this->initClient();
    }

    /**
     * @param string $broadcast_type 推送目标(自定义, 不区分大小写)
     * @param array  $ids            设备ID
     * @param string $tag            标签表达式[字串或者Json 表达式]
     * @return array
     * @throws PushException
     */
    public function getTargetSetting(string $broadcast_type, array $ids = [], string $tag = '')
    {
        $target         = '';
        $values         = '';
        $broadcast_type = strtolower($broadcast_type);

        switch ($broadcast_type) {
            case 'device':
                $target = 'DEVICE';
                $values = implode(',', $ids);
                break;
            case 'all':
                $target = 'ALL';
                $values = 'ALL';
                break;
            case 'tag':
                $target = 'TAG';
                $values = $tag;
                break;
        }
        if (!$target) {
            throw new PushException('推送目标未设置!');
        }
        return [
            'target' => $target,
            'value'  => $values,
        ];
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

    protected function saveResult($result)
    {
        $this->results[] = $result;
    }


    /**
     * 初始化
     * @throws PushException
     */
    private function initClient()
    {
        $accessKeyId     = config('poppy.aliyun-push.access_key');
        $accessKeySecret = config('poppy.aliyun-push.access_secret');
        try {
            AlibabaCloud::accessKeyClient($accessKeyId, $accessKeySecret)
                ->regionId('cn-hangzhou')
                ->asDefaultClient();
        } catch (Throwable $e) {
            throw new PushException($e->getMessage());
        }
    }
}