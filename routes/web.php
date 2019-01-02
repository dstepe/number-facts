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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/number-lookup', 'NumberLookupController@index')->name('number-lookup');
Route::post('/number-lookup', 'NumberLookupController@lookup');

Route::get('/date-lookup', 'DateLookupController@index')->name('date-lookup');
Route::post('/date-lookup', 'DateLookupController@lookup');
