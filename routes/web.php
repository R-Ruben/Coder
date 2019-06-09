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

//Profile routes
Route::resource('/profiles', 'ProfileController');

//Post routes
Route::resource('/', 'PostController');
Route::resource('/posts', 'PostController');

//Reputation routes
Route::post('/reputations', 'ReputationController@update');
Route::get('/reputations', 'ReputationController@show');

//Comment routes
Route::resource('/comments', 'CommentController');

//Browse routes
Route::get('/browse-posts', 'BrowseController@postsIndex');
Route::get('/browse-projects', 'BrowseController@projectsIndex');

//Project routes
Route::get('/create', 'ProjectController@create');
Route::put('/create', 'ProjectController@store');
Route::get('/profiles/{profile}/projects', 'ProjectController@index');
Route::get('/projects/{project}', 'ProjectController@show');

//Application routes
Route::resource('/applications', 'ApplicationController');
Route::put('/applications', 'ApplicationController@store');

//Chat routes
Route::get('/chat', 'ChatsController@index');
Route::get('/chat/{id}', 'ChatsController@show');
Route::get('/chat/messages/{id}', 'ChatsController@getMessages');
Route::post('/chat/messages/{id}', 'ChatsController@sendMessage');

//Friend routes
Route::post('/friends', 'FriendController@store');
Route::get('/friends', 'FriendController@index');
Route::post('/friends/update', 'FriendController@update');

//Notification routes
Route::get('/markAsRead', function() {
    auth()->user()->unreadNotifications->markAsRead();
});


Auth::routes();