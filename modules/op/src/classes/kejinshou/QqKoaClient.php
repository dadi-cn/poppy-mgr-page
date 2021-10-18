<?php

namespace Op\Classes\Kejinshou;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Poppy\Framework\Classes\Traits\AppTrait;

/**
 * QQ 解析和对接, 用于获取王者营地的用户信息
 */
class QqKoaClient
{
    use AppTrait;

    /**
     * 游戏版本号
     * @var string
     */
    public static string $clientCode = '57110121091573';

    /**
     * 游戏版本ID
     * @var string
     */
    public static string $clientVersion = '5.71.101';

    /**
     * @var string 王者荣耀游戏ID
     */
    public static string $gameId = '20001';

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
            'base_uri' => 'https://ssl.kohsocialapp.qq.com:10001',
        ]);
    }

    /**
     * 登录交换凭证
     * open_id
     * access_token
     * oauth
     * device
     */
    public function token(array $params): bool
    {
        try {
            $resp = $this->client->post('user/login', $this->buildOptions($params));
        } catch (GuzzleException $e) {
            return $this->setError($e);
        }

        /**
         * [
         *     "result" => 0
         *     "returnCode" => 0
         *     "returnMsg" => ""
         *     "time" => "125.4"
         *     "data" => array:20 [
         *         "uin" => "B75CBDC9285B1513C6F2E78B4F793202"
         *         "userId" => "1842163274"
         *         "token" => "WsmkaD34"
         *         "new" => false
         *         "userSig" => "eJxlkF1PwjAUhu-3K5pdG9fTraOQeDFkUaKFqEOUm2ZhHRTGPkq3QIz-XdhMXOL18*S873u*LISQHT2-3cbrdVHnRphzKW00Qja2b-5gWapExEa4OvkH5alUWoo4NVK3kNAhwbivqETmRqXqVwDmEfBdMvB6zjHZizanU7zLBUqBQV9RmxbycHE-Hc-9aksgnXxk9aO7LKJ3HuknWq2CzWcQzfdOFUIUz7YMWKDCoDjh1et4R7LMr2ppnGbHH6b8sFwoJ4snfNbIF6BZHmiH3fUijTp077j0dZkL3qBfqJH6qIq8W42BAsAQX6db39YPJ71cTg__"
         *         "needAllUin" => true
         *         "time" => 1634276659
         *         "sex" => 1
         *         "avatar" => "http://thirdqq.qlogo.cn/qqapp/1105200115/B75CBDC9285B1513C6F2E78B4F793202/100"
         *         "platformAvatar" => "http://thirdqq.qlogo.cn/qqapp/1105200115/B75CBDC9285B1513C6F2E78B4F793202/100"
         *         "userName" => "多厘"
         *         "userPhone" => "152****9156"
         *         "dCode" => ""
         *         "unbind" => []
         *         "forceChangeName" => 0
         *         "forceBindPhone" => 0
         *         "bigAvatar" => "http://thirdqq.qlogo.cn/qqapp/1105200115/B75CBDC9285B1513C6F2E78B4F793202/160"
         *         "snsnickname" => "多厘"
         *         "guideInfo" => array:100 [...
         *         ]
         *         "youthPrivacyStatus" => array:3 [... ]
         *     ]
         * ]
         */
        $con          = $resp->getBody()->getContents();
        $this->result = json_decode($con, true);
        return true;
    }

    /**
     * 获取游戏角色
     * @param $input
     * @param $xToken
     * @return bool
     */
    public function gameChatRoles($input, $xToken): bool
    {
        try {
            [$headers, $params] = $this->buildUserToken($xToken);
            $resp = $this->client->post('game/chatroles', $this->buildOptions($input, $headers, $params));
        } catch (GuzzleException $e) {
            return $this->setError($e);
        }

        /**
         * roles: [{object}]
         * 0 => array:35 [
         *     "uin" => "B75CBDC9285B1513C6F2E78B4F793202"
         *     "isMainUin" => true
         *     "icon" => "http://thirdqq.qlogo.cn/qqapp/1105200115/B75CBDC9285B1513C6F2E78B4F793202/100"
         *     "nickname" => null
         *     "gameId" => "20001"
         *     "areaId" => "1"
         *     "serverId" => "1319"
         *     "roleId" => "2214262649"
         *     "isMainRole" => true
         *     "add" => 1
         *     "common" => 1
         *     "vest" => 0
         *     "display" => 1
         *     "roleName" => "多厘熊"
         *     "roleIcon" => "http://q.qlogo.cn/qqapp/1104466820/9A2B0735B2620F0B52BC8962B433AEC6/100"
         *     "level" => 7
         *     "status" => 1
         *     "originalRoleId" => "1843092194"
         *     "roleJob" => "倔强青铜III"
         *     "openid" => "9A2B0735B2620F0B52BC8962B433AEC6"
         *     "receive" => 1
         *     "c" => 1
         *     "vv" => 0
         *     "onlineTime" => 1634283246
         *     "f" => 1
         *     "roleJobId" => 1
         *     "roleDesc" => "手Q其他 青铜III"
         *     "battleGroupId" => ""
         *     "areaName" => "其他"
         *     "serverStatus" => 3
         *     "serverName" => "手Q309区"
         *     "roleText" => array:3 [
         *         0 => "其他手Q309区"
         *         1 => "倔强青铜III"
         *         2 => "Lv.7"
         *     ]
         *     "groupIds" => []
         *     "friends" => []
         *     "disLimit" => array:10 [ ... ]
         * ]
         */
        $con          = $resp->getBody()->getContents();
        $this->result = json_decode($con, true);
        return true;
    }

    /**
     * 用户基础数据查询
     */
    public function gameBattleProfile($input, $xToken, $role, $friendUserId): bool
    {
        try {
            [$headers, $params] = $this->buildRole($xToken, $role);
            $params['friendUserId'] = $friendUserId;
            $resp                   = $this->client->post('game/battleprofile', $this->buildOptions($input, $headers, $params));
        } catch (GuzzleException $e) {
            return $this->setError($e);
        }
        $con          = $resp->getBody()->getContents();
        $this->result = json_decode($con, true);
        return true;
    }

    /**
     * 英雄皮肤列表
     */
    public function playH5GetHeroSkinList($input, $xToken, $role): bool
    {
        try {
            [$headers, $params] = $this->buildRole($xToken, $role);
            $resp = $this->client->post('play/h5getheroskinlist', $this->buildOptions($input, $headers, $params));
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
            'key6'  => '414',
            'key7'  => '896',
            'key9'  => 'iPhone',
            'key10' => '3948838912',
            'key11' => 'ARM64',
            'key13' => 'WiFi',
            'key14' => '',
            'key15' => '00000000-0000-0000-0000-000000000000',
            'key18' => 'iPhone11,6',
            'key19' => '0.000000',
            'key20' => '0.000000',
            'key21' => 'cgameid: ' . self::$gameId,
            'key22' => '',
        ];
    }

    private function buildRole($xToken, $role): array
    {
        $openId   = data_get($role, 'openid');
        $areaId   = data_get($role, 'areaId');
        $serverId = data_get($role, 'serverId');
        $roleId   = data_get($role, 'roleId');
        $sex      = data_get($role, '0');

        [$headers, $params] = $this->buildUserToken($xToken);
        return [
            array_merge([
                'gameopenid'   => $openId,
                'gameserverid' => $serverId,
                'gameroleid'   => $roleId,
                'gameareaid'   => $areaId,
                'gameusersex'  => $sex,
            ], $headers), array_merge([
                'gameAreaId'   => $areaId,
                'gameOpenId'   => $openId,
                'gameRoleId'   => $roleId,
                'gameServerId' => $serverId,
                'gameUserSex'  => $sex,
                'roleId'       => $roleId,
            ], $params),
        ];
    }

    /**
     * 构建用户授权的Token
     * @param $xToken
     * @return array[]
     */
    private function buildUserToken($xToken): array
    {
        $token = data_get($xToken, 'token');
        $uid   = data_get($xToken, 'userId');
        return [
            [
                'userid' => $uid,
                'token'  => $token,
            ], [
                'userId' => $uid,
                'token'  => $token,
            ],
        ];
    }

    /**
     * 构建请求参数, 包含 Header/ 参数
     * @param array $params
     * @param array $appendHeaders
     * @param array $appendParams
     * @return array
     */
    private function buildOptions(array $params, array $appendHeaders = [], array $appendParams = []): array
    {
        $oauth        = data_get($params, 'oauth');
        $oAccessToken = data_get($params, 'access_token');
        $oOpenId      = data_get($params, 'open_id');
        $oNickname    = data_get($oauth, 'nickname');
        $oAvatar      = data_get($oauth, 'avatar');
        $oSex         = data_get($oauth, 'sex');

        $clientRequestTime = (int) microtime(true) * 1000;
        $keys              = self::buildKeys($params);
        $headers           = array_merge([
            'gameopenid'         => '',
            'ccurrentgameid'     => self::$gameId,
            'cchannelid'         => '0',
            'cgzi'               => '',
            'noencrypt'          => '1',
            'crand'              => $clientRequestTime,
            'gameserverid'       => '0',
            'user-agent'         => 'SmobaHelper/5.71.101 (iPhone; iOS 14.6; Scale/3.00)',
            'cclientversioncode' => self::$clientCode,
            'cclientversionname' => self::$clientVersion,
            'csystemversionname' => 'iOS',
            'csystemversioncode' => '14.6',
            'csystem'            => 'ios',
            'istestflight'       => '0',
            'gameroleid'         => '',
            'gameareaid'         => '',
            'openid'             => $oOpenId,
            'gameusersex'        => '0',
            'accept-language'    => 'zh-Hans-CN;q=1',
        ], $keys, $appendHeaders);
        $params            = array_merge([
            "accessToken"        => $oAccessToken,
            "avatar"             => $oAvatar,
            "cChannelId"         => "0",
            "cClientVersionCode" => self::$clientCode,
            "cClientVersionName" => self::$clientVersion,
            "cCurrentGameId"     => self::$gameId,
            "cGameId"            => self::$gameId,
            "cGzip"              => "1",
            "cRand"              => $clientRequestTime,
            "cSystem"            => "ios",
            "cSystemVersionCode" => "14.6",
            "cSystemVersionName" => "iOS",
            "delOldUser"         => "0",
            "gameAreaId"         => "0",
            "gameId"             => self::$gameId,
            "gameOpenId"         => "",
            "gameRoleId"         => "",
            "gameServerId"       => "0",
            "gameUserSex"        => "0",
            "isTestFlight"       => "0",
            "loginType"          => "openSdk",
            "nickname"           => $oNickname,
            "openId"             => $oOpenId,
            "reportHashValue"    => "10784228032",
            "sex"                => $oSex,
            "userId"             => "0",
        ], $keys, $appendParams);
        return [
            'form_params' => $params,
            'headers'     => $headers,
        ];
    }
}