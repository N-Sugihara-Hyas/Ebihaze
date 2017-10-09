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
    return view('top');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// EventsRoute
Route::get('/events/list', 'EventsController@list')->name('event-list');
Route::get('/events/add', 'EventsController@add')->name('event-add');
Route::get('/events/detail/{event}', 'EventsController@detail');

// TradersRoute
Route::get('/traders/list', 'TradersController@list')->name('trader-list');
Route::get('/traders/add', 'TradersController@add')->name('trader-add');
Route::get('/traders/detail/{trader}', 'TradersController@detail');
