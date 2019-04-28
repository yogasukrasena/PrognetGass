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


// ----------------------------------MENAMPILKAN DATA------------------------------------------------
Route::get('admin/showKategori','kategoriController@tampil')->name('admin.showKategori');
Route::get('admin/showAdmin','Auth_Admin\RegisterController@showDataAdmin')->name('admin.showAdmin');
Route::get('admin/showProduct','productController@showProduct')->name('admin.showProduct');
Route::get('admin/showProduct/{user}', 'productController@showKategoridetail')->name('admin.KPdetail');
Route::get('admin/showFoto/{user}', 'productController@showFotodetail')->name('admin.FotoD');

// ---------------------------------------MENGHAPUS DATA-----------------------------------------------
Route::get('admin/hapusProduct/{id}', 'productController@hapus')->name('admin.hapus');

// --------------------------------------ROUTE RESOURCE---------------------------------------------------
route::resource('admin/inKategori','kategoriController');
route::resource('admin/inProduct','productController');

route::post('admin/tambahFoto/{id}', 'productController@fotoStore')->name('admin.tambahFoto');
route::post('admin/tambahKategori/{id}', 'productController@kategoriStore')->name('admin.tambahKategori');



// ----------------ROUTE LOGIN-------------------

Auth::routes();
Route::get('/register/{token}','Auth\RegisterController@activating')->name('activating-account');

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

