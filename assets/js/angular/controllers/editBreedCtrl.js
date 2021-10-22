app.controller('editBreedCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.animal_type_id = '';
    $scope.type = '';
    $scope.errors = '';
    $scope.loading = false;

    $scope.submitClick = function () {
        $scope.errors = '';

        $http({
          method: 'post',
          url: base_url + '/api/breeds',
          data: { 'animal_type_id': $scope.animal_type_id, 'type': $scope.type  }
          
          // 'password': $scope.password, 'otp': $scope.otp
        }).then(function (response) {

          // window.location = base_url + '/profile';
          window.location = base_url + '/breed/breeds';
    
        }, function (response) {
    
          $scope.errors = response.data.messages;
          $scope.loading = false;
        });
        
        // .then(function (response) {
    
        //   $scope.loading = false;
        //   $("body").overhang({
        //     type: "success",
        //     message: response.data.success,
        //     closeConfirm: true,
        //     duration: 7,
        //     overlay: true
        //   });
        //   $('#addbreed').trigger("reset");
        // }, function (response) {
    
        //   $scope.loading = false;
        //   $scope.errors = response.data.messages;
    
        // });
      }

}]);

