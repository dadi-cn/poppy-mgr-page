<?php

namespace Poppy\Sms\Classes;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Sms\Classes\Contracts\SmsContract;
use Poppy\Sms\Exceptions\SmsException;
use SimpleXMLElement;
use Throwable;

class AliyunSms extends BaseSms implements SmsContract
{
    use AppTrait;

    /**
     * AliyunSms constructor.
     * @throws SmsException
     */
    public function __construct()
    {
        $this->initClient();
    }

    /**
     * @param string       $type    模版代码
     * @param array|string $mobiles 手机号码
     * @param array        $params  额外参数
     * @return mixed|SimpleXMLElement
     */
    public function send(string $type, $mobiles, array $params = []): bool
    {
        if (!$this->checkSms($mobiles, $type)) {
            return false;
        }
        $sign = config('poppy.sms.sign');

        if (!$sign) {
            return $this->setError('尚未设置签名, 无法发送');
        }

        try {
            if (!class_exists('AlibabaCloud\Dysmsapi\Dysmsapi')) {
                throw new SmsException('你需要手动安装 `alibabacloud/dysmsapi` 组件');
            }
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => array_merge([
                        'PhoneNumbers' => $mobiles,
                        'SignName'     => $sign,
                        'TemplateCode' => $this->sms['code'],
                    ], $params ? [
                        'TemplateParam' => json_encode($params, JSON_UNESCAPED_UNICODE),
                    ] : []),
                ])
                ->request();

            /**
             * 返回的信息如下所示, 如果失败 Message 中是错误的信息
             * {
             *    "RequestId":"04B69136-3DF5-4418-9A8C-5A9278608259",
             *    "Message":"OK",
             *    "BizId":"340723709666881413^0",
             *    "Code":"OK"
             * }
             */
            $resp = $result->toArray();
            if ($resp['Code'] === 'OK') {
                return true;
            }
            return $this->setError('Aliyun:' . $resp['Message']);
        } catch (ClientException | ServerException $e) {
            return $this->setError($e->getErrorMessage());
        } catch (SmsException $e) {
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 初始化
     * @throws SmsException
     */
    private function initClient()
    {
        $accessKeyId     = config('poppy.sms.aliyun.access_key');
        $accessKeySecret = config('poppy.sms.aliyun.access_secret');
        try {
            if (!class_exists('AlibabaCloud\Client\AlibabaCloud')) {
                throw new SmsException('你需要手动安装 `alibabacloud/client` 组件');
            }
            AlibabaCloud::accessKeyClient($accessKeyId, $accessKeySecret)
                ->regionId('cn-hangzhou')
                ->asDefaultClient();
        } catch (Throwable $e) {
            throw new SmsException($e->getMessage());
        }
    }
}
