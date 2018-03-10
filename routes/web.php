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

Route::group(['prefix' => 'blackpoint'], function() {
    Route::post('/', ['as' => 'blackpoint.show', 'uses' => 'BlackPointController@show']);
    Route::get('/create', ['as' => 'blackpoint.create', 'uses' => 'BlackPointController@create']);
    Route::post('/store', ['as' => 'blackpoint.store', 'uses' => 'BlackPointController@store']);
    Route::get('/list', ['as' => 'blackpoint.list', 'uses' => 'BlackPointController@list']);
    Route::get('/edit/{blackpoint}', ['as' => 'blackpoint.edit', 'uses' => 'BlackPointController@edit']);
});

Route::group(['prefix' => 'reporte'], function() {
    Route::get('/', 'ReportController@index')->name('report');
    Route::get('/departamento/{department}', ['as' => 'blackpoint.create', 'uses' => 'BlackPointController@byDepartment']);
    Route::get('/list', ['as' => 'blackpoint.list', 'uses' => 'BlackPointController@list']);
    Route::get('/edit/{blackpoint}', ['as' => 'blackpoint.edit', 'uses' => 'BlackPointController@edit']);
});


