'use strict';

var app = angular.module('myApp', ['ngRoute', 'ngResource', 'myApp.routes', 'myApp.directives', 'myApp.services', 'myApp.controllers', 'angular-loading-bar']);

app.run(['$rootScope', '$route', 'Auth', function($rootScope, $route, Auth)
{
	// $rootScope.$on('$routeChangeStart', function(next, current) {
	// 	Auth.currentUser();
	// });
}]);