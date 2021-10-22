app.controller('headerCtrl',['$rootScope','$scope','$http', function($rootScope,$scope,$http) {
    $scope.nav_categories = [];

    $scope.getNavCategoryUrl = function(categorySlug){
        return base_url+'/products/'+categorySlug;
        } 

    $http({
        method: 'get',
        url: base_url + '/api/categories',
        data: {}

    }).then(function(response) {

        $scope.nav_categories = response.data;
       
    }, function(response) {

        console.log(response);


    });
}]);