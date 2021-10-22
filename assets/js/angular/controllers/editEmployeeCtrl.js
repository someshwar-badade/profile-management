app.controller('editEmployeeCtrl', ['$scope', '$http', '$cookies', function ($scope, $http, $cookies) {
    $scope.email = '';
    $scope.fname = '';
    $scope.lname = '';
    $scope.mobile = '';
    $scope.password = '';
    $scope.user_role = '';
  
    $scope.errors = '';
    // $scope.otpSuccessMsg = '';
    // $scope.otpLoading = false;
    $scope.loading = false;
    $scope.submitClick = function () {
      // $scope.errors='';
      $scope.otpSuccessMsg = '';
      $scope.loading = true;
      $http({
        method: 'post',
        url: base_url + '/api/employees',
        // data:{'mobile':$scope.mobile,'password':$scope.password}
        data: {
          'fname': $scope.fname,
          'lname': $scope.lname,
          'email': $scope.email,
          'password': $scope.password,
          'user_role': $scope.user_role,
        }
  
  
      }).then(function (response) {
  
        // window.location = base_url + '/profile';
        window.location = base_url + '/employees';
  
      }, function (response) {
  
        $scope.errors = response.data.messages;
        $scope.loading = false;
      });
    }
  
    // $scope.requestOtpClick = function () {
  
  
    //   //$scope.errors='';
    //   $scope.otpSuccessMsg = '';
    //   $scope.otpLoading = true;
    //   $http({
    //     method: 'post',
    //     url: base_url + '/api/request-otp',
    //     data: { 'mobile': $scope.mobile }
  
    //   }).then(function (response) {
    //     $scope.otpLoading = false;
    //     $scope.otpSuccessMsg = response.data.success;
    //   }, function (response) {
  
    //     $scope.errors = response.data.messages;
    //     $scope.otpLoading = false;
    //   });
    // }
  
  }]);