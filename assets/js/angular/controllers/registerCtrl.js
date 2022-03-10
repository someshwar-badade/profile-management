app.controller('registerCtrl',['$rootScope','$scope','$http', function($rootScope,$scope,$http) {
    $scope.fname ='';
    // $scope.middle_name ='';
    $scope.lname ='';
    $scope.email='';
    $scope.mobile='';
    $scope.password='';
    $scope.confirm_password='';
    $scope.errors={};
    $scope.otpSuccessMsg='';
    $scope.loading=false;
    $scope.submitClick = function(){
     // $scope.errors='';
      
    $scope.loading=true;
      $scope.otpSuccessMsg='';
        $http({
            method: 'post',
            url:base_url+'/api/sign-up',
            data:{
                'fname':$scope.fname,
                // 'middle_name':$scope.middle_name,
                'lname':$scope.lname,
                'email':$scope.email,
                'mobile':$scope.mobile,
                'password':$scope.password,
                'confirm_password':$scope.confirm_password,
                // 'otp':$scope.otp,
                // 'referral_id':$scope.referral_id,
              }
            
          }).then(function(response){
            
          $scope.loading=false;
       
            $('#registeForm').trigger("reset");
            window.location = base_url+'/user-dashboard';
            
          },function(response){
            
            $scope.loading=false;
            $scope.errors = response.data.messages;
            
          });
    }


  }]);