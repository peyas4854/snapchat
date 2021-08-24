<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//github login
//Route::get('/auth/redirect/{provider}', 'SocialController@redirect');

Route::get('/auth/redirect/{provider}', [SocialLoginController::class, 'redirect']);

//redirect url in provider api . [set in service.app ]

Route::get('/callback/snapchat', [SocialLoginController::class, 'callback']);

//Route::get('/callback/{provider}', 'SocialController@callback');
