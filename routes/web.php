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
    return view('welcome');
});

Route::get('/clientlogin', function() {
    $accounts = DB::table('Account')->get();

    return view('clientlogin', compact('accounts'));
});

Auth::routes();

Route::get('/claim', 'Auth\ClaimController@showClaimForm')->name('claim');
Route::post('/claim', 'Auth\ClaimController@claim');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/webauth', 'Auth\WebAuthController@index');
Route::post('/webauth', 'Auth\WebAuthController@login');
