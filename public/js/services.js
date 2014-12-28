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
    projects: function($id) {
      $http.get('/api/profile/projects/' + $id).then(function(data)
      {
        return data;
      })
    }
  };
}]);

// USER AND AUTHENTICATION
app.factory('Auth', ['$http', '$rootScope', 'SessionService', function($http, $rootScope, SessionService)
{
  return {
    login: function(credentials) {
      var login = $http.post('/api/auth/login', credentials);
      login.success(function(data) {
        $rootScope.user = data;
        SessionService.set('auth', true);
        console.log($rootScope.user);
      });
      return login;
    },

    getUser: function() {
      return $http.get('/api/auth/user');
    },

    isLoggedIn: function() {
      return Boolean(SessionService.get('auth'));
    }
  };
}]);

app.factory('SessionService', function(){
  return {
    get: function(key) {
      sessionStorage.getItem(key);
    },

    set: function(key, val) {
      sessionStorage.setItem(key, val);
    },

    unset: function(key) {
      sessionStorage.removeItem(key);
    }
  };
});

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