app.controller('loginCtrl', ['$scope', '$http', '$cookies', function ($scope, $http, $cookies) {
  $scope.email = '';
  $scope.mobile = '';
  $scope.password = '';
  $scope.otp = '';
  $scope.errors = '';
  $scope.otpSuccessMsg = '';
  $scope.otpLoading = false;
  $scope.loading = false;
  $scope.submitClick = function () {
    // $scope.errors='';
    $scope.otpSuccessMsg = '';
    $scope.loading = true;
    $http({
      method: 'post',
      url: base_url + '/api/user/signin',
      // data:{'mobile':$scope.mobile,'password':$scope.password}
      data: { 'email': $scope.email, 'password': $scope.password }


    }).then(function (response) {

      window.location = base_url + '/user-dashboard';


    }, function (response) {

      $scope.errors = response.data.messages;
      $scope.loading = false;
    });
  }

  $scope.requestOtpClick = function () {


    //$scope.errors='';
    $scope.otpSuccessMsg = '';
    $scope.otpLoading = true;
    $http({
      method: 'post',
      url: base_url + '/api/request-otp',
      data: { 'mobile': $scope.mobile }

    }).then(function (response) {
      $scope.otpLoading = false;
      $scope.otpSuccessMsg = response.data.success;
    }, function (response) {

      $scope.errors = response.data.messages;
      $scope.otpLoading = false;
    });
  }

}]);