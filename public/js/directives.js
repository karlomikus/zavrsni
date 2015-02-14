'use strict';

var app = angular.module('myApp.directives', []);

// Project user actions
app.directive('projectUserActions', function()
{
	return {
		restrict: 'E',
		scope: {
			project: '=for'
		},
		templateUrl: 'templates/directives/project-user-actions.html',
	}
});

// User login form
app.directive('loginForm', function()
{
	return {
		restrict: 'E',
		templateUrl: 'templates/directives/login-form.html'
	}
});

// Top navbar user information
app.directive('userBar', function()
{
	return {
		restrict: 'E',
		templateUrl: 'templates/directives/user-bar.html'
	}
});

// Bootstrap datepicker
app.directive('datepicker', function()
{
	return {
		link: function(scope, element, attrs) {
			element.datepicker({
				format: "dd.mm.yyyy",
				language: "hr"
			});
		}
	}
});

// File input fix
app.directive('fileread', function() {
	return {
		scope: {
            fileread: "="
        },
        link: function (scope, element, attrs) {
            element.bind("change", function (changeEvent) {
                var reader = new FileReader();
                reader.onload = function (loadEvent) {
                    scope.$apply(function () {
                    	console.log(loadEvent.target);
                        scope.fileread = loadEvent.target.result;
                    });
                }
                reader.readAsDataURL(changeEvent.target.files[0]);
            });
        }
	}
});