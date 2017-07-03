  app.controller('rpCtrl', function($scope, $interval, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    $interval(function() {
      sendRequest($http, specs).success(function(data) {
        $scope.specs = data;
        specs = {request: 'getRpSpecs'};
      });
    }, 1000);
    $scope.RunningProcesses = false;
    $scope.getProcesses = function(Mac) {
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
    $scope.showDetails = function(Mac, LocationLat, LocationLng, LocationName, PublicIP, Username, Password, HasCamera, Generation, os, Ram, storage) {
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
    };
    $scope.restartPi = function(currentMac)
    {
      params = {
        request: 'restartPi',
        mac: currentMac
      };
      sendRequest($http, params)
      .success(function(data) {
        alert(data);
      })
    };
    $scope.shutdownPi = function(currentMac)
    {
      params = {
        request: 'shutdownPi',
        mac: currentMac
      };
      sendRequest($http, params)
      .success(function(data) {
        alert(data);
      })
    };

  });
