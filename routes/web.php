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
	/**
	 * Admin Routes
	 */
Route::group(['prefix' => 'admin'], function()
{
	Route::get('/', 'BackEnd\DashboardController@index')->name('admin.index');
	Route::resource('roles', 'BackEnd\RolesController', ['names' => 'admin.roles']);
	Route::resource('users', 'BackEnd\UsersController', ['names' => 'admin.users']);
	Route::resource('admins', 'BackEnd\AdminsController', ['names' => 'admin.admins']);


	//login route
	Route::get('/login', 'BackEnd\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login/submit', 'BackEnd\Auth\LoginController@login')->name('admin.login.submit');

	///logout route
	Route::post('/logout/submit', 'BackEnd\Auth\LoginController@logout')->name('admin.logout.submit');



	//forget password route
	Route::get('/password/reset', 'BackEnd\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/reset/submit', 'BackEnd\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
