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
         alert(data);
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
      $scope.RunningProcesses = false;
      $scope.getProcesses = function(Mac){
        $scope.RunningProcesses = !$scope.RunningProcesses;
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
      $scope.KillProcess = function(Cont_id,currentMac) {
          params = {};
          var processes = eval($scope.processes);
          var index = -1;
          for( var i = 0; i < processes.length; i++ )
          {
            if( processes[i].Cont_id === Cont_id ) {
              index = i;
              params = {
                request: 'KillProcess',
                mac: currentMac,
                contID: Cont_id
              };
              sendRequest($http, params)
              .success(function(data) {
                $scope.processes.splice( index, 1 );
              })
              .error(function(error) {
                  console.log("error");
              });
            }
          }
      };
      $scope.showDetails = function(Mac, LocationLat, LocationLng, LocationName, PublicIP, Username, Password, HasCamera, Generation, os, Ram, storage){
        $scope.currentMac = Mac;
        $scope.LocationLat = LocationLat;
        $scope.LocationLng = LocationLng;
        $scope.LocationName = LocationName;
        $scope.PublicIP = PublicIP;
        $scope.Username = Username;
        $scope.Password = Password;
        $scope.HasCamera = HasCamera;
        $scope.Generation = Generation;
        $scope.os = os;
        $scope.Ram = Ram;
        $scope.Storage = storage;
      }
    });
  });
