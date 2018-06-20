<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('available-services', 'Api\ServiceController@getAvailableServices');

Route::get('routing', 'Api\RoutingController@getPage');

Route::middleware(['client_credentials'])->group(function () {
    Route::get('employees', 'Api\Admin\EmployeeController@index');
    Route::post('employees', 'Api\Admin\EmployeeController@store');
    Route::get('employees/{id}', 'Api\Admin\EmployeeController@retrieve');
    Route::patch('employees/{id}', 'Api\Admin\EmployeeController@update');
    Route::delete('employees/{id}', 'Api\Admin\EmployeeController@destroy');

    Route::get('pages', 'Api\Admin\PageController@index');
    Route::post('pages', 'Api\Admin\PageController@store');
    Route::get('pages/{id}', 'Api\Admin\PageController@retrieve');
    Route::patch('pages/{id}', 'Api\Admin\PageController@update');
    Route::delete('pages/{id}', 'Api\Admin\PageController@destroy');

    Route::get('service-categories', 'Api\Admin\ServiceCategoryController@index');
    Route::post('service-categories', 'Api\Admin\ServiceCategoryController@store');
    Route::get('service-categories/{id}', 'Api\Admin\ServiceCategoryController@retrieve');
    Route::patch('service-categories/{id}', 'Api\Admin\ServiceCategoryController@update');
    Route::delete('service-categories/{id}', 'Api\Admin\ServiceCategoryController@destroy');

// bad. id for first is employee id. id for second is service id. wtf??? its late.
    Route::get('employee-services/{id}', 'Api\Admin\ServiceController@getEmployeeServices');
    Route::delete('employee-services/{id}', 'Api\Admin\ServiceController@destroyEmployeeService');

    Route::post('services', 'Api\Admin\ServiceController@saveInfo');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
