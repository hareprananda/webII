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



Route::get('/house',"AdminController@house")->name("house");
Route::get('/modal/{data}', "LoadController@modal");
Route::get('/ruangan/{data}', "AdminController@ruangan");
Route::get('/setting',"AdminController@profile");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
