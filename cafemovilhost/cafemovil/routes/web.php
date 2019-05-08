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
    return view('seller.seller-choose-by-email');
})->name('seller-choose-by-email');

//products
Route::get('/products/choose-by-id-at-store', function () {
    return view('product.product-choose-by-id-at-store');
})->name('product-choose-by-id-at-store');

//confirm-order
Route::post('/products/confirm-order', 'OrderController@confirm' )->name('confirm-order');

//Report
Route::get('/report', "ReportController@index");

//resources
Route::resource('sellers', 'SellerController');

Route::resource('students', 'StudentController');

Route::resource('usersown', 'UserOwnController');

Route::resource('products', 'ProductController');

Route::resource('orders', 'OrderController');