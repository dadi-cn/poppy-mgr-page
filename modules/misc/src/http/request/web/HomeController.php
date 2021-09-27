<?php

namespace Misc\Http\Request\Web;

use Poppy\System\Http\Request\Web\WebController;

class HomeController extends WebController
{
    public function index()
    {
        return view('misc::web.home.index');
    }

    public function intro()
    {
        return view('misc::web.home.intro');
    }
}
