  function sendRequest($http, params) {
    return $http.post('app/controllers/dashboard.php', params)
    .success(function(data) {
        return data;
    })
    .error(function(error) {
        return error;
    });
  }
  app.controller('dashboardCtrl',['$rootScope', '$scope', function($scope, $rootScope) {
    $scope.pageClass = 'page-dashboard';
  }]);

  app.controller('userCtrl', ['$scope', '$http', function($scope, $http) {
    params = {request: 'getUserInfo'};
    sendRequest($http, params).success(function(data) {
      $scope.user = data;
    });
  }]);

  app.controller('logCtrl', ['$scope', '$http', function($scope, $http) {
    params = {request: 'getAdminsLog'};
    sendRequest($http, params).success(function(data) {
      $scope.logs = data;
    });
  }]);

  app.controller('rpCtrl', ['$scope', '$http', function($scope, $http) {
    specs = {request: 'getRpSpecs'};
    processes = {request: 'getRunningProcesses'};
    sendRequest($http, specs).success(function(data) {
      $scope.specs = data;
    });
    sendRequest($http, processes).success(function(data) {
      $scope.processes = data;
    });
  }]);
