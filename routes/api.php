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

Route::get('routing', 'Api\RoutingController@getPage');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
