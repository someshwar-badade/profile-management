var app = angular.module('app', ['ngCookies','datatables','ui.bootstrap','angularjs-dropdown-multiselect','ngTagsInput','yaru22.angular-timeago']);
app.run(function($rootScope,$http,$filter) {
    $rootScope.base_url = base_url;

    $rootScope.dateFormat = function(data) {
      return $filter('date')(new Date(data), 'dd-MMM-yyyy');
    }
    $rootScope.dateTimeFormat = function(data) {
      return $filter('date')(new Date(data), 'dd-MMM-yyyy h:m a');
    }

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