<?php

namespace Misc\Http\Request\Web;

use Poppy\System\Http\Request\Web\WebController;

class HomeController extends WebController
{
    public function index()
    {
        return 'poppy framework';
    }
}
