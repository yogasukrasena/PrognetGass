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

Route::get('admin/showKategori','kategoriController@tampil')->name('admin.showKategori');
// Route::get('admin/createKategori','kategoriController@store')->name('admin.createKategori');
route::resource('admin/inKategori','kategoriController');
route::resource('admin/inProduct','productController');




// ----------------ROUTE LOGIN-------------------

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'admin'], function()
{
	Route::get('/login', 'Auth_Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth_Admin\LoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin');
	Route::get('/logout', 'Auth_Admin\LoginController@logout')->name('admin.logout');
	Route::get('/form', 'Auth_Admin\RegisterController@showFormAdmin')->name('admin.form');
	Route::post('/register', 'Auth_Admin\RegisterController@create')->name('admin.register');

});

