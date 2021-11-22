var app = angular.module('app', ['ngCookies','datatables','ui.bootstrap','angularjs-dropdown-multiselect','ngTagsInput','yaru22.angular-timeago']);
app.run(function($rootScope,$http) {
    $rootScope.user={};
    $rootScope.user.first_name = '';
    $rootScope.user.middle_name = '';
    $rootScope.user.last_name = '';
    $rootScope.cart={};
    $rootScope.cart.itemCount=0;
    $rootScope.cart.total=0;
    $rootScope.cart.is_membership_product_purchased=false;
    $rootScope.cart.itemList={};

    $rootScope.cart.add = function(product_id){
     
        $http({
          method: 'post',
          url: base_url + '/api/cart/'+product_id+'/add',
        }).then(function(response) {
          console.log(response);
          $rootScope.cart.getItemList();
          toastr["success"](response.data.success);
          // $("body").overhang({
          //   type: "success",
          //   message: response.data.success,
          //   closeConfirm: true,
          //   duration: 4,
          //   overlay: false
          // });
        }, function(response) {


        });
    }

    $rootScope.cart.keyUp = function(index){
      if($rootScope.cart.itemList[index].kit_count>$rootScope.cart.itemList[index].qty){
        $rootScope.cart.itemList[index].kit_count = $rootScope.cart.itemList[index].qty;
      }
    }
    $rootScope.cart.update = function(index){
      if($rootScope.cart.itemList[index].kit_count>$rootScope.cart.itemList[index].qty){
        $rootScope.cart.itemList[index].kit_count = $rootScope.cart.itemList[index].qty;
      }

      $http({
        method: 'post',
        url: base_url + '/api/cart/update',
        data: $rootScope.cart.itemList[index]
      }).then(function(response) {
        // console.log(response);
        $rootScope.cart.getItemList();
        toastr["success"](response.data.success);
        // $("body").overhang({
        //   type: "success",
        //   message: response.data.success,
        //   closeConfirm: true,
        //   duration: 4,
        //   overlay: false
        // });
      }, function(response) {


      });
  }
  $rootScope.cart.changeMembershipProduct = function(index){
    $rootScope.cart.itemList[index].is_membership_product = 1;
    $rootScope.cart.update(index);
  }

  $rootScope.cart.remove = function(index){
    
    console.log(index);
    console.log($rootScope.cart.itemList);
    console.log($rootScope.cart.itemList[index]);
    $http({
      method: 'post',
      url: base_url + '/api/cart/remove',
      data: $rootScope.cart.itemList[index]
    }).then(function(response) {
      // console.log(response);
      $rootScope.cart.getItemList();
      toastr["success"](response.data.success);
      // $("body").overhang({
      //   type: "success",
      //   message: response.data.success,
      //   closeConfirm: true,
      //   duration: 4,
      //   overlay: false
      // });
    }, function(response) {


    });
}

    $rootScope.cart.getItemList = function(){
        //getcart list
      $http({
        method: 'get',
        url: base_url + '/api/cart',
      }).then(function(response) {
        $rootScope.cart.itemList = response.data.itemList;
        $rootScope.cart.itemCount = response.data.itemCount;
        $rootScope.cart.total = response.data.total;
        $rootScope.cart.is_membership_product_purchased = response.data.is_membership_product_purchased;
      }, function(response) {


      });
    }

    $rootScope.cart.getItemList();
  });

  
  app.directive("fileInput", function($parse){
    return{
         link: function($scope, element, attrs){
              element.on("change", function(event){
                   var files = event.target.files;
                  // console.log(files);
                   $parse(attrs.fileInput).assign($scope, element[0].files);
                   $scope.$apply();
                   console.log($scope.edudocument);
                  //  console.log($scope.resumeword);
              });
         }
    }
});

app.filter('slugify', function() {
  return function(input) {
    return input.toString().toLowerCase().replace(/\s+/g, '-') //replace space with -
  .replace(/[^\w\-]+/g, '') //remove all non-word character
  .replace(/\-\-+/g, '-') //replace multiple -  with single -
  .replace(/^-+/, '') //trim - from start of text
  .replace(/-+$/, ''); //trim - from end of text
  }
});