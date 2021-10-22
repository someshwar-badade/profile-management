app.controller('contactusCtrl',['$scope','$http', function($scope,$http) {
    
    $scope.errors='';
    $scope.loading=false;
    $scope.otpLoading=false;
    $scope.otpSuccessMsg='';
    
    $scope.submitClick = function(){
      $scope.errors='';
      $scope.loading=true;
      $scope.otpSuccessMsg='';
        $http({
            method: 'post',
            url:base_url+'/api/contact-us',
            data:{
                'fullname':$scope.fullname,
                'email':$scope.email,
                'mobile':$scope.mobile,
                'otp':$scope.otp,
                'message':$scope.message,
              }
            
          }).then(function(response){
            
            $scope.loading=false;
            $("body").overhang({
              type: "success",
              message: response.data.success,
              closeConfirm: true,
              duration: 7,
              overlay: true
            });
            $('#frm_contactUs').trigger("reset");
            
          },function(response){
            
           $scope.loading=false;
            $scope.errors = response.data.messages;
            
          });
    }

    $scope.requestOtpClick = function(){
    $scope.errors='';
    $scope.otpLoading=true;
    $scope.otpSuccessMsg='';
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