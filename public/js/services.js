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
      var self = this;
      $http.post('/api/auth/login', credentials).then(function(response) {
        self.checkSession();
      });
    },

    logout: function() {
      UserStorage.destroy();
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

app.factory('UserStorage', ['$window', function($window)
{
  return {
    set: function(val) {
      $window.sessionStorage.setItem("User", val);
    },
    get: function() {
      return $window.sessionStorage.getItem("User");
    },
    destroy: function() {
      $window.sessionStorage.removeItem("User");
    }
  }
}]);

// MESSAGES
app.factory('Message', ['$http', function($http)
{
  return {
    send: function(projectId, data) {
      return $http.post('/api/messages/' + projectId, data);
    },
    forProject: function(projectId) {
      return $http.get('/api/messages/' + projectId);
    },
    single: function(msgId) {
      return $http.get('/api/messages/single/' + msgId);
    }
  }
}]);

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
});