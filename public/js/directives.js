'use strict';

var app = angular.module('myApp.directives', []);

// app.directive('user', ['Auth', function(Auth)
// {
// 	return {
// 		restrict: 'E',
// 		template: function(elem, attr) {
// 			var user = {};
// 			Auth.getUserById(attr.id).success(function(data)
// 			{
// 				user = data;
// 			}).error(function(data)
// 			{
// 				user = {};
// 			});

// 			console.log(user);

// 			return '<h1>User name ' + user.firstName + '</h1>'
// 		}
// 	}
// }]);