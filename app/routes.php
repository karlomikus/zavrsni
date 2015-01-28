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
    Route::post('auth/login', 'AuthController@login');
    Route::get('auth/logout', 'AuthController@logout');
    Route::get('auth/check', 'AuthController@isLoggedIn');
    Route::get('auth/session', 'AuthController@currentUser');
    Route::get('auth/user/{id}', 'AuthController@user');
    Route::post('auth/register', 'AuthController@register');

    Route::get('profile/projects/{id}', 'ProfileController@userProjects');

    Route::resource('projects', 'ProjectsController');
    Route::resource('categories', 'CategoriesController');
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

    // Users management
    Route::get('users', 'Admin\UsersController@index');
    Route::get('users/edit/{id}', 'Admin\UsersController@edit');
    Route::post('users/edit/{id}', 'Admin\UsersController@update');
    Route::get('users/create', 'Admin\UsersController@create');
    Route::post('users/create', 'Admin\UsersController@store');
    Route::get('users/delete/{id}', 'Admin\UsersController@destroy');
    Route::get('users/changeban/{id}', 'Admin\UsersController@changeBanStatus');

    // Settings
    Route::get('settings', 'Admin\SettingsController@index');
});