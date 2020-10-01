<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Dashboard'], function () {

    // invoices Routes
    Route::resource('invoices', 'InvoiceController');

    // Sections Routes
    Route::resource('sections', 'SectionController');

    Route::get('/{page}', 'AdminController@index');

});




