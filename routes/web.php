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
    return redirect()->route('events-list');
})->middleware('auth');

Auth::routes(
	Route::get('/home', 'HomeController@index')->name('home')
);



// UsersRoute
Route::get('/users/create', 'UsersController@create')->name('users-create');
Route::post('/users/create', 'UsersController@postCreate')->name('post.users-create');
Route::get('/users/certificate/{id}', 'UsersController@certificate')->name('users-certificate');
Route::post('/users/certificate', 'UsersController@postCertificate')->name('post.users-certificate');
Route::get('/users/add/{id}', 'UsersController@add')->name('users-add');
Route::post('/users/add', 'UsersController@postAdd')->name('post.users-add');
Route::get('/users/add-complete', 'UsersController@addComplete')->name('users-add-complete');
Route::get('/users/list', 'UsersController@list')->name('users-list')->middleware('auth');
Route::get('/users/invite/form', 'UsersController@inviteForm')->name('users-invite-form')->middleware('auth');
Route::post('/users/invite/form', 'UsersController@postInviteForm')->name('post.users-invite-form')->middleware('auth');
Route::get('/users/invite/complete', 'UsersController@inviteComplete')->name('users-invite-complete')->middleware('auth');

// EventsRoute
Route::get('/events/list', 'EventsController@list')->name('events-list')->middleware('auth');
Route::get('/events/join', 'EventsController@join')->name('events-join')->middleware('auth');
Route::get('/events/watch', 'EventsController@watch')->name('events-watch')->middleware('auth');
Route::get('/events/add', 'EventsController@add')->name('events-add')->middleware('auth');
Route::post('/events/add', 'EventsController@postAdd')->name('post.events-add')->middleware('auth');
Route::get('/events/edit/{event}', 'EventsController@edit')->name('events-edit')->middleware('auth');
Route::post('/events/edit', 'EventsController@postEdit')->name('post.events-edit')->middleware('auth');
Route::get('/events/search', 'EventsController@search')->name('events-search')->middleware('auth');
Route::get('/events/detail/{event}', 'EventsController@detail')->name('events-detail')->middleware('auth');
Route::get('/events/message/{event}', 'EventsController@message')->name('events-message')->middleware('auth');
Route::get('/events/review/{event}', 'EventsController@review')->name('events-review')->middleware('auth');
Route::post('/events/review/{event}', 'EventsController@postReview')->name('post.events-review')->middleware('auth');

// TradersRoute
Route::get('/traders/list', 'TradersController@list')->name('traders-list')->middleware('auth');
Route::get('/traders/add', 'TradersController@add')->name('traders-add')->middleware('auth');
Route::post('/traders/add', 'TradersController@postAdd')->name('post.traders-add')->middleware('auth');
Route::get('/traders/detail/{trader}', 'TradersController@detail')->name('traders-detail')->middleware('auth');
Route::get('/traders/edit/{trader}', 'TradersController@edit')->name('traders-edit')->middleware('auth');
Route::post('/traders/edit', 'TradersController@postEdit')->name('post.traders-edit')->middleware('auth');

// ApartmentsRoute
Route::get('/apartments/list', 'ApartmentsController@list')->name('apartments-list')->middleware('auth');
Route::get('/apartments/add', 'ApartmentsController@add')->name('apartments-add')->middleware('auth');
Route::post('/apartments/add', 'ApartmentsController@postAdd')->name('post.apartments-add')->middleware('auth');
Route::get('/apartments/switch', 'ApartmentsController@switch')->name('apartments-switch')->middleware('auth');
Route::post('/apartments/switch', 'ApartmentsController@postSwitch')->name('post.apartments-switch')->middleware('auth');
Route::get('/apartments/detail/{apartment}', 'ApartmentsController@detail')->name('apartments-detail')->middleware('auth');
Route::get('/apartments/edit/{apartment}', 'ApartmentsController@edit')->name('apartments-edit')->middleware('auth');
Route::post('/apartments/edit', 'ApartmentsController@postEdit')->name('post.apartments-edit')->middleware('auth');
Route::get('/apartments/rank', 'ApartmentsController@rank')->name('apartments-rank')->middleware('auth');

// ContactsRoute
Route::get('/contact', 'ContactController@index')->name('contacts-top')->middleware('auth');

// StaticsRoute
Route::get('/privacy', 'StaticsController@privacy')->name('statics-privacy')->middleware('auth');
Route::get('/terms', 'StaticsController@terms')->name('statics-terms')->middleware('auth');
Route::get('/menu', 'StaticsController@menu')->name('statics-menu')->middleware('auth');

// AccountsRoute
Route::get('/accounts/list', 'AccountsController@list')->name('accounts-list')->middleware('auth');
Route::get('/accounts/add', 'AccountsController@add')->name('accounts-add')->middleware('auth');
Route::post('/accounts/add', 'AccountsController@postAdd')->name('post.accounts-add')->middleware('auth');
Route::get('/accounts/edit/{account}', 'AccountsController@edit')->name('accounts-edit')->middleware('auth');
Route::post('/accounts/edit', 'AccountsController@postEdit')->name('post.accounts-edit')->middleware('auth');

// CommentsRoute
Route::post('/comments', 'CommentsController@postMessage')->name('post.comments')->middleware('auth');

// FlyersRoute
Route::get('/flyers/list', 'FlyersController@list')->name('flyers-list')->middleware('auth');
Route::post('/flyers/list', 'FlyersController@postList')->name('post.flyers-list')->middleware('auth');
Route::get('/flyers/saved', 'FlyersController@saved')->name('flyers-saved')->middleware('auth');

// TwillioRoute
Route::get('/twillio/{tel}', 'TwillioController@create')->name('twillio-create')->middleware('auth');

// EventUserRoute
Route::post('/eventuser', 'EventsController@eventuser')->name('events-eventuser')->middleware('auth');
