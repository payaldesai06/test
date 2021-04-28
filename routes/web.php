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

// Authentication Routes...
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('admin', 'Auth\LoginController@showLoginForm');
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login')->name('auth.login');

Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');
    Route::resource('category', 'Admin\CategoryController');
    Route::get('category/restore/{id}', 'Admin\CategoryController@restore')->name('category.restore');
    Route::resource('product', 'Admin\ProductController');
    Route::get('product/restore/{id}', 'Admin\ProductController@restore')->name('product.restore');
    Route::post('product/removemedia', 'Admin\ProductController@removeMedia');
});
