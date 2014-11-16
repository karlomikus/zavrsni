'use strict';

var app = angular.module('myApp.controllers', []);

app.controller('projectsController', function($http, $scope, Project)
{
	$scope.projects = {};

	Project.getAll().success(function(data) {
		$scope.projects = data;
	});
});

app.controller('projectDetailsController', function($http, $scope, $routeParams, Project)
{
	$scope.project = {};

	Project.get($routeParams.id).success(function(data) {
		$scope.project = data;
	});
});

app.controller('authController', function($http, $scope, Auth)
{
	checkLoginStatus();

	$scope.loginData = { };

	$scope.login = function()
	{
		Auth.login($scope.loginData).success(function(data)
		{
			checkLoginStatus();
			console.log("Logged in!")
		})
		.error(function(data)
		{
			checkLoginStatus();
			console.log("Unable to sign in");
		});
	}

	$scope.logout = function() {
		Auth.logout();
	}

	function checkLoginStatus()
	{
		$scope.loggedIn = false;

		Auth.isLoggedIn().success(function(data)
		{
			$scope.loggedIn = data;
		})
		.error(function(data)
		{
			$scope.loggedIn = data;
		});
	}
});