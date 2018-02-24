<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//todo: is there just a unlimited wildcard to fix this?
Route::get('/', 'AppController@index')->name('home');
Route::get('/{wildcard1}', 'AppController@index')->name('home');
Route::get('/{wildcard1}/{wildcard2}', 'AppController@index')->name('home');
Route::get('/{wildcard1}/{wildcard2}/{wildcard3}', 'AppController@index')->name('home');
Route::get('/{wildcard1}/{wildcard2}/{wildcard3}/{wildcard4}', 'AppController@index')->name('home');