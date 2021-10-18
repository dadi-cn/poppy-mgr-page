<?php

namespace Op\Classes\Kejinshou;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Poppy\Framework\Classes\Traits\AppTrait;

/**
 * QQ 解析和对接, 用于获取王者营地的用户信息
 */
class QqKoaCampClient
{
    use AppTrait;

    /**
     * 当前获取
     * @var array
     */
    private array $result = [];

    /**
     * 客户端
     * @var Client
     */
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://kohcamp.qq.com',
            'headers'  => [
                'content-type' => 'application/json',
            ],
        ]);
    }

    /**
     * 英雄皮肤列表
     */
    public function campSearch($base, $xToken, $role, $kw): bool
    {
        $Client = new Client([
            'base_uri' => 'https://kohcamp.qq.com',
        ]);
        try {
            $options = $this->buildOptions($base, $xToken, $role);

            // append keyword
            $options['json']['key_word'] = $kw;

            $resp = $Client->post('search/getbytype', $options);
        } catch (GuzzleException $e) {
            return $this->setError($e);
        }
        $con          = $resp->getBody()->getContents();
        $this->result = json_decode($con, true);
        return true;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public static function buildKeys($params): array
    {
        $device   = data_get($params, 'device');
        $deviceId = data_get($device, 'id');
        return [
            'key1'  => $deviceId,
            'key6'  => 414,
            'key7'  => 896,
            'key9'  => 'iPhone',
            'key10' => 3948838912,
            'key11' => 'ARM64',
            'key13' => 'WiFi',
            'key14' => '',
            'key15' => '00000000-0000-0000-0000-000000000000',
            'key18' => 'iPhone11,6',
            'key19' => '0.000000',
            'key20' => '0.000000',
            'key21' => '',
            'key22' => '',
        ];
    }


    /**
     * 构建请求参数, 包含 Header/ 参数
     * @param array $params
     * @param array $xToken
     * @param array $role
     * @return array
     */
    private function buildOptions(array $params, array $xToken, array $role): array
    {
        // base
        $oOpenId = data_get($params, 'open_id');

        // xtoken
        $token       = data_get($xToken, 'token');
        $gameUserSex = data_get($xToken, 'sex');
        $userId      = data_get($xToken, 'userId');

        // role
        $gameOpenId   = data_get($role, 'openid');
        $gameAreaId   = data_get($role, 'areaId');
        $gameServerId = data_get($role, 'serverId');
        $gameRoleId   = data_get($role, 'roleId');

        $clientRequestTime = (int) microtime(true) * 1000;
        $keys              = self::buildKeys($params);
        $headers           = array_merge([
            'noencrypt'          => '1',
            'crand'              => $clientRequestTime,
            'cGzip'              => '1',
            'User-Agent'         => 'SmobaHelper/5.71.101 (iPhone; iOS 14.6; Scale/3.00)',
            'cClientVersionCode' => QqKoaClient::$clientCode,
            'cClientVersionName' => QqKoaClient::$clientVersion,
            'cSystem'            => 'ios',
            'cChannelId'         => '0',
            'isTestFlight'       => '0',
            'cSystemVersionCode' => '14.6',
            'accept-language'    => 'zh-Hans-CN;q=1',
            'cSystemVersionName' => 'iOS',
            'cGameId'            => QqKoaClient::$gameId,
            'gameId'             => QqKoaClient::$gameId,
            'cCurrentGameId'     => QqKoaClient::$gameId,
            'openId'             => $oOpenId,
            'token'              => $token,
            "userId"             => (string) $userId,
            'gameUserSex'        => $gameUserSex,
            'gameAreaId'         => $gameAreaId,
            'gameRoleId'         => $gameRoleId,
            'gameServerId'       => $gameServerId,
            'gameOpenId'         => $gameOpenId,
        ], $keys);
        $params            = array_merge([
            "cGameId"                  => (int) QqKoaClient::$gameId,
            "session_id"               => (string) ((int) $clientRequestTime / 1000),
            "kWegIosNativeTrpcMarkKey" => "1",
            "correct"                  => true,
            "cGzip"                    => 1,
            "gameId"                   => (int) QqKoaClient::$gameId,
            "cRand"                    => (string) $clientRequestTime,
            "num"                      => 30,
            "gameServerId"             => (int) $gameServerId,
            "cCurrentGameId"           => (int) QqKoaClient::$gameId,
            "reportHashValue"          => "10742940224",
            "gameUserSex"              => (int) $gameUserSex,
            "cSystemVersionName"       => "iOS",
            "cClientVersionCode"       => QqKoaClient::$clientCode,
            "gameRoleId"               => (string) $gameRoleId,
            "gameAreaId"               => (int) $gameAreaId,
            "cChannelId"               => 0,
            "recommendPrivacy"         => 0,
            "type"                     => 1005,
            "page"                     => 1,
            "gameOpenId"               => $gameOpenId,
            "cSystem"                  => "ios",
            "cSystemVersionCode"       => "14.6",
            "openId"                   => $oOpenId,
            "isTestFlight"             => 0,
            "token"                    => $token,
            "type_str"                 => "",
            "cClientVersionName"       => QqKoaClient::$clientVersion,
            "userId"                   => (string) $userId,
        ], $keys);
        return [
            'json'    => $params,
            'headers' => $headers,
        ];
    }
}