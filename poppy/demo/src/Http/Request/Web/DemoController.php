<?php namespace Poppy\Demo\Http\Request\Web;

use Poppy\System\Classes\Layout\Demo;
use Poppy\System\Http\Request\Web\WebController;

/**
 * 内容生成器
 */
class DemoController extends WebController
{
    /**
     * Demo
     */
    public function index()
    {
        return (new Demo());
    }
}