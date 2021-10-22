app.controller('registerCtrl',['$rootScope','$scope','$http', function($rootScope,$scope,$http) {
    $scope.fname ='';
    // $scope.middle_name ='';
    $scope.lname ='';
    $scope.email='';
    $scope.mobile='';
    $scope.password='';
    $scope.confirm_password='';
    $scope.otp='';
    $scope.referral_id='';
    $scope.referral_name='';
    $scope.referral_mobile='';
    $scope.errors={};
    $scope.otpSuccessMsg='';
    $scope.loading=false;
    $scope.otpLoading=false;
    $scope.referalLoading=false;
    $scope.mobileVerified =false;
    $scope.submitClick = function(){
     // $scope.errors='';
      
    $scope.loading=true;
      $scope.otpSuccessMsg='';
        $http({
            method: 'post',
            url:base_url+'/api/user/register',
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
            // $("body").overhang({
            //   type: "success",
            //   message: response.data.success,
            //   closeConfirm: true,
            //   duration: 7,
            //   overlay: true
            // });
            $('#registeForm').trigger("reset");
            window.location = base_url+'/profile';
            
          },function(response){
            
            $scope.loading=false;
            $scope.errors = response.data.messages;
            
          });
    }

    $scope.requestOtpClick = function(){
      $scope.errors={};
    
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
        
        $scope.otpLoading=false;
        $scope.errors = response.data.messages;
        
      });
    }

    $scope.getReferralDetails = function(){

    $scope.errors.referral_id='';
    $scope.referral_name='';
    $scope.referral_mobile='';
      if($scope.referral_id.length < 6){
        return;
      }

      $scope.referalLoading=true;
      $http({
        method: 'post',
        url:base_url+'/api/referral-details',
        data:{'referral_id':$scope.referral_id,'mobile':$scope.mobile,'otp':$scope.otp}
        
      }).then(function(response){
        
    $scope.referalLoading=false;
        var user = response.data.user;
        $scope.referral_name=user.first_name;
        $scope.referral_mobile=user.mobile;
      },function(response){
        
      $scope.referalLoading=false;
      
      $scope.errors = response.data.messages;
        
      });

    }

  }]);