<?php

namespace Php\Tests\Third;

/**
 * Copyright (C) Update For IDE
 */

use Carbon\Carbon;
use Poppy\System\Models\PamAccount;
use Poppy\System\Tests\Base\SystemTestCase;

class JwtTest extends SystemTestCase
{
    /**
     * @var int
     */
    private $pamId;

    public function setUp(): void
    {
        parent::setUp();
        $this->pamId = PamAccount::orderByRaw('rand()')->value('id');
    }

    /**
     * 这里的生成Token不能作为修改邮箱的时间凭证
     * 因为没办法确认这个账号是否修改过密码
     * 或这个这个授权是否再次生效过, 所以不能使用
     */
    public function testGenToken()
    {
        $code = auth('jwt')->setTTL(Carbon::now()->addDay()->diffInMinutes())->claims([
            'action' => 'forgot_password',
            'email'  => 'zhaody901@126.com',
        ])->tokenById($this->pamId);

        $this->outputVariables($code);
        $api  = auth('jwt');
        $auth = $api->setToken($code);
        $pam  = $auth->user();
        if (!$pam) {
            $this->assertTrue(false, '用户不存在或者是未设置 JWT TOKEN');
        }
        $paylod = $auth->payload();
        $action = $paylod->get('action');
        $mail   = $paylod->get('email');
        $this->assertEquals('forgot_password', $action);
        $this->assertEquals('zhaody901@126.com', $mail);
    }
}