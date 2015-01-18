'use strict';

var app = angular.module('myApp.services', []);

// PROJECTS
app.factory('Project', ['$resource', function($resource)
{
  return $resource('/api/projects/:id', {}, {
    update: {
      method: 'PUT'
    }
  });
}]);

// CATEGORIES
app.factory('Category', ['$resource', function($resource)
{
  return $resource('/api/categories/:id');
}]);

// PROFILE
app.factory('Profile', ['$http', '$rootScope', function($http, $rootScope)
{
  return {
    projects: function(id) {
      return $http.get('/api/profile/projects/' + id);
    }
  };
}]);

// USER AND AUTHENTICATION
app.factory('Auth', ['$http', '$rootScope', function($http, $rootScope)
{
  return {
    login: function(credentials) {
      var login = $http.post('/api/auth/login', credentials);
      login.success(function(data) {
        $rootScope.currentUser = data;
      });
    },

    logout: function() {
      return $http.get('/api/auth/logout');
    },

    currentUser: function() {
      var userApi = $http.get('/api/auth/session');
      userApi.success(function(data) {
        if(data != null)
          $rootScope.currentUser = data; 
        else
          $rootScope.currentUser = null;
      });
    }
  };
}]);

// NOTIFICATIONS
app.factory('Notification', function()
{
  return {
    notify: function(text, type) {
      noty({
        text: text, 
        layout: 'topCenter', 
        type: type, 
        animation: { open: 'animated flipInX', close: 'animated flipOutX'}
      });
    }
  };
})