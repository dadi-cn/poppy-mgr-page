<?php namespace Poppy\Extension\Pinyin\Tests;

use Exception;
use Overtrue\Pinyin\Pinyin;
use Poppy\Framework\Application\TestCase;

class PinyinTest extends TestCase
{
	protected $sentence = '带着希望去旅行，比到达终点更美好';

	/**
	 * @var Pinyin
	 */
	protected $action;


	public function setUp(): void
	{
		parent::setUp();
		$this->action = app('poppy.ext.pinyin');
	}

	/**
	 * @throws Exception
	 */
	public function testSentence(): void
	{
		$sentence = $this->action->sentence($this->sentence);
		$this->assertEquals('dai zhe xi wang qu lyu xing, bi dao da zhong dian geng mei hao', $sentence);


		$arrPy = ext_pinyin($this->sentence, PINYIN_UMLAUT_V);
		$this->assertEquals(["dai", "zhe", "xi", "wang", "qu", "lv", "xing", "bi", "dao", "da", "zhong", "dian", "geng", "mei", "hao"], $arrPy);

		$arrPy = ext_pinyin($this->sentence);
		$this->assertEquals(["dai", "zhe", "xi", "wang", "qu", "lyu", "xing", "bi", "dao", "da", "zhong", "dian", "geng", "mei", "hao"], $arrPy);
	}
}