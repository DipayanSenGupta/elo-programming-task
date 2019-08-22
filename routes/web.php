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

Route::middleware(['auth'])->group(function () {

	Route::get('/', function(){
		return redirect()->route('items.index');
    });
    Route::get('items', 'ItemController@index')->name('items.index'); 
    Route::post('items', 'ItemController@store')->name('items.store'); 
    Route::get('items/{item}/edit', 'ItemController@edit')->name('items.edit');
    Route::put('items/{item}', 'ItemController@update')->name('items.update');
    Route::delete('items/{item}', 'ItemController@destroy')->name('items.destroy');
    Route::get('items/action', 'ItemController@action')->name('items.action');

});