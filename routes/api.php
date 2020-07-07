<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
   
Route::get('/', function () {
    return view('welcome');
});

// Route::middleware('auth:api')->post('user', 'Auth\LoginController@authenticate');  //查看




// Auth::routes();

// Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
 // Route::post('login', 'Auth\LoginController@authenticate');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Route::post('authenticate', 'Auth\LoginController@authenticate')->name('authenticate');


// // Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware('auth:api')->group(function() {
    Route::get('user/{userId}/detail', 'Auth\LoginController@show');
    // Route::get('user/{userId}/task', 'TaskController@index');
});



Route::get('/home', 'HomeController@index')->name('home');