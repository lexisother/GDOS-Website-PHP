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

Route::get('/', function () {
    // Get a list of all users and pass it to the view
    $users = \App\Models\User::all();
    return view('main', ['users' => $users]);
});

Route::get('/user/{name}', function($name) {
    // Find a user in the database with the given name
    $user = \App\Models\User::where('name', $name)->first();
    return view('user', ['user' => $user]);
});

// Register the authentication routes, this is managed by `artisan ui bootstrap --auth`
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit']);

Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::post('/profile', [\App\Http\Controllers\UserController::class, 'update_user']);
