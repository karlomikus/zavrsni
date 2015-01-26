'use strict';

var app = angular.module('myApp.controllers', []);

/**
 * 	User controllers
 */
app.controller('AuthController', ['$http', '$scope', '$rootScope', '$location', 'Auth',
	function($http, $scope, $rootScope, $location, Auth)
{
	Auth.currentUser();

	$scope.login = function(loginData)
	{
		Auth.login(loginData);
		Auth.currentUser();
	}

	$scope.logout = function()
	{
		Auth.logout();
		Auth.currentUser();
		window.location = "/";
	}

	$scope.isLoggedIn = function()
	{
		var hasOwnProperty = Object.prototype.hasOwnProperty;
		var obj = $rootScope.currentUser;

		if (obj == null) return false;

		if (obj.length > 0)    return true;
		if (obj.length === 0)  return false;

		for (var key in obj) {
			if (hasOwnProperty.call(obj, key)) return true;
		}

		return false;
	}
}]);

app.controller('RegisterController', ['$scope', 'Auth', 'Notification', function($scope, Auth, Notification)
{
	$scope.submit = function(credentials) {
		Auth.register(credentials).success(function() {
			Notification.notify('Registracija uspješna!', 'success');
			window.location = "/";
		}).error(function() {
			Notification.notify('Registracija neuspješna!', 'error');
		});
	}
}]);

/**
 * 	Projects controllers
 */
app.controller('ProjectsController', ['$scope', 'Project', function($scope, Project)
{
	var projects = Project.get(function()
	{
		$scope.projects = projects.data;
	});
}]);

app.controller('ProjectDetailsController', ['$scope', '$routeParams', '$window', 'Project', function($scope, $routeParams, $window, Project)
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

app.controller('ProjectFormController', ['$scope', '$location', '$routeParams', 'Project', 'Category', 'Notification', function($scope, $location, $routeParams, Project, Category, Notification)
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
			$location.path('/project/' + projectId);
		}
		else
		{
			$scope.project.$save();
			Notification.notify('Projekt je uspješno spremljen!', 'success');
			$location.path('/myprojects/');
		}
	}
}]);

/**
 *  Profile controllers
 */
app.controller('ProfileController', ['$scope', '$rootScope', 'Profile', function($scope, $rootScope, Profile)
{
	var userId = $rootScope.currentUser.id;

	$scope.projects = {};
	Profile.projects(userId).success(function(data) {
		$scope.projects = data.data;
	});
}]);