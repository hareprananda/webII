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
    return redirect("/house");
});
Route::get('/modal/{data}/{tanggal}', "LoadController@modal");

Route::post("/booking/ruangan","UserController@booking")->name('bookingRuangan');
Route::get('/house',"UserController@house")->name("house");
Route::get('/ruangan/{data}', "UserController@ruangan");
Route::get('/setting',"UserController@profile");
Route::get('/try',"UserController@try");
Route::put('/ubah',"UserController@ubah");
Route::put('/ubahPas',"UserController@ubahPas");
Route::get('/ruangan/{data}/search', ['as' => 'searchKelas', 'uses' => 'UserController@search']);

Route::get('/user',"AdminController@table");
Route::get('/booklist',"AdminController@bookToday")->name('booking');
Route::get('/booklist/search',"AdminController@search")->name("searchBook");
Route::any('/user/cari',"AdminController@cari");
Route::put('/unverify/{id}',"AdminController@unverify");
Route::put('/approve/{id}',"AdminController@approve");
Route::put('/prosesbook/{id}',"AdminController@ubahStatus")->name('prosesBook');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
