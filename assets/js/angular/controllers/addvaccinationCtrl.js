app.controller('addvaccinationCtrl', ['$scope', '$http', function ($scope, $http) {
    // $scope.email = '';
    // $scope.animal_id = '';
    $scope.date = '';
    $scope.vaccine_name = '';
    $scope.remark = '';

    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.loading = false;
    $scope.otpLoading = false;
    $scope.submitvaccine = function () {
        $scope.errors = '';
        $scope.otpSuccessMsg = '';
        $scope.loading = true;
        $http({
            method: 'post',
            url: base_url + '/api/vaccination',
            data: {
                // 'email': $scope.email,
                // 'animal_id': $scope.animal_id,
                'date': $scope.date,
                'vaccine_name': $scope.vaccine_name,
                'remark': $scope.remark
            },


            // 'password': $scope.password, 'otp': $scope.otp
        }).then(function (response) {
            $id=
            // window.location = base_url + '/profile';
            window.location = base_url + '/animals/(:num)/edit';

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