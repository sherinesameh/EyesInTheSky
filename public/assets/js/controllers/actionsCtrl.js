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
    $scope.form = [];
	  $scope.files = [];
    $scope.priority = {
      prioritySelect: null
    };
    checkSession($http, $stateParams, $state);
    params = {request: 'getLocations'};
    sendRequest($http, params).success(function(data) {
      $scope.locations = data;
    });
    $scope.location = {
      locationsSelect: []
    };
    $scope.addCriminal = function() {
      $scope.form.image = $scope.files[0];
      $scope.form.file = $scope.files[1];
      $http({
    		  method  : 'POST',
    		  url     : 'app/controllers/addCriminal.php',
    		  processData: false,
    		  transformRequest: function (data) {
    		      var formData = new FormData();
              formData.append("fname", $scope.form.fname);
              formData.append("mname", $scope.form.mname);
              formData.append("lname", $scope.form.lname);
              formData.append("image", $scope.form.image);
              formData.append("file", $scope.form.file);
              formData.append("expireDate", $scope.form.expireDate);
              formData.append("priority", $scope.priority.prioritySelect);
              formData.append("locations", $scope.location.locationsSelect);
    		      return formData;
      	  },
      	  data : $scope.form,
      	  headers: {
      	         'Content-Type': undefined
      	  }
         })
         .success(function(data){
              alert(data);
         });
    };
    $scope.getFileDetails = function (e,index) {
       $scope.$apply(function () {
           $scope.files[index] = e.files[0];
           console.log($scope.files[index]);
       });
   };
	  $scope.imagePreview= function(element) {
	    var reader = new FileReader();
	    reader.onload = function(event) {
	      $scope.image_source = event.target.result
	    }
      reader.readAsDataURL(element.files[0]);
		};

  });
  app.controller('deleteCtrl', function($scope, $http, $stateParams, $state) {
    checkSession($http, $stateParams, $state);
    params = {request: 'search'};
    sendRequest($http, params).success(function(data) {
      $scope.criminals = data;
    });
    $scope.removeCriminal = function(criminalID) {
        params = {};
        var criminals = eval( $scope.criminals );
        var index = -1;
        for( var i = 0; i < criminals.length; i++ )
        {
          if( criminals[i].Crim_id === criminalID ) {
            index = i;
            params = {
              request: 'deleteCriminal',
              criminalID: $scope.criminals[i].Crim_id,
              filename: $scope.criminals[i].Dir_path
            };
            sendRequest($http, params)
            .success(function(data) {
              $scope.criminals.splice( index, 1 );
            })
            .error(function(error) {
                console.log("error");
            });
          }
        }
    };
  });
