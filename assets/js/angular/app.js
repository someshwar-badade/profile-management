var app = angular.module('app', ['ngCookies','datatables','ui.bootstrap','angularjs-dropdown-multiselect','ngTagsInput','yaru22.angular-timeago','psi.sortable','textAngular']);
app.run(function($rootScope,$http,$filter) {
    $rootScope.base_url = base_url;

    $rootScope.dateFormat = function(data) {
      return $filter('date')(new Date(data), 'dd-MMM-yyyy');
    }
    $rootScope.dateTimeFormat = function(data) {
      return $filter('date')(new Date(data), 'dd-MMM-yyyy h:m a');
    }

    $rootScope.getBadgeHighlightClass = function(rating){
      switch(rating){
          case '0': return "badge-danger";
          case '1': return "badge-danger";
          case '2': return "badge-danger";
          case '3': return "badge-warning";
          case '4': return "badge-warning";
          case '5': return "badge-warning";
          case '6': return "badge-warning";
          case '7': return "badge-success";
          case '8': return "badge-success";
          case '9': return "badge-success";
          case '10': return "badge-success";
          default: return "badge-danger";
      }
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
                  //  console.log($scope.document);
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

app.filter('customFilter', function() {
  return function(input, search) {
    console.log(typeof(input));
    if (!input) return input;
    if (!search) return input;
    var expected = ('' + search).toLowerCase();
    var result = {};
    angular.forEach(input, function(value, key) {
      var actual = ('' + value).toLowerCase();
      console.log(typeof(value));
      if(typeof(value)=='object'){
        angular.forEach(value, function(value2, key2) {
          var actual2 = ('' + value2).toLowerCase();
          if (actual2.indexOf(expected) !== -1) {
            result[key] = value;
          }
        });
      }else{
        if (actual.indexOf(expected) !== -1) {
          result[key] = value;
        }
      }
     
    });
    return result;
  }
});


app.directive('starRating', function () {
  return {
      restrict: 'A',
      template: '<ul class="rating">' +
          '<li ng-repeat="star in stars" ng-class="star" ng-click="toggle($index)">' +
          '\u2605' +
          '</li>' +
          '</ul>',
      scope: {
          ratingValue: '=',
          max: '=',
          onRatingSelected: '&'
      },
      link: function (scope, elem, attrs) {

          var updateStars = function () {
              scope.stars = [];
              for (var i = 0; i < scope.max; i++) {
                  scope.stars.push({
                      filled: i < scope.ratingValue
                  });
              }
          };

          scope.toggle = function (index) {
              scope.ratingValue = index + 1;
              scope.onRatingSelected({
                  rating: index + 1
              });
          };

          scope.$watch('ratingValue', function (oldVal, newVal) {
              if (newVal) {
                  updateStars();
              }
          });
      }
  }
});