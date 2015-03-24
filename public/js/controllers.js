'use strict';

var app = angular.module('myApp.controllers', []);

/**
 *  -----------------------------------
 * 	Main controller                   |
 * 	-----------------------------------
 */
app.controller('MainController', ['$scope', '$window', 'Auth', 'UserStorage', function($scope, $window, Auth, UserStorage)
{
	updateAuth();

	$scope.login = function(loginData) {
		Auth.login(loginData).then(function(response) {
			updateAuth();
		});
	}

	$scope.logout = function() {
		Auth.logout().then(function(response) {
			updateAuth();
		});
	}

	function updateAuth() {
		Auth.checkSession().then(function(response) {
			$scope.currentUser = Auth.currentUser();
		});
		$scope.currentUser = Auth.currentUser();
	}
}]);

/**
 *  -----------------------------------
 * 	projects controllers              |
 * 	-----------------------------------
 */
app.controller('ProjectsController', ['$scope', 'projects', function($scope, projects, Profile)
{
	$scope.projects = projects.data;
}]);

app.controller('ProjectDetailsController', ['$scope', '$routeParams', '$location', 'Profile', 'project', function($scope, $routeParams, $location, Profile, project)
{
	$scope.project = project.data;

	$scope.authorInfo = {};
	Profile.get(project.data.userId).then(function(response) {
		$scope.authorInfo = response.data.data;
	});
}]);

app.controller('ProjectFormController', ['$scope', '$location', '$routeParams', 'Project', 'Category', 'Notification', function($scope, $location, $routeParams, Project, Category, Notification)
{
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
		$scope.project.contactType = 'website';
	}

	$scope.submit = function()
	{
		if(projectId)
		{
			Project.update({id: projectId}, $scope.project);
			Notification.notify('Projekt je uspješno spremljen!', 'success');
			$location.path('/project/' + projectId);
			// Refresh project scope
			Project.get({id: projectId}, function(project)
			{
				$scope.project = project.data;
			});
		}
		else
		{
			$scope.project.$save();
			Notification.notify('Projekt je uspješno spremljen!', 'success');
			window.location = "/myprojects";
		}
	}
}]);

app.controller('MessageFormController', ['$scope', 'Notification', 'Message', function($scope, Notification, Message)
{
	$scope.send = function(data) {
		var projectId = $scope.$parent.project.id;

		Message.send(projectId, data).success(function() {
			Notification.notify('Poruka je uspješno poslana', 'success');
			$scope.messageData = {};
			$scope.messageForm.$setPristine();
		});
	};
}]);

app.controller('ApplicationsController', ['$scope', 'Message', function($scope, Message)
{
	var projectId = $scope.$parent.project.id;

	Message.forProject(projectId).success(function(response) {
		$scope.messages = response.data;
	});

	$scope.message = {};
	$scope.applicationInfo = function(msgID) {
		Message.single(msgID).success(function(response) {
			$scope.message = response.data;
		});
	};
}]);

/**
 *  -----------------------------------
 * 	Users controllers                 |
 * 	-----------------------------------
 */
app.controller('ProfileController', ['$scope', 'Profile', function($scope, Profile)
{
	var userId = $scope.$parent.currentUser.id;

	$scope.profileData = {};

	Profile.get(userId).success(function(response) {
		$scope.profileData = response.data;
	});

	$scope.uploadFile = function(file) {
		$scope.profileData.pic = file;
	}

	$scope.updateProfile = function(data) {
		Profile.update(data);
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

app.controller('MyProjectsController', ['$scope', '$rootScope', 'Profile', function($scope, $rootScope, Profile)
{
	var userId = $scope.$parent.currentUser.id;

	$scope.projects = {};
	Profile.projects(userId).success(function(data) {
		$scope.projects = data.data;
	});
}]);