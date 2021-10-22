app.controller('loginCtrl',['$scope','$http','$cookies', function($scope,$http,$cookies) {
    $scope.email ='';
    $scope.password='';
    $scope.otp='';
    $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.otpLoading=false;
    $scope.loading=false;
    $scope.submitClick = function(){
      // $scope.errors='';
      $scope.otpSuccessMsg='';
      $scope.loading=true;
        $http({
            method: 'post',
            url:base_url+'/api/user/signin',
            data:{'email':$scope.email,'password':$scope.password,'otp':$scope.otp}
            
          }).then(function(response){
            
           if(response.data.user.user_type=='admin'){
            window.location = base_url+'/dashboard';
           }else{
            window.location = base_url+'/profile';
           }
            
            
          },function(response){
            
            $scope.errors = response.data.messages;
            $scope.loading=false;
          });
    }

    $scope.requestOtpClick = function(){
      
      
    //$scope.errors='';
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
       
        $scope.errors = response.data.messages;
        $scope.otpLoading=false;
      });
    }

  }]);