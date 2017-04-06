var app = angular.module('EITS', ['ui.router', 'ngAnimate']);
app.config(function($stateProvider, $urlRouterProvider) {
  $urlRouterProvider.otherwise('/home');
  $stateProvider
    .state('home', {
      url: '/home',
      templateUrl: 'public/directives/home.html',
      controller:  'loginCtrl'
    })
    .state('dashboard', {
      url: '/dashboard',
      controller: 'dashboardCtrl',
      views: {
          '': { templateUrl: 'public/directives/dashboard.html' },
          'log@dashboard': {
              templateUrl: 'public/partials/_log.html',
              controller:  'logCtrl'
          },
          'raspberrypies@dashboard': {
              templateUrl: 'public/partials/_raspberrypies.html',
              controller:  'rpCtrl'
          },
          'user@dashboard': {
              templateUrl: 'public/partials/_profile.html',
              controller:  'userCtrl'
          }
      }
    });
  // $locationProvider.html5Mode(true);
  });
