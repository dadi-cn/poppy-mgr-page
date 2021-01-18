<?php namespace Php\Http\Request\Web;

use Illuminate\Support\Str;
use Php\Classes\Emoji;
use Poppy\System\Http\Request\Web\WebController;

class EmojiControlController extends WebController
{
	/**
	 * @url http://yanue.net/post-57.html
	 */
	public function match()
	{
		$str = '我和🇨🇳🇨🇱';

		$this->output($str);

		$str = '我和我的祖国';

		$this->output($str);

		/* Emoji Test
		 * ---------------------------------------- */
		$string =
			'普通表情😀' .
			'心形💞' .
			'心形2💘' .
			'国旗🇨🇳' .
			'🇬🇫'.
			'龙旗🏴󠁧󠁢󠁷󠁬󠁳󠁿';
		$this->output($string);


		$eng = 'Perfectly balanced, as all things should be.';
		$this->output($eng);

		$special = '~`!@#$%^&*(){}[]:";\',./<>?';
		$this->output($special);
	}

	private function output($value)
	{
		echo $value . '<br>';
		echo 'Laravel Length:' . Str::length($value) . '<br>';
		echo 'Emoji Length:' . Emoji::length($value) . '<br>';
		for ($i = 1; $i <= Emoji::length($value); $i++) {
			echo "Laravel Limit {$i} : " . Str::limit($value, $i) . '<br>';
			echo "Emoji Limit {$i} : " . Emoji::limit($value, $i) . '<br>';
		}
		echo str_pad('', 20, '-') . '<br>';
	}
}