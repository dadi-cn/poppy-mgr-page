<?php

namespace Misc\Foundation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * poppy handler
 */
class Handler extends \Poppy\System\Http\Exception\Handler
{
    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            if (!in_array(config('app.env'), ['local', 'test'])) {
                app('sentry')->captureException($exception);
            }
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * @param Request   $request
     * @param Throwable $exception
     * @return Response
     */
    public function render($request, Throwable $exception)
    {
        // 这里加自定义的消息返回
        return parent::render($request, $exception);
    }
}