'use strict';

var app = angular.module('myApp.controllers', []);

/**
 * 	Projects controllers
 */
app.controller('ProjectsCtrl', ['$scope', 'Project', function($scope, Project)
{
	$scope.projects = Project.query();
}]);

app.controller('ProjectDetailsCtrl', ['$scope', '$routeParams', 'Project', function($scope, $routeParams, Project)
{
	$scope.project = Project.get({id: $routeParams.id});
}]);

app.controller('ProjectFormCtrl', ['$scope', '$location', '$routeParams', 'Project', 'Category', function($scope, $location, $routeParams, Project, Category)
{
	// Check if ID is passed incase of project editing
	var projectId = $routeParams.id == undefined ? null : $routeParams.id;

	$scope.categories = Category.query();
	$scope.projectFormData = projectId ? Project.get({id: projectId}) : {};
	$scope.project = new Project();

	$scope.submit = function()
	{
		if(projectId)
		{
			console.log('Not implemented yet!');
		}
		else
		{
			$scope.project.$save();
			$location.path('/');
		}
	}
}]);

/**
 * 	User controllers
 */
app.controller('AuthCtrl', ['$http', '$scope', '$rootScope', '$location', 'Auth',
	function($http, $scope, $rootScope, $location, Auth)
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
		$scope.loggedIn = false;
		$location.path('/');
	}

	function checkLoginStatus()
	{
		$scope.loggedIn = false;

		Auth.isLoggedIn().success(function(data)
		{
			$scope.loggedIn = data;
			// Save logged in user information
			Auth.currentUser().success(function(userData)
			{
				$rootScope.currentUser = userData;
			})
			.error(function(userData)
			{
				$rootScope.currentUser = null;
			});
		})
		.error(function(data)
		{
			$scope.loggedIn = data;
		});
	}
}]);