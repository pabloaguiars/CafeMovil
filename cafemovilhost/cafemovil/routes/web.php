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

Route::get('/nav-bar', function () {
    return view('navigation-bar');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('sellers', 'SellerController');

Route::resource('students', 'StudentController');

Route::resource('usersown', 'UserOwnController');

Route::get('/#', function () {
    return view('home');
})->name('#');