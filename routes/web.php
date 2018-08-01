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
    return view('echo_chat');
});
Route::post('/messages', 'IndexController@messages')->name('messages');
Route::get('/room/{room}', 'IndexController@room')->name('room')->where('room','[0-9]+');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
