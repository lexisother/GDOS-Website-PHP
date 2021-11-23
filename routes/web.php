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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
