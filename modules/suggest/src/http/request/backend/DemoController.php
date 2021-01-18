<?php namespace Suggest\Http\Request\Backend;

use Poppy\System\Http\Request\Backend\BackendController;

class DemoController extends BackendController
{
	public function index()
	{
		return 'Suggest Backend Request Success';
	}
}