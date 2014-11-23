<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Renders main angular view
Route::get('/', function()
{
    return View::make('index');
});

// Public access routes
Route::group(array('prefix'=> 'api'), function()
{
    Route::post('auth/login', 'AuthController@login');
    Route::get('auth/logout', 'AuthController@logout');
    Route::get('auth/check', 'AuthController@isLoggedIn');
    Route::get('auth/user', 'AuthController@loggedInUser');
    Route::get('auth/user/{id}', 'AuthController@user');

    Route::resource('projects', 'ProjectsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('users', 'UsersController');
});

// Administrator access routes
Route::group(array('prefix'=> 'admin'), function()
{
});

// Catch all missing routes and let angular do the routing
App::missing(function($exception)
{
    return View::make('index');
});