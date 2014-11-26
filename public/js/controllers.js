'use strict';

var app = angular.module('myApp.controllers', []);

/**
 * 	Projects controllers
 */
app.controller('ProjectsCtrl', ['$scope', 'Project', function($scope, Project)
{
	$scope.projects = Project.query();
}]);

app.controller('ProjectDetailsCtrl', ['$scope', '$routeParams', '$location', 'Project', function($scope, $routeParams, $location, Project)
{
	$scope.project = Project.get({id: $routeParams.id});

	$scope.delete = function(id)
	{
		Project.delete({id: id});
		Project.query();
		$location.path('/');
	}
}]);

app.controller('ProjectFormCtrl', ['$scope', '$location', '$routeParams', 'Project', 'Category', 'Notification', function($scope, $location, $routeParams, Project, Category, Notification)
{
	// Check if ID is passed incase of project editing
	var projectId = $routeParams.id == undefined ? null : $routeParams.id;

	$scope.categories = Category.query();
	$scope.project = projectId ? Project.get({id: projectId}) : new Project();

	$scope.submit = function()
	{
		if(projectId)
		{
			Project.update({id: projectId}, $scope.project);
			Notification.notify('Projekt je uspješno spremljen!', 'success');
			Project.query();
			$location.path('/project/' + projectId);
		}
		else
		{
			$scope.project.$save();
			Notification.notify('Projekt je uspješno spremljen!', 'success');
			Project.query();
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