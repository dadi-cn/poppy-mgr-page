<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'namespace'  => 'Php\Http\Request\Backend',
], function (Illuminate\Routing\Router $route) {
	$route->get('exam', 'ExamController@index')
		->name('php:backend.exam.index');
	$route->get('exam/establish/{id?}', 'ExamController@establish')
		->name('php:backend.exam.establish');
});