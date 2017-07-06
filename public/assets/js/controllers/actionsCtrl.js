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
  app.controller('logCtrl', function($scope, $interval, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    $interval(function () {
      params = {request: 'getLog'};
      sendRequest($http, params).success(function(data) {
        $scope.logs = data;
      });
    }, 1000);
    $scope.showDetails = function(Process_name){
      params = {request: 'getProcessSpecs', processName: Process_name};
      sendRequest($http, params).success(function(data) {
        $scope.data = data[0];
        console.log($scope.data);
      });
    }
  });
  app.controller('jobCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    $scope.form = [];
	  $scope.files = [];
    $scope.addTask = function() {
      $scope.form.dockerfile = $scope.files[0];
      $http({
    		  method  : 'POST',
    		  url     : 'app/controllers/upload.php',
    		  processData: false,
    		  transformRequest: function (data) {
    		      var formData = new FormData();
              formData.append("dockerfile", $scope.form.dockerfile);
              formData.append("processName", $scope.form.processName);
    		      return formData;
      	  },
      	  data : $scope.form,
      	  headers: {
      	         'Content-Type': undefined
      	  }
         })
         .success(function(data){
              $scope.form={};
              location.reload(true);
         });
       };
    $scope.getFileDetails = function (e) {
        $scope.$apply(function () {
            $scope.files.push(e.files[0]);
            console.log($scope.files[0]);
        });
    };
  });
