'use strict';

var app = angular.module('myApp.controllers', []);

/**
 * 	Projects controllers
 */
app.controller('projectsController', ['$http','$scope', '$location', '$routeParams', 'Project', 'Category',
	function($http, $scope, $location, $routeParams, Project, Category)
{
	$scope.projects = {};
	$scope.categories = {};
	$scope.projectFormData = {};

	var projectId = $routeParams.id == undefined ? null : $routeParams.id;

	Project.getAll().success(function(data)
	{
		$scope.projects = data;
	});

	Category.getAll().success(function(data)
	{
		$scope.categories = data;
	});

	// Fill project form on edit
	if(projectId)
	{
		Project.get(projectId).success(function(data)
		{
			$scope.projectFormData = data;
		});
	}

	$scope.save = function()
	{
		Project.save($scope.projectFormData).success(function(data)
		{
			console.log('Added new project!');
			$location.path("/");
		});
	}

	$scope.edit = function(id)
	{
		Project.edit(id, $scope.projectFormData).success(function(data)
		{
			console.log('Edited project!');
			$location.path("/project/" + id);
		});
	}
}]);

app.controller('projectDetailsController', ['$http', '$scope', '$routeParams', 'Project', 'Category',
	function($http, $scope, $routeParams, Project, Category)
{
	$scope.project = {};

	Project.get($routeParams.id).success(function(data)
	{
		$scope.project = data;
	});

	$scope.getProjectCategory = function(id)
	{
		var catName = Category.get(id).success(function(catData)
		{
			return catData.name;
		});

		return catName;
	}
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