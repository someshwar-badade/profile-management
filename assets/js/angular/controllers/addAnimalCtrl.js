app.controller('addAnimalCtrl', ['$scope', '$http', function ($scope, $http) {
    // $scope.email = '';
    $scope.tag_id = '';
    $scope.animal_type_id = '';
    $scope.breed_type_id = '';
    $scope.mother_tag_id = '';
    $scope.current_weight = '';
    $scope.gender = '';
    $scope.by_purchase_birth = '';
    $scope.date_of_birth = '';
    $scope.purchase_price = '';
    $scope.purchase_date = '';
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.loading = false;
    $scope.otpLoading = false;
    $scope.submitClick = function () {
        $scope.errors = '';
        $scope.otpSuccessMsg = '';
        $scope.loading = true;
        $http({
            method: 'post',
            url: base_url + '/api/animals',
            data: {
                // 'email': $scope.email,
                'tag_id': $scope.tag_id,
                'animal_type_id': $scope.animal_type_id,
                'breed_type_id': $scope.breed_type_id,
                'mother_tag_id': $scope.mother_tag_id,
                'current_weight': $scope.current_weight,
                'gender': $scope.gender,
                'by_purchase_birth': $scope.by_purchase_birth,
                'date_of_birth': $scope.date_of_birth,
                'purchase_price':$scope.purchase_price,
                'purchase_date':$scope.purchase_date
            },         


            // 'password': $scope.password, 'otp': $scope.otp
        }).then(function (response) {

            // window.location = base_url + '/profile';
            window.location = base_url + '/animals';
      
          }, function (response) {
      
            $scope.errors = response.data.messages;
            $scope.loading = false;
          });
        // .then(function (response) {

        //     $scope.loading = false;
        //     $("body").overhang({
        //         type: "success",
        //         message: response.data.success,
        //         closeConfirm: true,
        //         duration: 7,
        //         overlay: true
        //     });
        //     $('#forgotForm').trigger("reset");
        // }, function (response) {

        //     $scope.loading = false;
        //     $scope.errors = response.data.messages;

        // });
    }

    $scope.requestOtpClick = function () {
        $scope.errors = '';
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

            $scope.otpLoading = false;
            $scope.errors = response.data.messages;

        });
    }

}]);