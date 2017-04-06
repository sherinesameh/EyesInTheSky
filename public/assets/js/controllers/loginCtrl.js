
app.controller('loginCtrl', function($scope, $http, $stateParams, $state)
{
  $scope.pageClass = 'page-home';
  $scope.submit = function()
  {
    params = {
      email: $scope.username,
      password: $scope.password
    };
    return $http.post('app/controllers/login.php',params)
    .success(function(data) {
      if(data == 'true')
      {
        $scope.error = '';
        $state.transitionTo('dashboard');
      } else {
        $scope.error = "Incorrect username or password!";
      }
    })
    .error(function(error) {
        return error;
    });
    // }
  }
});
