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
    return redirect("/login");
});

Route::get('/modal/{data}/{tanggal}', "LoadController@modal");

Route::post("/booking/ruangan","UserController@booking")->name('bookingRuangan');
Route::get('/house',"UserController@house")->name("house")->middleware('auth');
Route::get('/ruangan/{data}', "UserController@ruangan");
Route::get('/setting',"UserController@profile");
Route::get('/try',"UserController@try");
Route::put('/ubah',"UserController@ubah");
Route::post('/ajaxpoto',"UserController@ajaxpoto");
Route::put('/ubahPas',"UserController@ubahPas");
Route::get('/cekakun', "UserController@cekakun");
Route::get('/ruangan/{data}/search', 'UserController@search')->name('searchKelas');
Route::delete("/hapus/booking","UserController@hapusBooking");
Route::get('/user',"AdminController@table");
Route::get('/booklist',"AdminController@bookToday")->name('booking');
Route::get('/booklist/search',"AdminController@search")->name("searchBook");
Route::put('/unverify/{id}',"AdminController@unverify");
Route::put('/approve/{id}',"AdminController@approve");
Route::put('/prosesbook/{id}',"AdminController@ubahStatus")->name('prosesBook');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cobaapi/{id}', 'HomeController@api');
Route::get('/postapi', 'HomeController@postApi');
Route::get('/reg', 'HomeController@register');
Route::get('/log', 'HomeController@login');
Route::get("/formapi",function(){
    return view("formapi");
});
Route::post("/formapi","HomeController@login");





Route::post('/custom/login', 'CustomController\AuthController@postLogin'); 