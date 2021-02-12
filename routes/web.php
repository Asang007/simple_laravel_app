<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;

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

Route::get('/', [UserAuth::class, 'homePage']);
Route::post('/signin', [UserAuth::class, 'signIn']);
Route::get('/signout', [UserAuth::class, 'signOut']);

// Website Views
Route::view('login', 'login');
Route::view('dashboard', 'dashboard');