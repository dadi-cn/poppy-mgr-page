<?php

namespace Php\Tests\VariableType;

/**
 * Copyright (C) Update For IDE
 */

use Php\Classes\Emoji;
use Poppy\Framework\Application\TestCase;

class StringTest extends TestCase
{
	/**
	 * 文字长度处理
	 */
	public function testLength(): void
	{
		$str1 = '我和😀';
		$this->assertEquals(3, Emoji::length($str1));

		$str2 = '我和🇨🇳';
		$this->assertEquals(3, Emoji::length($str2));

		$str3 = '我和 ';
		$this->assertEquals(3, Emoji::length($str3));


		/*
		$symbol = [
			'😀',
			'💘',
			'🏁',
			'🇩🇪',
			'🇧🇴',
			'🇨🇳',
			'🌨',
			'💏',
			'👯',
			'🤷‍',
			'🏴󠁧󠁢󠁥󠁮󠁧󠁿‍',
			'🏴󠁧󠁢󠁷󠁬󠁳󠁿‍',
		];
		foreach ($symbol as $s) {
			$length = Str::length($s);
			dump($length);
		}


		$unichr = function($i) {
			return iconv('UCS-4LE', 'UTF-8', pack('V', $i));
		};
		// dd(decoct(hexdec('00a9')));
		$string = '😀😛😔😭😹👇👩🙅👚👒🐶🐫🐲💐⭐️🌪🌊🍏🥜🥘🍮🥢⚽️🏋🏻🥁🚗🚆🏗🏙🏪⛩⌚️🔌🔫🚽🎐🗄📍🔎❤️⚛💞📳📛🈂🆓🔁*️⃣⚫️🕒🇨🇳🇬🇫🇽🇰🇳🇦🇹🇯🇨🇱';
		// $title = iconv('Utf-8', 'UCS-4LE', $string);
		// dd($title);
		// if (preg_match('/['. $unichr(0x1F300).'-'.$unichr(0x1F5FF). $unichr(0xE000).'-'.$unichr(0xF8FF). ']/u', $string, $matches)) {
		if (preg_match('/(\x{00a9})/u', $string, $matches)) {
			// dd($matches);
		//your code

		}

		if (preg_replace(
			// single point unicode list
			"/[\x{2600}-\x{26FF}".
			// http://www.fileformat.info/info/unicode/block/miscellaneous_symbols/list.htm
			// concatenates with paired surrogates
			preg_quote("\u{1F600}", '/')."-".preg_quote("\u{1F64F}", '/').
			// https://www.fileformat.info/info/unicode/block/emoticons/list.htm
			"]/u",
			'',
			$string,
			$matches
		)){
			dump($matches);
		}

		// if (preg_match('/(\x{00a9}|\x{00ae}|[\x{2000}-\x{3300}]|\x{d83c}[\x{d000}-\x{dfff}]|\x{d83d}[\x{d000}-\x{dfff}]|\x{d83e}[\x{d000}-\x{dfff}])/u', $string, $matches)) {
		// 	dd($matches);
		//your code

		// }

		dd("\u{1f602}");

		$this->assertTrue(true);
		// echo \x{00a9};
		*/
	}
}