'use strict';

var app = angular.module('myApp', ['ngRoute', 'ngResource', 'myApp.routes', 'myApp.directives', 'myApp.services', 'myApp.controllers', 'angular-loading-bar', 'infinite-scroll', 'truncate']);

app.run(['$rootScope', '$route', 'Auth', function($rootScope, $route, Auth)
{
    Auth.checkSession();
	$rootScope.$on('$routeChangeStart', function(next, current) {
		Auth.checkSession();
	});
}]);