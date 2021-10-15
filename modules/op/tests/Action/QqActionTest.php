<?php

namespace Op\Tests\Action;

use Op\Action\QqAction;
use Op\Models\OpQqToken;
use Poppy\Framework\Application\TestCase;

class QqActionTest extends TestCase
{
    public function testParseNetUrl()
    {
        $url    = 'https://imgcache.qq.com/open/connect/widget/mobile/login/proxy.htm?#&t=1634113064#&openid=B75CBDC9285B1513C6F2E78B4F793202&appid=1105200115&access_token=C95353EF3ABFBDA12A48D607AFCE9ADA&pay_token=DD03F57240A45EB2FDB1549026A58D6D&key=d5575f4f1055d0fb1968689b242f60a2&serial=&token_key=&browser=0&browser_error=0&status_os=11&sdkv=3.5.3_full&status_machine=HUAWEI2300P&update_auth=0&has_auth=1&auth_time=1634113041450&page_type=1&redirect_uri_key=713A4A803423112ECEEDE657A39910ED30A602D2E8F0417E88C213FFEE9E7E364329E571D17C047F7404C14A174AAF074FBFB35FF64D5A6C8E5161343D0ED0ADEC147206D34B3A62C8274F63AE34D9B23F2D168CAE3B7D564BFFA9EE94AF53211EC9AC5EAFFECF7CD2AF327544CA7F08140EE9483A48EDC71511B57AEA97C267759C8300F7083C2E4E72474AF7C61A2A1CFFAC7E79440C7290A17C0BC3AC4D6F4EF1E27E4D00E4CBE0F6E961302207CC716B2E4F16AB2339951C9FDD0E5AAA5FB26D5EA90B67EB70BB69ECFF681850C440CC0E903A42DB19C042A66ED31F0A512CF512A3BD8A0AC1963BE5524E8A8ED60589BD0F5A6ECB510DB9185453DE3AFCDF0D10AABE950A7E468EF1E5D41C49DBF9A8FA546ED1037E91D90D6306BC15A8E95682E5B90536FBF0962CCED66EC6D2';
        $parsed = (new QqAction())->saveByUrl($url);
        $this->assertTrue($parsed);
    }

    public function testOauth()
    {
        /** @var OpQqToken $token */
        $token    = $this->user();
        $QqAction = new QqAction();
        $oauth    = $QqAction->oauthInfo($token);
        $this->assertNotEmpty($oauth, '用户的OAuth信息获取失败');
    }

    public function testXToken()
    {
        $token  = $this->user();
        $OAuth  = new QqAction();
        $xToken = $OAuth->getXToken($token);
        $this->outputVariables($xToken);
    }

    public function testGameRoles()
    {
        $token = $this->user();
        $OAuth = new QqAction();
        $roles = $OAuth->gameChatRoles($token);
        $this->outputVariables($roles);
    }

    public function testGameSkin()
    {
        $token = $this->user();
        $OAuth = new QqAction();
        $roles = $OAuth->gameChatRoles($token);
        if (!count($roles)) {
            $this->outputVariables('无相关角色, 不进行查询');
            return;
        }
        $role = collect($roles)->shuffle()->first();
        $skin = $OAuth->playH5GetHeroSkinList($token, $role);
        $this->outputVariables($skin);
    }

    /**
     * 获取用户
     * @return OpQqToken|null
     */
    public function user(): ?OpQqToken
    {
        /** @var OpQqToken $token */
        $token = OpQqToken::orderByRaw('rand()')->first();
        if (!$token) {
            $this->fail('没有可以使用的 session');
        }
        return $token;
    }
}
