'use strict'

var app = angular.module('myApp.routes', []);

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider)
{
  $routeProvider
    .when('/', {
      templateUrl: 'templates/projects/main.html',
      controller: 'ProjectsCtrl'
    })
    .when('/new', {
      templateUrl: 'templates/projects/form.html',
      controller: 'ProjectFormCtrl'
    })
    .when('/project/:id', {
      templateUrl: 'templates/projects/detail.html',
      controller: 'ProjectDetailsCtrl'
    })
    .when('/project/edit/:id', {
      templateUrl: 'templates/projects/form.html',
      controller: 'ProjectFormCtrl'
    })
    .when('/profile/', {
      templateUrl: 'templates/profile/main.html',
      controller: 'ProfileController'
    })
    .when('/myprojects', {
      templateUrl: 'templates/profile/projects.html',
      controller: 'ProfileController'
    })
    .otherwise({
      redirectTo: '/'
  });

  $locationProvider.html5Mode(true);
}]);