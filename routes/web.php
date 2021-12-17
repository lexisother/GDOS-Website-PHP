<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@main');

// Register the authentication routes, this is managed by `artisan ui bootstrap --auth`
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@submit');
Route::get('/contact/submissions', 'ContactController@submissions');
Route::get('/contact/submissions/{id}', 'ContactController@submission');

Route::get('/user/{name}', 'UserController@user')->name('user');
Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/profile', 'UserController@update_user');
