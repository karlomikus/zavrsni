'use strict';

var app = angular.module('myApp.controllers', []);

/**
 * 	Projects controllers
 */
app.controller('projectsController', ['$http','$scope', '$location', 'Project', 'Category',
	function($http, $scope, $location, Project, Category)
{
	$scope.projects = {};
	$scope.categories = {};
	$scope.projectFormData = {};

	Project.getAll().success(function(data)
	{
		$scope.projects = data;
	});

	Category.getAll().success(function(data)
	{
		$scope.categories = data;
	});

	$scope.save = function()
	{
		Project.save($scope.projectFormData).success(function(data)
		{
			console.log('Added new project!');
			$location.path("/");
		});
	}
}]);

app.controller('projectDetailsController', ['$http', '$scope', '$routeParams', 'Project',
	function($http, $scope, $routeParams, Project)
{
	$scope.project = {};

	Project.get($routeParams.id).success(function(data)
	{
		$scope.project = data;
	});
}]);

/**
 * 	User controllers
 */
app.controller('authController', ['$http', '$scope', 'Auth',
	function($http, $scope, Auth)
{
	checkLoginStatus();
	$scope.loginData = {};

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

	$scope.logout = function()
	{
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
}]);