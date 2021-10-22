app.controller('addinsuranceCtrl', ['$scope', '$http', function ($scope, $http) {
    
    $scope.insurance_company = '';
    $scope.plan_name = '';
    $scope.policy_number = '';
    $scope.agent_name = '';
    
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.loading = false;
    $scope.otpLoading = false;
    $scope.submitinsurance = function () {
        $scope.errors = '';
        $scope.otpSuccessMsg = '';
        $scope.loading = true;
        $http({
            method: 'post',
            url: base_url + '/api/insurance',
            data: {
                'insurance_company':$scope.insurance_company,
                'plan_name':$scope.plan_name,
                'policy_number':$scope.policy_number,
                'agent_name':$scope.agent_name
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