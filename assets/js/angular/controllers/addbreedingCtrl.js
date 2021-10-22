app.controller('addbreedingCtrl', ['$scope', '$http', function ($scope, $http) {
    
    $scope.breeding_date = '';
    $scope.birth_type = '';
    $scope.first_kid_tag_id = '';
    $scope.second_kid_tag_id = '';
    $scope.third_kid_tag_id = '';
    $scope.fourth_kid_tag_id = '';
    
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.loading = false;
    $scope.otpLoading = false;
    $scope.submitbreeding = function () {
        $scope.errors = '';
        $scope.otpSuccessMsg = '';
        $scope.loading = true;
        $http({
            method: 'post',
            url: base_url + '/api/breeding',
            data: {
                'breeding_date':$scope.breeding_date,
                'breeding_date':$scope.birth_type,
                'first_kid_tag_id':$scope.first_kid_tag_id,
                'second_kid_tag_id':$scope.second_kid_tag_id,
                'third_kid_tag_id':$scope.third_kid_tag_id,
                'fourth_kid_tag_id':$scope.fourth_kid_tag_id
            },


           
        }).then(function (response) {
            $id=
           
            window.location = base_url + '/animals/edit';

        }, function (response) {

            $scope.errors = response.data.messages;
            $scope.loading = false;
        });
        
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