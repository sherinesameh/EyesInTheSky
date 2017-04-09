var app = angular.module('EITS', ['ui.router']);
app.config(function($stateProvider, $urlRouterProvider) {
  $urlRouterProvider.otherwise('/login');
  $stateProvider
    .state('login', {
      url: '/login',
      templateUrl: 'public/directives/login.html',
      controller:  'loginCtrl'
    })
    .state('home', {
      url: '/home',
      views: {
          '': {
            templateUrl: 'public/directives/home.html'
          },
          'navbar@home': {
              templateUrl: 'public/partials/_navbar.html'
          },
          'user@home': {
            templateUrl: 'public/partials/_profile.html',
            controller:  'userCtrl'
          },
          'log@home': {
              templateUrl: 'public/partials/_log.html',
              controller:  'logCtrl'
          },
          'billing@home': {
              templateUrl: 'public/partials/_billing.html',
              controller:  'billingCtrl'
          },
          'add@home': {
              templateUrl: 'public/partials/_add.html',
              controller:  'addCtrl'
          },
          'delete@home': {
              templateUrl: 'public/partials/_delete.html',
              controller:  'deleteCtrl'
          },
          'search@home': {
              templateUrl: 'public/partials/_search.html',
              controller:  'searchCtrl'
          }
        }
    });
});
