'use strict';

var app = angular.module('myApp', ['ngRoute', 'ngResource', 'ngSanitize', 'myApp.routes', 'myApp.directives', 'myApp.services', 'myApp.controllers', 'angular-loading-bar', 'infinite-scroll', 'truncate']);

/**
 *  -----------------------------------------------------
 *  Check for user session when changing routes         |
 *  -----------------------------------------------------
 */
app.run(['$rootScope', '$route', 'Auth', function($rootScope, $route, Auth)
{
	$rootScope.$on('$routeChangeStart', function(next, current) {
		Auth.checkSession();
	});
}]);