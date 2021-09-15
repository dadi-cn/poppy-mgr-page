<?php

namespace Misc\Classes\Facade;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * 前台框架
 */
class FormFacade extends IlluminateFacade
{
	/**
	 * @return string
	 */
	protected static function getFacadeAccessor(): string
	{
		return 'misc.form';
	}
}