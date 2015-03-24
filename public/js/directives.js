'use strict';

var app = angular.module('myApp.directives', []);

// Project user actions
app.directive('projectUserActions', ['$location', 'Project', function($location, Project)
{
	return {
		restrict: 'E',
		scope: {
			project: '=for'
		},
		templateUrl: 'templates/directives/project-user-actions.html',
        link: function(scope, elem, attrs) {
            scope.delete = function(id) {
                Project.delete({id: id});
                $location.path('/');
            }
        }
	}
}]);

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


angular.module('truncate', [])
.filter('characters', function () {
    return function (input, chars, breakOnWord) {
        if (isNaN(chars)) return input;
        if (chars <= 0) return '';
        if (input && input.length > chars) {
            input = input.substring(0, chars);

            if (!breakOnWord) {
                var lastspace = input.lastIndexOf(' ');
                //get last space
                if (lastspace !== -1) {
                    input = input.substr(0, lastspace);
                }
            }else{
                while(input.charAt(input.length-1) === ' '){
                    input = input.substr(0, input.length -1);
                }
            }
            return input + '…';
        }
        return input;
    };
})
.filter('splitcharacters', function() {
    return function (input, chars) {
        if (isNaN(chars)) return input;
        if (chars <= 0) return '';
        if (input && input.length > chars) {
            var prefix = input.substring(0, chars/2);
            var postfix = input.substring(input.length-chars/2, input.length);
            return prefix + '...' + postfix;
        }
        return input;
    };
})
.filter('words', function () {
    return function (input, words) {
        if (isNaN(words)) return input;
        if (words <= 0) return '';
        if (input) {
            var inputWords = input.split(/\s+/);
            if (inputWords.length > words) {
                input = inputWords.slice(0, words).join(' ') + '…';
            }
        }
        return input;
    };
});