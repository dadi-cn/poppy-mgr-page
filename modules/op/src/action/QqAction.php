<?php

namespace Op\Action;

use Op\Models\OpQqToken;
use Poppy\Framework\Classes\Traits\AppTrait;

/**
 * QQ 解析和对接, 用于获取王者营地的用户信息
 */
class QqAction
{
    use AppTrait;

    /**
     * 保存QQ登录之后的授权
     * @param string $url
     * @return bool
     */
    public function saveByUrl(string $url): bool
    {
        $params = $this->parseUrl($url);

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
     * 从 Url 中解析出来 token, appid, openid
     * @param string $url
     * @return array
     */
    public function parseUrl(string $url): array
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
}