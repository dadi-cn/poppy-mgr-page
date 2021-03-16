<?php

namespace Site\Classes;

use Html;
use Illuminate\Support\HtmlString;

class Site
{

	/**
	 * Logo
	 * @return HtmlString
	 */
	public static function logo(): string
	{
		return Html::image('res/images/logo.png');
	}
}