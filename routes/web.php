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

// UsersRoute
Route::get('/users/list', 'UsersController@list')->name('users-list');
Route::get('/users/invite/form', 'UsersController@inviteForm')->name('users-invite-form');
Route::get('/users/invite/complete', 'UsersController@inviteComplete')->name('users-invite-complete');

// EventsRoute
Route::get('/events/list', 'EventsController@list')->name('events-list');
Route::get('/events/add', 'EventsController@add')->name('events-add');
Route::get('/events/detail/{event}', 'EventsController@detail');

// TradersRoute
Route::get('/traders/list', 'TradersController@list')->name('traders-list');
Route::get('/traders/add', 'TradersController@add')->name('traders-add');
Route::get('/traders/detail/{trader}', 'TradersController@detail');
