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
Route::get('/admin/logout', 'Admin\Auth\Login@logout');
Route::get('/admin/login', 'Admin\Auth\Login@showLoginForm');
Route::post('/admin/login', 'Admin\Auth\Login@login');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', 'Admin\Home@index');
    Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('admin/user/requests', 'Admin\Debug\Requests@index');

});

