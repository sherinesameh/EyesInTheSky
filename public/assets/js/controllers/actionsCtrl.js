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
         $state.transitionTo('login');
       }
    });
  }
  app.controller('userCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    params = {request: 'getProfile'};
    sendRequest($http, params).success(function(data) {
      $scope.user = data[0];
    });
  });
  app.controller('logCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    params = {request: 'getLog'};
    sendRequest($http, params).success(function(data) {
      $scope.logs = data;
    });
  });
  app.controller('billingCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);

  });
  app.controller('searchCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    params = {request: 'search'};
    sendRequest($http, params).success(function(data) {
      $scope.search = data;
    });
  });
  app.controller('addCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    // params = {
    //   request: 'addCriminal',
    //   Fname: $scope.Fname,
    //   Mname: $scope.Mname,
    //   Lname: $scope.Lname,
    //   path: $scope.path,
    //   image: $scope.image,
    //   expireDate: $scope.expireDate,
    //   priority: $scope.priority
    // };
    // sendRequest($http, params).success(function(data) {
    //   $scope.add = data;
    // });
  });
  app.controller('deleteCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    // params = {
    //   request: 'deleteCriminal',
    //   criminalID: $scope.criminalID
    // };
    // sendRequest($http, params).success(function(data) {
    //   $scope.delete = data;
    // });
  });
