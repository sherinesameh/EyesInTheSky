app.controller('accountsManagerCtrl', function($scope, $http, $stateParams, $state) {
  checkSession($http, $stateParams, $state);
  specs = {request: 'getGovs'};
  sendRequest($http, specs).success(function(data) {
    $scope.govs = data;
    console.log($scope.govs);
  });
  $scope.removeAccount = function(id) {
      var govs = eval( $scope.govs );
      var index = -1;
      for( var i = 0; i < govs.length; i++ )
      {
        if( govs[i].Gov_id === id ) {
          params = {
            request: 'deleteGov',
            id: $scope.govs[i].Gov_id
          };
          sendRequest($http, params)
          .success(function(data) {
            $scope.govs.splice( i, 1 );
          })
          .error(function(error) {
              console.log('error');
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
      console.log('error');
    });
  };
  $scope.addAccount = function() {
    $scope.form = [];
    $scope.files = [];
    $scope.addGov= function() {
      $scope.form.image = $scope.files[0];
      $http({
  	  method  : 'POST',
  	  url     : 'app/controllers/addGov.php',
  	  processData: false,
  	  transformRequest: function (data) {
  	      var formData = new FormData();
  	      formData.append('image', $scope.form.image);
  	      formData.append('fname', $scope.form.fname);
  	      formData.append('lname', $scope.form.lname);
  	      formData.append('username', $scope.form.username);
  	      formData.append('email', $scope.form.email);
  	      formData.append('password', $scope.form.password);
  	      return formData;
  	  },
  	  data : $scope.form,
  	  headers: {
  	         'Content-Type': undefined
  	  }
      }).success(function(data){
          $('#addAccount').modal('close');
          $scope.form.error = '';
          // alert(data);s
     }).error(function(data){
          $scope.form.image = '';
          $scope.form.fname = '';
          $scope.form.lname = '';
          $scope.form.username = '';
          $scope.form.email = '';
          $scope.form.password = '';
          $scope.form.error = 'Account already exists';
     });
    };
    $scope.uploadedFile = function(element) {
    $scope.currentFile = element.files[0];
    var reader = new FileReader();

    reader.onload = function(event) {
      $scope.image_source = event.target.result
      $scope.$apply(function($scope) {
        $scope.files = element.files;
      });
    }
    reader.readAsDataURL(element.files[0]);
    }
  };
});
