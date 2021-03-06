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
Route::group(['prefix' => 'api'], function()
{
    // Authentication and users
    Route::post('auth/login', 'AuthController@login');
    Route::get('auth/logout', 'AuthController@logout');
    Route::get('auth/session', 'AuthController@currentUser');
    Route::get('auth/user/{id}', 'AuthController@user');
    Route::post('auth/register', 'AuthController@register');

    // Profiles
    Route::get('profile/projects/{id}', 'ProfileController@userProjects');
    Route::post('profile/update', 'ProfileController@update');

    // Projects
    Route::resource('projects', 'ProjectsController');
    Route::resource('categories', 'CategoriesController');

    // Messages
    Route::get('messages/{id}', 'MessagesController@index');
    Route::get('messages/single/{id}', 'MessagesController@show');
    Route::post('messages/{projectId}', 'MessagesController@store');
});

// Administrator access routes
Route::group(['prefix' => 'admin', 'before' => 'auth|auth.admin'], function()
{
    // Dashboard
    Route::get('/', 'Admin\DashboardController@index');
    Route::get('charts/projects/{year}', 'Admin\DashboardController@getProjectsChartData');

    // Projects management
    Route::get('projects', 'Admin\ProjectsController@index');
    Route::get('projects/delete/{id}', 'Admin\ProjectsController@destroy');

    // Categories management
    Route::get('categories', 'Admin\CategoriesController@index');
    Route::get('categories/create', 'Admin\CategoriesController@create');
    Route::post('categories/create', 'Admin\CategoriesController@store');
    Route::get('categories/edit/{id}', 'Admin\CategoriesController@edit');
    Route::post('categories/edit/{id}', 'Admin\CategoriesController@update');
    Route::get('categories/delete/{id}', 'Admin\CategoriesController@destroy');

    // Users management
    Route::get('users', 'Admin\UsersController@index');
    Route::get('users/edit/{id}', 'Admin\UsersController@edit');
    Route::post('users/edit/{id}', 'Admin\UsersController@update');
    Route::get('users/create', 'Admin\UsersController@create');
    Route::post('users/create', 'Admin\UsersController@store');
    Route::get('users/delete/{id}', 'Admin\UsersController@destroy');
    Route::get('users/changeban/{id}', 'Admin\UsersController@changeBanStatus');
});