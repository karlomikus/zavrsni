'use strict';

var app = angular.module('myApp.controllers', []);

/**
 * 	Main controllers
 */
app.controller('MainController', ['$scope', 'Auth', 'UserStorage', function($scope, Auth, UserStorage)
{
	$scope.currentUser = Auth.currentUser();

	$scope.login = function(loginData)
	{
		Auth.login(loginData);
		$scope.currentUser = Auth.currentUser();
	}

	$scope.logout = function()
	{
		Auth.logout();
		$scope.currentUser = Auth.currentUser();
	}

	$scope.isLoggedIn = function()
	{
		return $scope.currentUser != null;
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

app.controller('ProjectDetailsController', ['$scope', '$routeParams', '$location', 'Project', function($scope, $routeParams, $location, Project)
{
	$scope.project = {};
	Project.get({id: $routeParams.id}, function(project)
	{
		$scope.project = project.data;
	});

	$scope.delete = function(id)
	{
		Project.delete({id: id});
		$location.path('/');
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
app.controller('ProfileController', ['$scope', 'Profile', function($scope, Profile)
{
	var userId = $scope.$parent.currentUser.id;

	$scope.profile = {};
	Profile.get(userId).success(function(data) {
		$scope.profile = data;
	});
}]);

app.controller('MyProjectsController', ['$scope', '$rootScope', 'Profile', function($scope, $rootScope, Profile)
{
	var userId = $rootScope.currentUser.id;

	$scope.projects = {};
	Profile.projects(userId).success(function(data) {
		$scope.projects = data.data;
	});
}]);