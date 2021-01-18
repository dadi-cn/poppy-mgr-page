<?php namespace Demo\Http\Request\Web;

use Poppy\Framework\Application\Controller;

class DemoController extends Controller
{
    public function index()
    {
        return 'Demo Web Request Success';
    }
}