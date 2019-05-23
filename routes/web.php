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
Route::get('admin/detailTransaksi', 'transaksiAdminController@create')->name('admin.transaksiDetail');
Route::match(['put', 'patch'], '/admin/transaksi/{id}', 'transaksiAdminController@verif')->name('admin.verifTransaksi');
Route::match(['put', 'patch'], '/admin/delivered/{id}', 'transaksiAdminController@delified')->name('admin.delivered');
Route::get('admin/reviewProduk', 'transaksiAdminController@showReview')->name('admin.review');
Route::get('admin/inRespon/{id}', 'transaksiAdminController@inputResponse')->name('admin.inRespon');
Route::post('admin/storeRespon', 'transaksiAdminController@storeRespon')->name('admin.storeRespon');
Route::get('admin/readNotif', 'transaksiAdminController@markRead')->name('admin.readNotif');


// ---------------------------------------MENGHAPUS DATA-----------------------------------------------
Route::get('admin/hapusProduct/{id}', 'productController@hapus')->name('admin.hapus');

// --------------------------------------ROUTE RESOURCE---------------------------------------------------
route::resource('admin/inKategori','kategoriController');
route::resource('admin/inProduct','productController');
route::resource('/user','userController');
route::resource('/carts', 'cartsController');
route::resource('admin/transaksi', 'transaksiAdminController');

// --------------------------------------------ROUTE STORE----------------------------------------------------
route::post('admin/tambahFoto/{id}', 'productController@fotoStore')->name('admin.tambahFoto');
route::post('admin/tambahKategori/{id}', 'productController@kategoriStore')->name('admin.tambahKategori');

route::get('pelanggan/edit/{user}', 'userController@edituser')->name('pelanggan.edit');
Route::match(['put', 'patch'], '/pelanggan/update/{user}', 'userController@updateUser')->name('pelanggan.update');

Route::get('pelanggan/getProvice', 'RajaOngkir@getProvince');
Route::get('pelanggan/getCity', 'RajaOngkir@getCity');
Route::get('pelanggan/checkshipping', 'RajaOngkir@checkshipping');
Route::get('pelanggan/chekout', 'cartsController@chekout')->name('pelanggan.chekout');
Route::get('pelanggan/reviewOrder', 'cartsController@review')->name('pelanggan.reviewOrder');
Route::post('pelanggan/transaksi', 'cartsController@storeTransaksi')->name('pelanggan.transaksi');
Route::get('pelanggan/verifPay', 'cartsController@verifPembayaran')->name('pelanggan.verif');
Route::match(['put', 'patch'], '/pelanggan/verifUpdate/{user}', 'cartsController@updateVeriv')->name('veriv.update');
Route::get('pelanggan/detailTransaksi', 'cartsController@showTransaksi')->name('pelanggan.showTransaksi');
Route::get('pelanggan/detailTransaksi/{id}', 'cartsController@detailTransaksi')->name('pelanggan.detailTransaksi');
Route::get('pelanggan/verifPay/{id}', 'cartsController@verifPembayaranV2')->name('pelanggan.verifV2');
Route::match(['put', 'patch'], '/pelanggan/cancelUpdate/{id}', 'cartsController@cancelVeriv')->name('veriv.cancel');
Route::match(['put', 'patch'], '/pelanggan/success/{id}', 'cartsController@success')->name('veriv.success');
Route::get('pelanggan/review/{id}', 'cartsController@reviewProduk')->name('pelanggan.review');
Route::get('pelanggan/inReview/{id}', 'cartsController@inputReview')->name('pelanggan.inReview');
Route::post('pelanggan/storeReview', 'cartsController@storeReview')->name('pelanggan.storeReview');




// ----------------ROUTE LOGIN-------------------

Auth::routes();
Route::get('/register/{token}','Auth\RegisterController@activating')->name('activating-account');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pelanggan/logout', 'Auth\LoginController@logoutUser')->name('pelanggan.logout');


Route::group(['prefix' => 'admin'], function()
{
	Route::get('/login', 'Auth_Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth_Admin\LoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin');
	Route::get('/logout', 'Auth_Admin\LoginController@logout')->name('admin.logout');
	Route::get('/form', 'Auth_Admin\RegisterController@showFormAdmin')->name('admin.form');
	Route::post('/register', 'Auth_Admin\RegisterController@create')->name('admin.register');

});

