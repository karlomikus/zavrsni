'use strict'

var app = angular.module('myApp.routes', []);

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider)
{
  $routeProvider
    .when('/', {
      templateUrl: 'templates/projects/main.html',
      controller: 'ProjectsController'
    })
    .when('/new', {
      templateUrl: 'templates/projects/form.html',
      controller: 'ProjectFormController'
    })
    .when('/project/:id', {
      templateUrl: 'templates/projects/detail.html',
      controller: 'ProjectDetailsController'
    })
    .when('/project/edit/:id', {
      templateUrl: 'templates/projects/form.html',
      controller: 'ProjectFormController'
    })
    .when('/profile/', {
      templateUrl: 'templates/profile/main.html',
      controller: 'ProfileController'
    })
    .when('/myprojects', {
      templateUrl: 'templates/profile/projects.html',
      controller: 'MyProjectsController'
    })
    .when('/register', {
      templateUrl: 'templates/profile/register.html',
      controller: 'RegisterController'
    })
    .otherwise({
      redirectTo: '/'
  });

  $locationProvider.html5Mode(true);
}]);