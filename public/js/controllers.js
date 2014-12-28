'use strict';

var app = angular.module('myApp.controllers', []);

/**
 * 	User controllers
 */
app.controller('AuthCtrl', ['$http', '$scope', '$rootScope', '$location', 'Auth',
	function($http, $scope, $rootScope, $location, Auth)
{
	$scope.login = function(loginData)
	{
		Auth.login(loginData);
	}
}]);

/**
 * 	Projects controllers
 */
app.controller('ProjectsCtrl', ['$scope', 'Project', function($scope, Project)
{
	var projects = Project.get(function()
	{
		$scope.projects = projects.data;
	});
}]);

app.controller('ProjectDetailsCtrl', ['$scope', '$routeParams', '$window', 'Project', function($scope, $routeParams, $window, Project)
{
	Project.get({id: $routeParams.id}, function(project)
	{
		$scope.project = project.data;
	});

	$scope.delete = function(id)
	{
		Project.delete({id: id});
		$window.location.href = '/';
	}
}]);

app.controller('ProjectFormCtrl', ['$scope', '$window', '$routeParams', 'Project', 'Category', 'Notification', function($scope, $window, $routeParams, Project, Category, Notification)
{
	// Check if ID is passed incase of project editing
	var projectId = $routeParams.id == undefined ? null : $routeParams.id;
	$scope.categories = Category.query();

	if(projectId)
	{
		Project.get({id: projectId}, function(project)
		{
			$scope.project = project.data;
		});
	}
	else
	{
		$scope.project = new Project();
	}

	$scope.submit = function()
	{
		if(projectId)
		{
			Project.update({id: projectId}, $scope.project);
			Notification.notify('Projekt je uspješno spremljen!', 'success');
		}
		else
		{
			$scope.project.$save();
			Notification.notify('Projekt je uspješno spremljen!', 'success');
		}

		$window.location.href = '/';
	}
}]);

/**
 *  Profile controllers
 */
app.controller('ProfileController', ['$scope', '$rootScope', 'Profile', function($scope, $rootScope, Profile)
{
	var userId = $rootScope.user.id;

	console.log(userId);
}]);