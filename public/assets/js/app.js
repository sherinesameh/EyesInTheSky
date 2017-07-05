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
      views: {
          '': {
            templateUrl: 'public/directives/dashboard.html'
          },
          'navbar@dashboard': {
              templateUrl: 'public/partials/_navbar.html'
          },
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
          },
          'accountsManager@dashboard': {
              templateUrl: 'public/partials/_accountsManager.html',
              controller:  'accountsManagerCtrl'
          }
        }
    });
});
