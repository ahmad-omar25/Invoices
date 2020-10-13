<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
// Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth'], function () {

    // Sections Routes
    Route::resource('sections', 'SectionController');

    // Products Routes
    Route::resource('products', 'ProductController');


    /* ---------- Start invoices Routes ---------- */

    Route::resource('invoices', 'Invoice\InvoiceController');

    // invoices Details
    Route::resource('invoice/details', 'Invoice\InvoiceDetails');

    // Get Section of Products
    Route::get('/section/{id}', 'Invoice\InvoiceController@getProducts');

    /* ---------- End invoices Routes ---------- */



    // Pages
    Route::get('/{page}', 'AdminController@index');

});




