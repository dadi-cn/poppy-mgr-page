<?php

namespace Poppy\Extension\Netease\Tests;

use Poppy\Extension\Netease\Im\ImClient;
use Poppy\Framework\Application\TestCase;

class ImTest extends TestCase
{
	private $im;

	/**
	 * @var array 账号信息
	 */
	private $account;

	public function setUp(): void
	{
		$filePath      = __DIR__ . '/config/account.json';
		$config        = file_get_contents($filePath);
		$arrConf       = json_decode($config, true);
		$this->account = $arrConf;
		$this->im      = (new ImClient())
			->setAppKey($arrConf['key'])
			->setAppSecret($arrConf['secret']);
	}

	/**
	 * 获取新的token
	 */
	public function testGetNewToken()
	{
		$data   = [
			'accid' => 'dev_000000003',
		];
		$result = $this->im->updateUserToken($data);

		$this->assertEquals(200, data_get($result, 'code'));
	}

	/**
	 * {
	 *     "uinfos": [
	 *         {
	 *             "valid": true,
	 *             "ex": "{\\"seat\\":\\"\\"}",
	 *             "gender": 2,
	 *             "name": "切尔西@哈哈 你好",
	 *             "icon": "https:\\/\\/files.huowanes.com\\/dev\\/default\\/202001\\/13\\/11\\/5548zbojiWeZ.gif",
	 *             "sign": "这么个性，怎么能够在？",
	 *             "accid": "dev_000000003",
	 *             "mute": false
	 *         }
	 *     ],
	 *     "code": 200
	 * }
	 */
	public function testGetUserInfos()
	{
		$data = [$this->account['accid']];
		foreach ($data as $v) {
			$a[] = $v;
		}
		if (!$result = $this->im->getUserInfos($a)) {
			$this->assertEquals(true, false);
		}
		$this->outputVariables($result);
		$this->assertEquals(200, data_get($result, 'code'));
	}
}