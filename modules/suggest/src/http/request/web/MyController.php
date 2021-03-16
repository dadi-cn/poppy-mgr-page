<?php

namespace Suggest\Http\Request\Web;

use Poppy\Framework\Application\ApiController;

class MyController extends ApiController
{
	public function index()
	{
		return 'Suggest Web Request Success';
	}
}