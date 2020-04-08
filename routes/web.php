<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'UserController@index')->name('users.index');

Route::get('/users/{user}', 'UserController@show')->name('users.show');

Route::get('/avatars', 'AvatarController@index')->name('avatars.index');

Route::resource('photos', 'PhotoController');