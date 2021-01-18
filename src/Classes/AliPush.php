<?php namespace Poppy\AliyunPush\Classes;

use Poppy\AliyunPush\Exceptions\PushException;
use Poppy\AliyunPush\Jobs\AndroidJob;
use Poppy\AliyunPush\Jobs\IosJob;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Helper\StrHelper;
use Poppy\Framework\Validation\Rule;
use Validator;

/**
 * @url https://help.aliyun.com/document_detail/30082.html
 */
class AliPush
{

    use AppTrait;

    const TYPE_NOTICE  = 'notice';
    const TYPE_MESSAGE = 'message';

    /**
     * 发送的信息
     * @var array
     */
    private $params;

    /**
     * @var int
     */
    private $cutNum = 100;

    /**
     * @var self
     */
    private static $instance;

    /**
     * 发送
     * @param array $params 参数
     * @return bool
     * @throws PushException
     */
    public function send(array $params): bool
    {
        if (empty($params)) {
            return $this->setError('请求参数为空, 无法发送通知');
        }

        $registrationIds = $params['registration_ids'] ?? [];

        $this->params                   = $params;
        $this->params['broadcast_type'] = strtolower($params['broadcast_type'] ?? '');
        $this->params['device_type']    = strtolower($params['device_type'] ?? 'android|notice;ios|notice');

        if (!$this->checkParams()) {
            return false;
        }

        $devices = StrHelper::parseKey($this->params['device_type']);

        if (!count($devices)) {
            return $this->setError('未指定发送设备以及发送类型');
        }

        $title         = $this->params['title'];
        $body          = $this->params['content'];
        $broadcastType = $this->params['broadcast_type'];
        $tags          = $this->params['registration_tags'] ?? '';
        $extra         = json_encode($this->params['extra'] ?? [], JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // send ios
        $iosType = $devices['ios'] ?? '';
        $iosIds  = $registrationIds['ios'] ?? [];
        if ($iosType && config('poppy.aliyun-push.ios_is_open')) {
            $this->checkSendType($iosType);
            $broadcasts = $this->toBatches($broadcastType, $iosIds);
            if (count($broadcasts)) {
                foreach ($broadcasts as $broadcast) {
                    dispatch(new IosJob($iosType, $broadcast, $title, $body, $tags, $extra));
                }
            }
        }

        // send android
        $androidType = $devices['android'] ?? '';
        $androidIds  = $registrationIds['android'] ?? [];
        if ($androidType && config('poppy.aliyun-push.android_is_open')) {
            $this->checkSendType($androidType);
            $broadcasts = $this->toBatches($broadcastType, $androidIds);

            if (count($broadcasts)) {
                foreach ($broadcasts as $broadcast) {
                    dispatch(new AndroidJob($androidType, $broadcast, $title, $body, $tags, $extra));
                }
            }
        }
        return true;
    }

    /**
     * 获取实例
     * @return self
     */
    final public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    /**
     * 返回批量处理过的通知数据
     * @param string $type 类型
     * @param array  $ids  ID
     * @return array
     */
    private function toBatches(string $type, array $ids): array
    {
        $broadcasts = [];
        switch ($type) {
            // 设备分批
            case 'device';
                $arrAndroidRegs = array_chunk($ids, $this->cutNum);
                foreach ($arrAndroidRegs as $iosReg) {
                    $broadcasts[] = [
                        'type' => $type,
                        'ids'  => $iosReg,
                    ];
                }
                break;
            case 'tag';
                $broadcasts[] = [
                    'type' => $type,
                ];
                break;
            case 'all';
                $broadcasts[] = [
                    'type'   => 'all',
                    'params' => [],
                ];
                break;
        }
        return $broadcasts;
    }

    /**
     * 检测发送参数
     * @return bool
     */
    private function checkParams(): bool
    {
        $validator = Validator::make($this->params, [
            // 设备类型
            'broadcast_type' => [
                Rule::required(),
                Rule::in(['device', 'all', 'tag']),
            ],
            'android_type'   => [
                Rule::in(['notice', 'message']),
            ],
            'ios_type'       => [
                Rule::in(['notice', 'message']),
            ],
            'title'          => [
                Rule::required(),
            ],
            'content'        => [
                Rule::required(),
            ],
        ]);
        if ($validator->fails()) {
            return $this->setError($validator->messages());
        }

        if (($this->params['broadcast_type'] === 'device') && !count($this->params['registration_ids'] ?? [])) {
            return $this->setError('用户设备号不能为空');
        }
        if (($this->params['broadcast_type'] === 'tag') && !$this->params['registration_tags']) {
            return $this->setError('用户标签不能为空');
        }
        return true;
    }

    /**
     * 发送推送类型[通知/消息]
     * @param string $type
     * @throws PushException
     */
    private function checkSendType(string $type): void
    {
        if (!in_array($type, [
            self::TYPE_MESSAGE, self::TYPE_NOTICE,
        ], false)) {
            throw new PushException("推送类型 {$type} 不允许, 仅仅支持 message/notice ");
        }
    }
}