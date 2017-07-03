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
