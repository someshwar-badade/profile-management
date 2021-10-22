app.controller('forgotPasswordCtrl',['$scope','$http', function($scope,$http) {
    $scope.mobile ='';
    $scope.password='';
    $scope.otp='';
    $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.loading=false;
    $scope.otpLoading=false;
    $scope.submitClick = function(){
      $scope.errors='';
      $scope.otpSuccessMsg='';
      $scope.loading=true;
        $http({
            method: 'post',
            url:base_url+'/api/user/forgot-password',
            data:{'mobile':$scope.mobile,'password':$scope.password,'otp':$scope.otp}
            
          }).then(function(response){
            
    $scope.loading=false;
            $("body").overhang({
              type: "success",
              message: response.data.success,
              closeConfirm: true,
              duration: 7,
              overlay: true
            });
            $('#forgotForm').trigger("reset");
          },function(response){
           
    $scope.loading=false;
            $scope.errors = response.data.messages;
           
          });
    }

    $scope.requestOtpClick = function(){
      $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.otpLoading=true;
      $http({
        method: 'post',
        url:base_url+'/api/request-otp',
        data:{'mobile':$scope.mobile}
        
      }).then(function(response){
        
        
    $scope.otpLoading=false;
        $scope.otpSuccessMsg=response.data.success;
      },function(response){
        
    $scope.otpLoading=false;
        $scope.errors = response.data.messages;
       
      });
    }

  }]);