<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => [
        'web'
    ],
    'as' => 'ticket.'
], function () {
    Route::get('/', 'TicketController@index')->name('index');
});

Route::group([
    'prefix' => 'tickets',
    'middleware' => [
        'web'
    ],
    'as' => 'ticket.'
], function () {
    Route::get('create', 'TicketController@create')->name('create');
    Route::post('/', 'TicketController@store')->name('store');
    Route::get('edit/{id}', 'TicketController@edit')->name('edit');
    Route::put('edit/{id}', 'TicketController@update')->name('update');
    Route::delete('/{id}', 'TicketController@destroy')->name('delete');
    Route::get('finish/{id}', 'TicketController@finish')->name('finish');
});
