<?php

namespace Php\Http\Request\Web;

use Poppy\System\Http\Request\Web\WebController;

class MiddlewareTestController extends WebController
{

    public function __construct()
    {
        parent::__construct();
        print_r(sys_mark('php.construct-in-controller-before', __CLASS__).'<br/>');
        $this->middleware('php.test-login');
        $this->middleware(function ($request, $next) {
            print_r(sys_mark('php.middleware-in-controller-before', __CLASS__).'<br/>');
            $response = $next($request);
            print_r(sys_mark('php.middleware-in-controller-after', __CLASS__).'<br/>');
            return $response;
        });
        print_r(sys_mark('php.construct-in-controller-after', __CLASS__).'<br/>');
    }

    /**
     * @url http://yanue.net/post-57.html
     */
    public function index()
    {
        print_r(sys_mark('php.method-in-controller', __CLASS__).'<br/>');
    }

    public function call()
    {
        $this->index();
    }
}