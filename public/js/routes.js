'use strict'

var app = angular.module('myApp.routes', []);

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider)
{
	$routeProvider
	.when('/',
	{
		templateUrl: 'templates/projects/main.html',
		controller: 'projectsController'
	})
	.when('/new',
	{
		templateUrl: 'templates/projects/form.html',
		controller: 'projectsController'
	})
	.when('/project/:id',
	{
		templateUrl: 'templates/projects/detail.html',
		controller: 'projectDetailsController'
	})
	.when('/project/edit/:id',
	{
		templateUrl: 'templates/projects/form.html',
		controller: 'projectsController'
	})
	.when('/profile/',
	{
		templateUrl: 'templates/profile/main.html',
		controller: 'projectDetailsController'
	})
	.otherwise(
	{
		redirectTo: '/'
	});

	$locationProvider.html5Mode(true);
}]);