<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

	$router->resource('admin-users', UserController::class);
    $router->resource('admin-loan-lists', LoanListController::class);
    $router->resource('admin-loan-records', LoanRecordController::class);

    $router->resource('admin-departments', DepartmentController::class);


});





