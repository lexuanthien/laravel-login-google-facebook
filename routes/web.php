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

// Login
Route::get('/login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@postLogin')->name('post.login');
// Register
Route::get('/register', 'UserController@register')->name('register');
Route::post('/register', 'UserController@postRegister')->name('post.register');

Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', 'UserController@logout')->name('logout');
});

// Login with provider (Google, Facebook)
Route::get('/{provider}', 'UserController@redirectToProvider')->name('login.provider');
Route::get('/{provider}/callback', 'UserController@handleProviderCallback')->name('login.provider.callback');

// Route::prefix('/client')->group(function() {
//     Route::group(['middleware' => 'client'], function() {
//     });
// });