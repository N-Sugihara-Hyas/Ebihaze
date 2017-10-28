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
Route::get('/events/join', 'EventsController@join')->name('events-join');
Route::get('/events/watch', 'EventsController@watch')->name('events-watch');
Route::get('/events/add', 'EventsController@add')->name('events-add');
Route::post('/events/add', 'EventsController@postAdd')->name('post.events-add');
Route::get('/events/search', 'EventsController@search')->name('events-search');
Route::get('/events/detail/{event}', 'EventsController@detail')->name('events-detail');
Route::get('/events/message/{event}', 'EventsController@message')->name('events-message');
Route::get('/events/review/{event}', 'EventsController@review')->name('events-review');
Route::post('/events/review/{event}', 'EventsController@postReview')->name('post.events-review');

// TradersRoute
Route::get('/traders/list', 'TradersController@list')->name('traders-list');
Route::get('/traders/add', 'TradersController@add')->name('traders-add');
Route::get('/traders/detail/{trader}', 'TradersController@detail')->name('traders-detail');

// ApartmentsRoute
Route::get('/apartments/list', 'ApartmentsController@list')->name('apartments-list');
Route::get('/apartments/rank', 'ApartmentsController@rank')->name('apartments-rank');

// ContactsRoute
Route::get('/contact', 'ContactController@index')->name('contacts-top');

// StaticsRoute
Route::get('/privacy', 'StaticsController@privacy')->name('statics-privacy');
Route::get('/terms', 'StaticsController@terms')->name('statics-terms');
Route::get('/menu', 'StaticsController@menu')->name('statics-menu');

// AccountsRoute
Route::get('/accounts/list', 'AccountsController@list')->name('accounts-list');
Route::get('/accounts/edit/{account}', 'AccountsController@edit')->name('accounts-edit');
Route::post('/accounts/edit', 'AccountsController@postEdit')->name('post.accounts-edit');

// CommentsRoute
Route::post('/comments', 'CommentsController@postMessage')->name('post.comments');

// TwillioRoute
Route::get('/twillio/{tel}', 'TwillioController@create')->name('twillio-create');