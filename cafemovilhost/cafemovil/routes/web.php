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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nav-bar', function () {
    return view('navigation-bar');
});

Route::get('/#', function () {
    return view('home');
})->name('#');

//sellers
Route::get('/sellers/choose-by-email', function () {
    return view('school-administrator.seller-choose-by-email');
})->name('seller-choose-by-email');

//resources
Route::resource('sellers', 'SellerController');

Route::resource('students', 'StudentController');

Route::resource('usersown', 'UserOwnController');