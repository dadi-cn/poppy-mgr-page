<?php

namespace Misc\Foundation;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * poppy handler
 */
class Handler extends \Poppy\System\Http\Exception\Handler
{
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * @param Request   $request
     * @param Exception $exception
     * @return Response
     */
    public function render($request, Exception $exception)
    {
        // 这里加自定义的消息返回
        return parent::render($request, $exception);
    }
}