'use strict'

var app = angular.module('myApp.routes', []);

/**
 *  ------------------
 *  Routing          |
 *  ------------------
 */
app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider)
{
  $routeProvider
    .when('/', {
      templateUrl: 'templates/projects/main.html',
      controller: 'ProjectsController',
      resolve: {
        projects: function(Project) {
          return Project.get().$promise;
        }
      }
    })
    .when('/new', {
      templateUrl: 'templates/projects/form.html',
      controller: 'ProjectFormController'
    })
    .when('/project/:id', {
      templateUrl: 'templates/projects/detail.html',
      controller: 'ProjectDetailsController',
      resolve: {
        project: function($route, Project) {
          return Project.get({id: $route.current.params.id}).$promise;
        }
      }
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