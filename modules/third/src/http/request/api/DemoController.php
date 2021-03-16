<?php

namespace Third\Http\Request\Api;

use Poppy\Framework\Application\ApiController;

class DemoController extends ApiController
{
    public function index()
    {
        return 'Third Api Request Success';
    }
}