<?php

namespace Site\Http\Request\Web;

use Poppy\System\Http\Request\Web\WebController;

class HomeController extends WebController
{
    public function index()
    {
        return 'poppy framework';
    }

    public function vue()
    {
        return view('site::web.home.vue');
    }
}
