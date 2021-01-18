<?php namespace Demo\Http\Request\Api;

use Poppy\Framework\Application\ApiController;

class DemoController extends ApiController
{
    public function index()
    {
        return 'Demo Api Request Success';
    }
}