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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/device', 'DeviceController', ['only' => [
    'index', 'show', 'store', 'update', 'destroy'
]]);

Route::resource('/device/{device}/data', 'DeviceDataController', ['only' => [
    'index'
]]);

Route::resource('/device/{device}/config', 'DeviceConfigController',
    ['only' => ['index', 'show', 'store', 'update']
]);
