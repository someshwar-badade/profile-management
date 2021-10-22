
app.controller('profileCtrl',['$scope','$http','$cookies', function($scope,$http,$cookies) {
$scope.profileDetails ={};
$scope.currentPage = $cookies.get('currentPage') || 'personal';
$scope.changePage = function(pagename){
  $scope.currentPage = pagename;
  $cookies.put('currentPage', pagename);
}
}]);

app.controller('personalDetailsCtrl',['$scope','$http', function($scope,$http) {
   
    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.formDataCopy='';
    $scope.initializeDatepicker = function(){
      $('.past-datepicker').datetimepicker({
        format: 'd-M-Y'  ,
        scrollInput :false,
        timepicker:false,
        maxDate:new Date(),
        onSelectDate: function(){
          $scope.formData.dob = $('.past-datepicker').val()
        }
  });
    }

    

    $scope.editClick = function(){
      $scope.editMode = true;
      $scope.formDataCopy = Object.assign($scope.formDataCopy, $scope.formData); 
      
    }
    $scope.cancelClick = function(){
      $scope.editMode = false;
      $scope.formData = Object.assign($scope.formData, $scope.formDataCopy); 
      $scope.errors='';
      $scope.otpSuccessMsg='';
    }


    $scope.submitClick = function(){
     
      $scope.errors='';
      $scope.otpSuccessMsg='';
      $scope.loading = true;
        $http({
            method: 'post',
            url:base_url+'/api/user/profile/personal-details',
            data:{'first_name':$scope.formData.first_name,
                  'middle_name':$scope.formData.middle_name,
                  'last_name':$scope.formData.last_name,
                  'mobile':$scope.formData.mobile,
                  'email':$scope.formData.email,
                  'dob':$scope.formData.dob,
                  'gender':$scope.formData.gender,
                  'marital_status':$scope.formData.marital_status,
                  'other_phone_no':$scope.formData.other_phone_no,
                }
            
          }).then(function(response){
            $scope.editMode = false;
            $scope.loading = false;
            $("body").overhang({
              type: "success",
              message: response.data.success,
              closeConfirm: true,
              duration: 7,
              overlay: true
            });
            $scope.profileDetails.dob = $scope.formData.dob;
            $scope.user.first_name = $scope.formData.first_name;
            
          },function(response){
           
            $scope.loading = false;
            $scope.errors = response.data.messages;
            
          });
    }

    $scope.requestOtpClick = function(){
      
      
      $scope.errors='';
    $scope.otpSuccessMsg='';
      $http({
        method: 'post',
        url:base_url+'/api/request-otp',
        data:{'mobile':$scope.mobile}
        
      }).then(function(response){
        console.log('ok');
        console.log(response.data);
        $scope.otpSuccessMsg=response.data.success;
      },function(response){
        console.log('error');
        $scope.errors = response.data.messages;
        console.log(response.data);
      });
    }

  }]);

  app.controller('bankdetailsCtrl',['$scope','$http', function($scope,$http) {
   
    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.formDataCopy='';
    $scope.formData = {};
    $scope.formData.docUrl='';

     $scope.editClick = function(){
      $scope.editMode = true;
      $scope.formDataCopy = Object.assign($scope.formDataCopy, $scope.formData); 
      
    }
    $scope.cancelClick = function(){
      $scope.editMode = false;
      $scope.formData = Object.assign($scope.formData, $scope.formDataCopy); 
      $scope.errors='';
      $scope.otpSuccessMsg='';
    }

    $scope.submitClick = function(){
      $scope.errors='';
      $scope.otpSuccessMsg='';
      
    $scope.loading = true;
        
          var form_data = new FormData();
        
         angular.forEach($scope.files, function(file){
              form_data.append('photo_proof', file); //form file
              
         });
         form_data.append('bank_name',$scope.formData.bank_name); //form text data 
         form_data.append('account_name',$scope.formData.account_name); //form text data
         form_data.append('account_no',$scope.formData.account_no); //form text data
         form_data.append('ifsc_code',$scope.formData.ifsc_code); //form text data
         $http.post(base_url+'/api/user/profile/bank-details', form_data,
         {
              //'file_Name':$scope.file_name;
              transformRequest: angular.identity,
              headers: {'Content-Type': undefined,'Process-Data': false}
         }).then(function(response){
            $scope.editMode = false;
            $scope.loading = false;
            
            $("body").overhang({
              type: "success",
              message: response.data.success,
              closeConfirm: true,
              duration: 7,
              overlay: true
            });
            
            $scope.formData.docUrl=response.data.url;
          },function(response){
            
            $scope.errors = response.data.messages;
            $scope.loading = false;
            
          });
    }


  }]);
  app.controller('nomineeCtrl',['$scope','$http', function($scope,$http) {
   
    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.formDataCopy='';

     $scope.editClick = function(){
      $scope.editMode = true;
      $scope.formDataCopy = Object.assign($scope.formDataCopy, $scope.formData); 
      
    }
    $scope.cancelClick = function(){
      $scope.editMode = false;
      $scope.formData = Object.assign($scope.formData, $scope.formDataCopy); 
      $scope.errors='';
      $scope.otpSuccessMsg='';
    }

    $scope.submitClick = function(){
      $scope.errors='';
      $scope.loading = true;
      $scope.otpSuccessMsg='';
        $http({
            method: 'post',
            url:base_url+'/api/user/profile/nominee-details',
            data:{'nominee_name':$scope.formData.nominee_name,
                  'nominee_relation':$scope.formData.nominee_relation,
                  'nominee_mobile':$scope.formData.nominee_mobile,
                  'nominee_address':$scope.formData.nominee_address
                }
            
          }).then(function(response){
            $scope.editMode = false;
            $scope.loading = false;
            
            $("body").overhang({
              type: "success",
              message: response.data.success,
              closeConfirm: true,
              duration: 7,
              overlay: true
            });
            
          },function(response){
            
            $scope.errors = response.data.messages;
            $scope.loading = false;
            
          });
    }


  }]);

  app.controller('addressCtrl',['$scope','$http', function($scope,$http) {
    
    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.formDataCopy='';

    $scope.editClick = function(){
      $scope.editMode = true;
      $scope.formDataCopy = Object.assign($scope.formDataCopy, $scope.formData); 
      
    }
    $scope.cancelClick = function(){
      $scope.editMode = false;
      $scope.formData = Object.assign($scope.formData, $scope.formDataCopy); 
      $scope.errors='';
      $scope.otpSuccessMsg='';
    }

    $scope.submitClick = function(){
      $scope.errors='';
      $scope.loading = true;
      $scope.otpSuccessMsg='';
        $http({
            method: 'post',
            url:base_url+'/api/user/profile/address-details',
            data:{'address1':$scope.formData.address1,
                  'address2':$scope.formData.address2,
                  'city':$scope.formData.city,
                  'state':$scope.formData.state,
                  'pincode':$scope.formData.pincode,
                  'country':$scope.formData.country
                }
            
          }).then(function(response){
            $scope.editMode = false;
            $scope.loading = false;
            $("body").overhang({
              type: "success",
              message: response.data.success,
              closeConfirm: true,
              duration: 7,
              overlay: true
            });
            
            
          },function(response){
            
            $scope.errors = response.data.messages;
            $scope.loading = false;
            
          });
    }

    

  }]);

  app.controller('changePassCtrl',['$scope','$http', function($scope,$http) {
   
    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors='';
    $scope.otpSuccessMsg='';
    
    $scope.editClick = function(){
      $scope.editMode = true;
    }
    $scope.cancelClick = function(){
      $scope.editMode = false;
      $scope.errors='';
      $scope.otpSuccessMsg='';
    }

    $scope.submitClick = function(){
      $scope.errors='';
      $scope.loading = true;
      $scope.otpSuccessMsg='';
        $http({
            method: 'post',
            url:base_url+'/api/user/profile/change-password',
            data:{'current_password':$scope.formData.current_password,
                  'new_password':$scope.formData.new_password,
                  'confirm_password':$scope.formData.confirm_password
                }
            
          }).then(function(response){
            $scope.editMode = false;
            $scope.loading = false;
            $("body").overhang({
              type: "success",
              message: response.data.success,
              closeConfirm: true,
              duration: 7,
              overlay: true
            });
            
          },function(response){
            
            $scope.errors = response.data.messages;
            $scope.loading = false;
            
          });
    }

  }]);


  app.controller("profilePicCtrl", function($scope, $http){
    
    $scope.loading = false;

    $scope.editMode = false;
    $scope.errors='';
    $scope.otpSuccessMsg='';
    
    $scope.editClick = function(){
      $scope.editMode = true;
    }
    $scope.cancelClick = function(){
      $scope.editMode = false;
      $scope.errors='';
      $scope.otpSuccessMsg='';
    }

    $scope.uploadFile = function(){
      
    $scope.loading = true;
         var form_data = new FormData();
        
         angular.forEach($scope.files, function(file){
              form_data.append('profile_photo', file); //form file
               form_data.append('file_Name',$scope.fileName); //form text data
         });
         $http.post(base_url+'/api/user/profile/upload-profile-pic', form_data,
         {
              //'file_Name':$scope.file_name;
              transformRequest: angular.identity,
              headers: {'Content-Type': undefined,'Process-Data': false}
         }).then(function(response){
          $scope.editMode = false;
          $('#profile_photo').attr('src',response.data.photo);
          $("body").overhang({
            type: "success",
            message: response.data.success,
            closeConfirm: true,
            duration: 7,
            overlay: true
          });
          
    $scope.loading = false;
          
        },function(response){
          
          $scope.errors = response.data.messages;
          $scope.loading = false;
          
        });
    }

});


  app.controller("panCtrl", function($scope, $http){
    $scope.errors='';

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.formData ={};
    $scope.formData.docUrl='';
    
    $scope.editClick = function(){
      $scope.editMode = true;
    }
    $scope.cancelClick = function(){
      $scope.editMode = false;
      $scope.errors='';
      $scope.otpSuccessMsg='';
    }

    $scope.uploadPan = function(){
      
    $scope.loading = true;
         var form_data = new FormData();
        
         angular.forEach($scope.files, function(file){
              form_data.append('pan_id_proof', file); //form file
              
         });
         form_data.append('pan_no',$scope.formData.pan_no); //form text data 
         form_data.append('kyc_name','pan'); //form text data
         $http.post(base_url+'/api/user/profile/upload-kyc', form_data,
         {
              //'file_Name':$scope.file_name;
              transformRequest: angular.identity,
              headers: {'Content-Type': undefined,'Process-Data': false}
         }).then(function(response){
          $scope.errors='';
          $scope.editMode = false;
          $scope.loading = false;
          $("body").overhang({
            type: "success",
            message: response.data.success,
            closeConfirm: true,
            duration: 7,
            overlay: true
          });
          $scope.profileDetails.pan_no = $scope.formData.pan_no;
          
    $scope.formData.docUrl=response.data.url;

        },function(response){
          
          $scope.errors = response.data.messages;
          $scope.loading = false;
          
        });
    }
    

});
  app.controller("aadharCtrl", function($scope, $http){
   
    $scope.errors='';
    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors='';
    $scope.otpSuccessMsg='';
    $scope.formData ={};
    $scope.formData.docUrl='';
    $scope.editClick = function(){
      $scope.editMode = true;
    }
    $scope.cancelClick = function(){
      $scope.editMode = false;
      $scope.errors='';
      $scope.otpSuccessMsg='';
    }
   
    $scope.uploadAadhar = function(){
      
    $scope.loading = true;
      var form_data = new FormData();
     
      angular.forEach($scope.files, function(file){
           form_data.append('aadhar_id_proof', file); //form file
      });
      form_data.append('aadhar_no',$scope.formData.aadhar_no); //form text data
      form_data.append('kyc_name','aadhar'); //form text data
      $http.post(base_url+'/api/user/profile/upload-kyc', form_data,
      {
           //'file_Name':$scope.file_name;
           transformRequest: angular.identity,
           headers: {'Content-Type': undefined,'Process-Data': false}
      }).then(function(response){
        $scope.errors='';
        $scope.editMode = false;
        $scope.loading = false;
       $("body").overhang({
         type: "success",
         message: response.data.success,
         closeConfirm: true,
         duration: 7,
         overlay: true
       });
       $scope.profileDetails.aadhar_no = $scope.formData.aadhar_no;
       $scope.formData.docUrl = response.data.url
       
     },function(response){
       
       $scope.errors = response.data.messages;
       $scope.loading = false;
       
     });
 }

});