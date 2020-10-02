<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth'], function () {

    // Sections Routes
    Route::resource('sections', 'SectionController');

    // Products Routes
    Route::resource('products', 'ProductController');

    // invoices Routes
    Route::resource('invoices', 'InvoiceController');

    // Pages
    Route::get('/{page}', 'AdminController@index');

});




