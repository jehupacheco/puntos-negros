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

Route::get('/', ['as' => 'blackpoint.index', 'uses' => 'BlackPointController@index']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reporte', 'ReportController@index')->name('report');

Route::group(['prefix' => 'blackpoint'], function() {
    Route::get('/create', ['as' => 'blackpoint.create', 'uses' => 'BlackPointController@create']);
    Route::post('/store', ['as' => 'blackpoint.store', 'uses' => 'BlackPointController@store']);
});


