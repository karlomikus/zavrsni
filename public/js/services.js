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
    },
    get: function(id) {
      return $http.get('/api/auth/user/' + id);
    },
    update: function(data) {
      return $http.post('/api/profile/update', data);
    }
  };
}]);

// USER AND AUTHENTICATION
app.factory('Auth', ['$http', 'UserStorage', function($http, UserStorage)
{
  return {
    login: function(credentials) {
      var _this = this;
      $http.post('/api/auth/login', credentials).then(function(response) {
        _this.checkSession();
      });
    },

    logout: function() {
      return $http.get('/api/auth/logout');
    },

    checkSession: function() {
      $http.get('/api/auth/session').then(function(response) {
        if(Object.getOwnPropertyNames(response.data).length !== 0)
          UserStorage.set(JSON.stringify(response.data.data));
        else
          UserStorage.destroy();
      });
    },

    currentUser: function() {
      var jsonString = UserStorage.get();
      if(jsonString != null)
        return JSON.parse(jsonString);
      return null;
    },

    register: function(credentials) {
      return $http.post('/api/auth/register', credentials);
    }
  };
}]);

app.factory('UserStorage', function()
{
  return {
    set: function(val) {
      localStorage.setItem("User", val);
    },
    get: function() {
      return localStorage.getItem("User");
    },
    destroy: function() {
      localStorage.removeItem("User");
    }
  }
});

// NOTIFICATIONS
app.factory('Notification', function()
{
  return {
    notify: function(text, type) {
      noty({
        timeout: 3000,
        text: text,
        layout: 'topCenter',
        type: type,
        animation: { open: 'animated flipInX', close: 'animated flipOutX'}
      });
    }
  };
})