<?php namespace Third\Http\Request\Web;

use Poppy\Framework\Application\Controller;

class DemoController extends Controller
{
    public function index()
    {
        return 'Third Web Request Success';
    }
}