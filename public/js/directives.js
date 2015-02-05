'use strict';

var app = angular.module('myApp.directives', []);

app.directive('projectUserActions', function()
{
	return {
		restrict: 'E',
		scope: {
			project: '=for'
		},
		templateUrl: 'templates/directives/project-user-actions.html',
	}
});

app.directive('loginForm', function()
{
	return {
		restrict: 'E',
		templateUrl: 'templates/directives/login-form.html'
	}
});

app.directive('userBar', function()
{
	return {
		restrict: 'E',
		templateUrl: 'templates/directives/user-bar.html'
	}
});