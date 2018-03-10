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

Route::group(['prefix' => 'api'], function() {
    Route::post('login', 'Auth\LoginController@loginMobile')->name('api.login');
    Route::get('blackpoints', 'API\BlackPointController@index')->name('api.blackpoints');
    Route::post('blackpoints/show', 'API\BlackPointController@show')->name('api.blackpoints.show');
    Route::post('blackpoints/store', 'API\BlackPointController@store')->name('api.blackpoints.store');
});

Route::group(['prefix' => 'blackpoint'], function() {
    Route::post('/', ['as' => 'blackpoint.show', 'uses' => 'BlackPointController@show']);
    Route::get('/create', ['as' => 'blackpoint.create', 'uses' => 'BlackPointController@create']);
    Route::post('/store', ['as' => 'blackpoint.store', 'uses' => 'BlackPointController@store']);
    Route::get('/list', ['as' => 'blackpoint.list', 'uses' => 'BlackPointController@list']);
    Route::get('/edit/{blackPoint}', ['as' => 'blackpoint.edit', 'uses' => 'BlackPointController@edit']);
    Route::post('/update/{blackPoint}', ['as' => 'blackpoint.update', 'uses' => 'BlackPointController@update']);
});

Route::group(['prefix' => 'reporte'], function() {
    Route::get('/', 'ReportController@index')->name('report');
    Route::get('/departamento/{city}', ['as' => 'report.department', 'uses' => 'ReportController@byDepartment']);
});


