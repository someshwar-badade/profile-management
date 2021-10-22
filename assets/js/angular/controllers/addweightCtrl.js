app.controller('addweightCtrl', ['$scope', '$http', function ($scope, $http) {
    
    $scope.date = '';
    $scope.weight = '';
    $scope.height = '';
    $scope.remark = '';

    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.loading = false;
    $scope.otpLoading = false;
    $scope.submitweight = function () {
        $scope.errors = '';
        $scope.otpSuccessMsg = '';
        $scope.loading = true;
        $http({
            method: 'post',
            url: base_url + '/api/weight',
            data: {
             
                'date': $scope.date,
                'weight': $scope.weight,
                'height': $scope.height,
                'remark': $scope.remark
            },

        }).then(function (response) {
            $id=
            
            window.location = base_url + '/animals/edit';

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