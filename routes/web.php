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
    return redirect('/order');
});

Route::namespace('Order')->group(function () {
    Route::resource('order', 'OrderController');
    Route::get('order/search', 'OrderController@search')->name('order.search');
    Route::get('/chart', 'OrderController@orderChart');
});

Route::get('email/orderTable', 'EmailController@sendOrdersTable');




