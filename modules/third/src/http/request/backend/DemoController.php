<?php namespace Third\Http\Request\Backend;

use Poppy\MgrPage\Http\Request\Backend\BackendController;

class DemoController extends BackendController
{
    public function index()
    {
        return 'Third Backend Request Success';
    }
}