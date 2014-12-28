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

// Catch all missing routes and let angular do the routing
App::missing(function($exception)
{
    return View::make('index');
});

// Public api access routes
Route::group(['prefix'=> 'api'], function()
{
    Route::post('auth/login', 'AuthController@login');
    Route::get('auth/logout', 'AuthController@logout');
    Route::get('auth/check', 'AuthController@isLoggedIn');
    Route::get('auth/user', 'AuthController@currentUser');
    Route::get('auth/user/{id}', 'AuthController@user');

    Route::get('profile/projects/{id}', 'ProfileController@userProjects');

    Route::resource('projects', 'ProjectsController');
    Route::resource('categories', 'CategoriesController');
});

// Administrator access routes
Route::group(['prefix'=> 'admin', 'before' => 'auth'], function()
{
    Route::get('/', 'Admin\DashboardController@index');

    Route::get('projects', 'Admin\ProjectsController@index');

    Route::get('users', 'Admin\UsersController@index');
    Route::get('users/edit/{id}', 'Admin\UsersController@edit');
    Route::get('users/create', 'Admin\UsersController@create');
});