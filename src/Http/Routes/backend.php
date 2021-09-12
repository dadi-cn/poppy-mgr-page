<?php

use Illuminate\Routing\Router;

Route::group([
    'namespace' => 'Poppy\Sms\Http\Request\Backend',
], function (Router $router) {
    // 短信模版配置
    $router->get('sms', 'SmsController@index')
        ->name('py-sms:backend.sms.index');
    $router->any('sms/establish/{id?}', 'SmsController@establish')
        ->name('py-sms:backend.sms.establish');
    $router->any('sms/destroy/{id}', 'SmsController@destroy')
        ->name('py-sms:backend.sms.destroy');

    $router->get('sms/store', 'SmsController@store')
        ->name('py-sms:backend.sms.store');
});