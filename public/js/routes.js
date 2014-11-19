'use strict'

var app = angular.module('myApp.routes', []);

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider)
{
	$routeProvider
	.when('/',{
		templateUrl: 'templates/projects/main.html',
		controller: 'projectsController'
	})
	.when('/new',{
		templateUrl: 'templates/projects/new.html',
		controller: 'projectsController'
	})
	.when('/project/:id',{
		templateUrl: 'templates/projects/detail.html',
		controller: 'projectDetailsController'
	}).otherwise({
		redirectTo: '/'
	});

	$locationProvider.html5Mode(true);
}]);