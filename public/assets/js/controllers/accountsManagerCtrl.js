app.controller('accountsManagerCtrl', function($scope, $http, $interval, $stateParams, $state) {
  checkSession($http, $stateParams, $state);

  $interval(function() {
    specs = {request: 'getGovs'};
    sendRequest($http, specs).success(function(data) {
      $scope.govs = data;
    });
  }, 5000);

  $scope.removeAccount = function(id) {
    params = {};
    var govs = eval($scope.govs);
    var index = -1;
    for( var i = 0; i < govs.length; i++ )
    {
      if( govs[i].Gov_id === id ) {
        index = i;
        params = {
          request: 'deleteGov',
          id: $scope.govs[i].Gov_id,
          username: $scope.govs[i].Gov_username
        };
        sendRequest($http, params)
        .success(function(data) {
          $scope.govs.splice(index, 1);
        })
        .error(function(error) {
            console.log("error");
        });
      }
    }
  };

  $scope.editAccount = function(id, username) {
    $scope.currentID = id;
    $scope.currentUsername = username;
    $scope.editGov = function()
    {
      params = {
        request: 'updateGov',
        id: $scope.currentID,
        username: $scope.currentUsername,
        password: $scope.form.password
      };
      sendRequest($http, params)
      .success(function(data) {
          alert(data);
      })
      .error(function(error) {
          console.log('error');
      });
    };
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
          // if(data == 'true') {
            specs = {request: 'getGovs'};
            sendRequest($http, specs).success(function(data) {
              $scope.govs = data;
            });
            // $scope.form.error = '';
            $('#addAccount').modal('close');
          }
          // else {
          //   $scope.form.image = null;
          //   $scope.form.fname = '';
          //   $scope.form.lname = '';
          //   $scope.form.username = '';
          //   $scope.form.email = '';
          //   $scope.form.password = '';
          //   $scope.form.error = 'Account already exists';
          // }
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
