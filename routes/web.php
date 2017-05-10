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

//Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/get-cities/{idState}', 'CityController@getCities');
Route::get('/get-neighborhoods/{idCity}', 'NeighborhoodController@getNeighborhoods');

// Authentication Routes...
Route::get('login', 'HomeController@index')->name('entrar');
Route::get('entrar', 'HomeController@index')->name('entrar');
Route::post('login', 'Auth\LoginController@login');
Route::post('entrar', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('sair');
Route::post('sair', 'Auth\LoginController@logout')->name('sair');
// Registration Routes...
Route::get('cadastro', 'UserController@create')->name('cadastro');
Route::post('cadastro', 'UserController@store');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/account', 'UserController@account')->name('account');
    Route::post('/account', 'UserController@update')->name('account');
    Route::post('/user-change-account', 'UserController@changeAccount')->name('user-change-account');
    Route::post('/user-change-photo/{id}', 'UserController@changePhoto')->name('user-change-photo');
    Route::resource('users', 'UserController');
    Route::resource('demands', 'DemandController');
    Route::resource('contacts', 'ContactController');
});

Route::get('/welcome', function () {
    return view('welcome');
});