'use strict';

var app = angular.module('myApp', ['ngRoute', 'ngResource', 'myApp.routes', 'myApp.directives', 'myApp.services', 'myApp.controllers', 'angular-loading-bar']);

app.run(['$rootScope', '$location', 'Auth', function($rootScope, $location, Auth)
{
	// $rootScope.$watch('currentUser', function(currentUser) {
	// });
}]);