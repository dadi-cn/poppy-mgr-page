<?php

namespace Php\Tests\Third;

/**
 * Copyright (C) Update For IDE
 */

use Carbon\Carbon;
use Poppy\System\Models\PamAccount;
use Poppy\System\Tests\Base\SystemTestCase;
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

        /**
         * Jwt 不要使用 tokenById, 他还要重新取回一下用户
         */
        $Jwt->setTTL(Carbon::now()->addDay()->diffInMinutes())->claims([
            'action' => 'forgot_password',
            'email'  => 'zhaody901@126.com',
        ]);
        $code = $Jwt->fromUser($this->pam);

        $this->outputVariables($code, "JwtToken");
        $auth = $Jwt->setToken($code);
        $this->sqlLog();
        $pam = $auth->user();
        if (!$pam) {
            $this->assertTrue(false, '用户不存在或者是未设置 JWT TOKEN');
        }
        $payload = $auth->payload();
        $this->outputVariables($payload, "Payload");
        $action = $payload->get('action');
        $mail   = $payload->get('email');
        $this->assertEquals('forgot_password', $action);
        $this->assertEquals('zhaody901@126.com', $mail);
    }
}