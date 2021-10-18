<?php

namespace Op\Action;

use Illuminate\Support\Str;
use Op\Classes\Kejinshou\Fluent\QqTokenDeviceInfo;
use Op\Classes\Kejinshou\Fluent\QqTokenOAuth;
use Op\Classes\Kejinshou\QqKoaClient;
use Op\Classes\Kejinshou\QqOAuth;
use Op\Classes\OpDef;
use Op\Models\OpQqToken;
use Poppy\Core\Redis\RdsDb;
use Poppy\Framework\Classes\Traits\AppTrait;

/**
 * QQ 解析和对接, 用于获取王者营地的用户信息
 */
class QqAction
{
    use AppTrait;

    /**
     * 保存QQ登录之后的授权
     * 关于 Token 的有效期说明
     * https://wiki.connect.qq.com/使用authorization_code获取access_token
     * @param string $url
     * @return bool
     */
    public function saveByUrl(string $url): bool
    {
        $OAuth  = (new QqOAuth());
        $params = $OAuth->fetchOpenToken($url);

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
     * @param OpQqToken $user
     * @return QqTokenOAuth
     */
    public function oauthInfo(OpQqToken $user): QqTokenOAuth
    {
        $oauth = $user->oauth;
        if (!$oauth) {
            // fetch oauth
            $OAuth = new QqOAuth();
            if (!$OAuth->oauthInfo($user->open_id, $user->appid, $user->access_token)) {
                return new QqTokenOAuth([]);
            }
            $result = $OAuth->getResult();
            $oauth  = [
                'sex'      => (string) data_get($result, 'gender'),
                'nickname' => (string) data_get($result, 'nickname'),
                'avatar'   => (string) data_get($result, 'figureurl_qq_1'),
            ];
            // save
            $user->oauth = (new QqTokenOAuth($oauth))->toArray();
            $user->save();
        }
        return new QqTokenOAuth($oauth);
    }

    public function deviceInfo(OpQqToken $user): QqTokenDeviceInfo
    {
        $device = $user->device_info;
        if (!$device) {
            // save
            $device            = [
                // 8-4-4-4-12
                'id' => collect([8, 4, 4, 4, 12])->map(function ($num) {
                    return strtolower(Str::random($num));
                })->join('-'),
            ];
            $user->device_info = (new QqTokenDeviceInfo($device))->toArray();
            $user->save();
        }
        return new QqTokenDeviceInfo($device);
    }

    /**
     * 获取交换的Token
     * 这个token 存储到缓存中, 有效期为 1 min
     */
    public function getXToken(OpQqToken $user): array
    {
        $tokenKey = OpDef::ckQqKoa($user->id, 'token');
        $content  = RdsDb::instance()->get($tokenKey, false);
        if (!$content) {
            $koaClient = new QqKoaClient();
            if ($koaClient->token([
                'access_token' => $user->access_token,
                'open_id'      => $user->open_id,
                'oauth'        => $this->oauthInfo($user)->toArray(),
                'device'       => $this->deviceInfo($user)->toArray(),
            ])) {
                $result  = $koaClient->getResult();
                $content = data_get($result, 'data');
                RdsDb::instance()->set($tokenKey, $this->encode($content), 'EX', 60);
                return $content;
            }
        }
        return json_decode($content, true);
    }


    /**
     * 保存所有的角色
     * @param OpQqToken $user
     * @return array
     */
    public function gameChatRoles(OpQqToken $user): array
    {
        $roleKey = OpDef::ckQqKoa($user->id, 'roles');
        $xToken  = $this->getXToken($user);
        $content = RdsDb::instance()->get($roleKey, false);
        if (!$content) {
            $koaClient = new QqKoaClient();
            if ($koaClient->gameChatRoles($this->baseParams($user), $xToken)) {
                $result  = $koaClient->getResult();
                $content = data_get($result, 'data.roles', []);
                RdsDb::instance()->set($roleKey, $this->encode($content), 'EX', 86400);
                return $content;
            }
        }
        return json_decode($content, true);
    }

    /**
     * 获取王者营地的基础信息
     * @param OpQqToken $user
     * @param           $role
     * @param           $friendUserId
     * @return array
     */
    public function campRoles(OpQqToken $user, $role, $friendUserId): array
    {
        $xToken       = $this->getXToken($user);
        $rolesKey     = OpDef::ckQqKoa('camp-' . $friendUserId, 'roles');
        $koaClient    = new QqKoaClient();
        $rolesContent = RdsDb::instance()->get($rolesKey, false);
        if (!$rolesContent) {
            // 所有角色列表
            if ($koaClient->gameBattleProfile($this->baseParams($user), $xToken, $role, $friendUserId)) {
                $result       = $koaClient->getResult();
                $rolesContent = $this->encode(data_get($result, 'data.rolelist'));
                RdsDb::instance()->set($rolesKey, $rolesContent);
            }
        }
        return json_decode($rolesContent, true);
    }

    /**
     * 获取我的所有的英雄/皮肤列表
     * @param OpQqToken $user
     * @param           $role
     * @return array|bool
     */
    public function playH5GetHeroSkinList(OpQqToken $user, $role)
    {
        $xToken = $this->getXToken($user);

        $skinTypeKey = OpDef::ckQqKoa('public', 'skin-types');
        $skinTypes   = RdsDb::instance()->get($skinTypeKey, false);
        $skinAllKey  = OpDef::ckQqKoa('public', 'skin-all');
        $skinAll     = RdsDb::instance()->get($skinAllKey, false);
        $heroAllKey  = OpDef::ckQqKoa('public', 'hero-all');
        $heroAll     = RdsDb::instance()->get($heroAllKey, false);

        $koaClient = new QqKoaClient();
        if ($koaClient->playH5GetHeroSkinList($this->baseParams($user), $xToken, $role)) {
            $result = $koaClient->getResult();
            if (!$skinTypes) {
                $skinTypes = data_get($result, 'data.skinCountInfo.skinTypeList');
                RdsDb::instance()->set($skinTypeKey, $this->encode($skinTypes), 'EX', 86400);
            }
            else {
                $skinTypes = json_decode($skinTypes, true);
            }
            if (!$skinAll) {
                $skinAll = data_get($result, 'data.heroSkinConfList');
                RdsDb::instance()->set($skinAllKey, $this->encode($skinAll), 'EX', 86400);
            }
            else {
                $skinAll = json_decode($skinAll, true);
            }
            if (!$heroAll) {
                $heroAll = data_get($result, 'data.heroConfList');
                RdsDb::instance()->set($heroAllKey, $this->encode($heroAll), 'EX', 86400);
            }
            else {
                $heroAll = json_decode($heroAll, true);
            }
            $myHeroes = collect(data_get($result, 'data.heroList'))->map(function ($item) use ($heroAll) {
                return data_get($heroAll[$item['heroId']], 'name');
            });
            $mySkins  = collect(data_get($result, 'data.heroSkinList'))->map(function ($item) {
                return [
                    'title' => $item['szTitle'],
                    'type'  => $item['iClass'] ?? 0,
                    'id'    => $item['skinId'],
                ];
            });

            return [
                'heros'      => $myHeroes,
                'skins'      => $mySkins,
                'skin-types' => $skinTypes,
                'skin-all'   => $skinAll,
            ];
        }
        else {
            return $this->setError($koaClient->getError());
        }
    }

    /**
     * 编码数组
     * @param $content
     * @return false|string
     */
    private function encode($content)
    {
        return json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * 基础的参数
     * @param OpQqToken $user
     * @return array
     */
    private function baseParams(OpQqToken $user): array
    {
        return [
            'access_token' => $user->access_token,
            'open_id'      => $user->open_id,
            'oauth'        => $this->oauthInfo($user)->toArray(),
            'device'       => $this->deviceInfo($user)->toArray(),
        ];
    }

}