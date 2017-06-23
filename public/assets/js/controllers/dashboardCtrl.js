  function sendRequest($http, params) {
    return $http.post('app/controllers/requests.php', params)
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

  app.controller('rpCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    specs = {request: 'getRpSpecs'};
    sendRequest($http, specs).success(function(data) {
      $scope.specs = data;
      $scope.getProcesses = function(Mac){
        params = {
          mac : Mac,
          request: 'getRpProcesses'
        }
        $http.post('app/controllers/requests.php',params)
        .success(function(data) {
            $scope.currentMac = params.mac;
            $scope.processes = data;
        })
        .error(function(error) {
            console.log(error);
        });
      };
      $scope.showLocation = function(lat,lng,name){
        $scope.currentLocation = name;
        $scope.currentLat = lat;
        $scope.currentLng = lng;
      }
    });
  });
