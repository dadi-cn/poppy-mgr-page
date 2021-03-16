<?php

namespace Suggest\Http\Request\Api;

use Poppy\Framework\Application\ApiController;

class DemoController extends ApiController
{
	public function index()
	{
		return 'Suggest Api Request Success';
	}
}