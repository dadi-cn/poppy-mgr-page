<?php

namespace Php\Tests\Third;

use Carbon\Carbon;
use Poppy\System\Models\PamAccount;
use Poppy\System\Tests\Base\SystemTestCase;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\JWTGuard;

class JwtTest extends SystemTestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->pam = PamAccount::orderByRaw('rand()')->first();
    }

    /**
     * 这里的生成Token不能作为修改邮箱的时间凭证
     * 因为没办法确认这个账号是否修改过密码
     * 或这个这个授权是否再次生效过, 所以不能使用
     */
    public function testGenToken()
    {
        /** @var JWTGuard|JWTAuth $Jwt */
        $Jwt = auth('jwt');

        $action = 'reset-password';
        $mail   = $this->faker()->email;
        /**
         * Jwt 不要使用 tokenById, 他还要重新取回一下用户
         */
        $Jwt->setTTL(Carbon::now()->addDay()->diffInMinutes())->claims([
            'action' => $action,
            'email'  => $mail,
        ]);
        $code = $Jwt->fromUser($this->pam);

        $this->outputVariables($code, "JwtToken");

        // wrong token
        try {
            auth('jwt')->setToken($code . 'x');
        } catch (TokenInvalidException $e) {
            $this->assertTrue(true);
        }

        // 使用 Token 校验, 直接获取到 token 的信息
        /** @var JWTAuth $jwtSuccess */
        $jwtSuccess = auth('jwt');
        $jwtSuccess = $jwtSuccess->setToken($code);
        if ($payload = $Jwt->getPayload()) {
            $this->outputVariables($payload, "Payload");
            $this->assertEquals($this->pam->id, data_get($payload, 'user.id'));
            $this->assertEquals($this->pam->type, data_get($payload, 'user.type'));
            $this->assertEquals($action, data_get($payload, 'action'));
            $this->assertEquals($mail, data_get($payload, 'email'));
        }

        // 当需要用户的时候这里才会去做数据库的查询
        $pam = $jwtSuccess->user();

        $this->outputVariables($pam, "User");
    }
}