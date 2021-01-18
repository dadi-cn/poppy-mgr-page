<?php namespace Poppy\Demo\Hooks\PoppyDemoHtmlDemo;

use Poppy\Core\Services\Contracts\ServiceHtml;

/**
 * 输出 HTML
 */
class Service implements ServiceHtml
{

    public function output()
    {
        return "<div></div>";
    }
}