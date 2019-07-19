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
Route::get('/modal/{data}', "LoadController@modal");


Route::get('/house',"UserController@house")->name("house");
Route::get('/ruangan/{data}', "UserController@ruangan");
Route::get('/setting',"UserController@profile");
Route::get('/try',"UserController@try");
Route::put('/ubah',"UserController@ubah");
Route::put('/ubahPas',"UserController@ubahPas");


Route::get('/user',"AdminController@table");
Route::any('/user/cari',"AdminController@cari");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
