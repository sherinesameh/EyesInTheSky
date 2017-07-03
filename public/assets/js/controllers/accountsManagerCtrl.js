app.controller('accountsManagerCtrl', function($scope, $http, $stateParams, $state) {
  checkSession($http, $stateParams, $state);
  specs = {request: 'getGovs'};
  sendRequest($http, specs).success(function(data) {
    $scope.govs = data;
    console.log($scope.govs);
  });
  $scope.removeAccount = function(id) {
      var accounts = eval( $scope.govs );
      var index = -1;
      for( var i = 0; i < govs.length; i++ )
      {
        if( govs[i].GovID === id ) {
          params = {
            request: 'deleteGov',
            id: $scope.govs[i].GovID
          };
          sendRequest($http, params)
          .success(function(data) {
            $scope.govs.splice( i, 1 );
          })
          .error(function(error) {
              console.log("error");
          });
        }
      }
  };
  $scope.editAccount = function(id,password) {
    $scope.currentID = id;
    $scope.currentPassword = password;
    params = {
      request: 'updateGov',
      id: $scope.currentID,
      password: $scope.currentPassword
    };
    sendRequest($http, params)
    .success(function(data) {
      alert(data);
    })
    .error(function(error) {
        console.log("error");
    });
  }
});
