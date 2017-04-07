  function sendRequest($http, params) {
    return $http.post('app/controllers/dashboard.php', params)
    .success(function(data) {
        return data;
    })
    .error(function(error) {
        return error;
    });
  }
  function checkSession($http, $stateParams, $state)
  {
    params = {request: 'checkSession'};
    sendRequest($http, params).success(function(data) {
       if(data !='"success"') {
         $state.transitionTo('home');
       }
    });
  }

  app.controller('userCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    params = {request: 'getUserInfo'};
    sendRequest($http, params).success(function(data) {
      $scope.user = data[0];
    });
  });

  app.controller('logCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    params = {request: 'getAdminsLog'};
    sendRequest($http, params).success(function(data) {
      $scope.logs = data;
    });
  });

  app.controller('rpCtrl', function($scope, $http, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    specs = {request: 'getRpSpecs'};
    processes = {request: 'getRunningProcesses'};
    sendRequest($http, specs).success(function(data) {
      $scope.specs = data;
    });
    sendRequest($http, processes).success(function(data) {
      $scope.processes = data;
    });
  });
