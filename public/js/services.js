'use strict';

var app = angular.module('myApp.services', []);

// app.factory('Project', ['$http', function($http)
// {
//   return {
//     getAll: function() {
//       return $http.get('/api/projects');
//     },

//     get: function(id) {
//       return $http.get('/api/projects/' + id);
//     },

//     save: function(formData) {
//       return $http({
//         method: 'POST',
//         url: '/api/projects',
//         headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
//         data: $.param(formData)
//       });
//     },

//     edit: function(id, formData) {
//       return $http({
//         method: 'PUT',
//         url: '/api/projects/' + id,
//         headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
//         data: $.param(formData)
//       });
//     },

//     destroy: function(id) {
//       return $http.delete('/api/projects/' + id);
//     }
//   };
// }]);

app.factory('Project', ['$resource', function($resource)
{
  return $resource('/api/projects/:id', {}, {
    update: {
      method: 'PUT'
    }
  });
}]);

app.factory('Category', ['$resource', function($resource)
{
  return $resource('/api/categories/:id');
}]);

app.factory('Auth', ['$http', function($http)
{
  return {
    login: function(formData) {
      return $http({
        method: 'POST',
        url: '/api/auth/login',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(formData)
      });
    },

    isLoggedIn: function() {
      return $http.get('/api/auth/check');
    },

    logout: function() {
      return $http.get('/api/auth/logout');
    },

    currentUser: function() {
      return $http.get('/api/auth/user');
    },

    getUserById: function(id) {
      return $http.get('/api/auth/user/' + id);
    }
  };
}]);

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