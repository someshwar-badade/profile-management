app.controller('loginCtrl', ['$scope', '$http', '$cookies', function ($scope, $http, $cookies) {
  $scope.email = '';
  $scope.mobile = '';
  $scope.password = '';
  $scope.otp = '';
  $scope.loginChoice = "password";
  $scope.errors = '';
  $scope.otpSuccessMsg = '';
  $scope.otpLoading = false;
  $scope.loading = false;
  $scope.sendVerificationCodeLoading = false;
  $scope.sendVerificationCodeSuccess = '';
  $scope.submitClick = function () {
    // $scope.errors='';
    $scope.otpSuccessMsg = '';
    $scope.loading = true;
    $http({
      method: 'post',
      url: base_url + '/api/user/signin',
      // data:{'mobile':$scope.mobile,'password':$scope.password}
      data: { 'email': $scope.email, 'password': $scope.password, 'loginChoice':$scope.loginChoice,'verificationCodeText':$scope.verificationCodeText }


    }).then(function (response) {

      window.location = base_url + '/user-dashboard';


    }, function (response) {

      $scope.errors = response.data.messages;
      if (response.data.status == 403) {
        toastr.error(response.data.messages.errorMessage);
    } else {
        toastr.error("Something went wrong !!");
    }
      $scope.loading = false;
    });
  }

  $scope.sendVerificationCode = function(){
    $scope.sendVerificationCodeLoading = true;
    $scope.otpSuccessMsg = '';
    $scope.errors = '';
    $http({
      method: 'post',
      url: base_url + '/api/send-verification-code',
      // data:{'mobile':$scope.mobile,'password':$scope.password}
      data: { 'email': $scope.email }

    }).then(function (response) {
      $scope.sendVerificationCodeLoading = false;
      $scope.sendVerificationCodeSuccess= response.data.messages.success;
     console.log(response);


    }, function (response) {

      $scope.errors = response.data.messages;
      if (response.data.status == 403) {
        toastr.error(response.data.messages.errorMessage);
    } else {
        
    }
      $scope.sendVerificationCodeLoading = false;
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