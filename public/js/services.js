'use strict';

var app = angular.module('myApp.services', []);

/**
 *  ------------------
 *  Projects         |
 *  ------------------
 */
app.factory('Project', ['$resource', function($resource)
{
  return $resource('/api/projects/:id', {}, {
    update: {
      method: 'PUT'
    }
  });
}]);

/**
 *  ------------------
 *  Categories       |
 *  ------------------
 */
app.factory('Category', ['$resource', function($resource)
{
  return $resource('/api/categories/:id');
}]);

/**
 *  ------------------
 *  Profile          |
 *  ------------------
 */
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

/**
 *  ------------------
 *  Auth and users   |
 *  ------------------
 */
app.factory('Auth', ['$http', 'UserStorage', function($http, UserStorage)
{
  return {
    // Login the user
    login: function(credentials) {
      return $http.post('/api/auth/login', credentials);
    },

    // Logout the user
    logout: function() {
      return $http.get('/api/auth/logout');
    },

    // Check if user has server side session and
    // save him to storage
    checkSession: function() {
      var q = $http.get('/api/auth/session').then(function(response) {
        UserStorage.set(JSON.stringify(response.data.data));
        console.log("Found user session!");
      }, function(response) {
        UserStorage.destroy();
        console.log(response.data.error);
      });

      return q;
    },

    // Get the currently logged in user from storage
    currentUser: function() {
      var jsonString = UserStorage.get();
      if(jsonString != null)
        return JSON.parse(jsonString);
      return null;
    },

    // Register the user
    register: function(credentials) {
      return $http.post('/api/auth/register', credentials);
    }
  };
}]);

/**
 *  ----------------------------------
 *  Storage engine for users         |
 *  ----------------------------------
 */
app.factory('UserStorage', ['$window', function($window)
{
  return {
    set: function(val) {
      $window.localStorage.setItem("User", val);
    },
    get: function() {
      return $window.localStorage.getItem("User");
    },
    destroy: function() {
      $window.localStorage.removeItem("User");
    }
  }
}]);

/**
 *  ------------------
 *  Messages         |
 *  ------------------
 */
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

/**
 *  ------------------
 *  Notifications    |
 *  ------------------
 */
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