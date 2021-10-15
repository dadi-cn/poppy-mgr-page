<?php

namespace Op\Classes\Kejinshou;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Op\Models\OpQqToken;
use Poppy\Framework\Classes\Traits\AppTrait;

/**
 * QQ 解析和对接, 用于获取王者营地的用户信息
 */
class QqOAuth
{
    use AppTrait;

    private array $result = [];

    /**
     * 保存QQ登录之后的授权
     * 关于 Token 的有效期说明
     * https://wiki.connect.qq.com/使用authorization_code获取access_token
     * @param string $url
     * @return bool
     */
    public function saveToken(string $url): bool
    {
        $params = $this->fetchOpenToken($url);

        if (!($params['openid'] || $params['appid'])) {
            return $this->setError('信息不完整');
        }

        OpQqToken::updateOrCreate([
            'open_id' => $params['openid'],
            'appid'   => $params['appid'],
        ], [
            'access_token' => $params['access_token'],
        ]);
        return true;
    }

    /**
     * 获取 oauth User Info
     * @param $openId
     * @param $consumerKey
     * @param $accessToken
     * @return bool
     */
    public function oauthInfo($openId, $consumerKey, $accessToken): bool
    {
        $client = new Client();
        $params = [
            'format'             => 'json',
            'status_version'     => '14',
            'openid'             => $openId,
            'status_machine'     => 'iPhone11,6',
            'oauth_consumer_key' => $consumerKey,
            'status_os'          => '14.6',
            'sdkv'               => '3.3.6_lite',
            'access_token'       => $accessToken,
            'sdkp'               => 'i',
        ];
        try {
            $resp = $client->get('https://openmobile.qq.com/user/get_simple_userinfo', [
                'headers' => [
                    'User-Agent' => 'TencentConnect',
                ],
                'query'   => $params,
            ]);
            $con  = $resp->getBody()->getContents();
            /**
             * [
             *    "ret" => 0
             *    "msg" => ""
             *    "is_lost" => 0
             *    "nickname" => "多厘"
             *    "gender" => "男"
             *    "gender_type" => 1
             *    "province" => "山东"
             *    "city" => "济南"
             *    "year" => "1986"
             *    "constellation" => ""
             *    "figureurl" => "http://qzapp.qlogo.cn/qzapp/1105200115/B75CBDC9285B1513C6F2E78B4F793202/30"
             *    "figureurl_1" => "http://qzapp.qlogo.cn/qzapp/1105200115/B75CBDC9285B1513C6F2E78B4F793202/50"
             *    "figureurl_2" => "http://qzapp.qlogo.cn/qzapp/1105200115/B75CBDC9285B1513C6F2E78B4F793202/100"
             *    "figureurl_qq_1" => "http://thirdqq.qlogo.cn/g?b=oidb&k=RxwhyCoLHqztjjNt6xMISQ&s=40&t=1556321295"
             *    "figureurl_qq_2" => "http://thirdqq.qlogo.cn/g?b=oidb&k=RxwhyCoLHqztjjNt6xMISQ&s=100&t=1556321295"
             *    "figureurl_qq" => "http://thirdqq.qlogo.cn/g?b=oidb&k=RxwhyCoLHqztjjNt6xMISQ&s=640&t=1556321295"
             *    "figureurl_type" => "1"
             *    "is_yellow_vip" => "0"
             *    "vip" => "0"
             *    "yellow_vip_level" => "0"
             *    "level" => "0"
             *    "is_yellow_year_vip" => "0"
             * ]
             */
            $this->result = json_decode($con, true);
            return true;
        } catch (GuzzleException $e) {
            return $this->setError($e);
        }
    }

    /**
     * 从 Url 中解析出来 token, appid, openid
     * @param string $url
     * @return array
     */
    public function fetchOpenToken(string $url): array
    {
        $lastHashAnd = strrpos($url, '#&') + 2;
        $params      = substr($url, $lastHashAnd);

        parse_str($params, $res);

        return [
            'openid'       => $res['openid'] ?? '',
            'appid'        => $res['appid'] ?? '',
            'access_token' => $res['access_token'] ?? '',
        ];
    }

    /**
     * 获取返回结果
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }
}