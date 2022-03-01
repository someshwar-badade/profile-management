<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .login-container {
        position: absolute;
        top: 20%;
        right: 0;
    }
    .login-container h2{
        font-size:1.3rem;
    }

</style>

<section class="abutsSection clearfix">
    <div class="container mt-5">
        <div ng-controller="loginCtrl" class="row ">

            <div class="col-md-10 offset-md-1">
            <div class="card">
                    
                    <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <img src="<?= base_url('assets/images/login.png') ?>" style="width: 100%;">
                    </div>
                    <div class="col-md-6 vertical-center">
                   <div style="width: 100%;">
                    <h2 class="text-center">Sign in</h2>
                        <form name="login" id="login">


                            <div class="form-group">
                                <!--<label>Email or Mobile</label>-->
                                <input class="form-control" ng-model="email" type="text" maxlength="50" placeholder="<?= lang('forms.login.email.placeholder') ?>*">
                                <div class="text-danger" ng-show="errors.email">{{ errors.email}}</div>
                            </div>
                            <div class="form-group">
                                <!--<label>Password</label>-->
                                <input class="form-control" ng-model="password" maxlength="20" type="password" placeholder="<?= lang('forms.login.password.placeholder') ?>*">
                                <div class="text-danger" ng-show="errors.password">{{ errors.password}}</div>
                            </div>

                            <div class="form-row justify-content-center">

                                <div class="col-5">
                                    <div class="form-group ">
                                        <button type="button" ng-disabled="loading" ng-click="submitClick()" class="btn btn-block knowmore">
                                            <div ng-show="loading" class="css-animated-loader"></div><?= lang('forms.login.submitBtn.label') ?>
                                        </button>
                                    </div>
                                </div>

                                <!-- <div class="col-md-12 ">
                                    <div class="form-group text-center ">
                                        Click <a href="<?= base_url(route_to('joiningFormVerification2')) ?>">here</a> to update joining form.
                                    </div>
                                </div> -->
                                <div class="col-md-12 ">
                                    <div class="form-group text-center ">
                                         <a href="<?= base_url(route_to('forgot-password')) ?>">Forgot Password?</a>.
                                    </div>
                                </div>
                            </div>

                        </form>
                        </div>
                    </div>
                
                </div>
                </div>
                </div>
               
               
            </div>


        </div>
    </div>
</section>


<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script src="<?= base_url('assets/js/angular/controllers/contactusCtrl.js?v1.2') ?>"></script>
<script src="<?= base_url('assets/js/angular/controllers/loginCtrl.js?v1.3') ?>"></script>
<script src="<?= base_url('assets/js/angular/controllers/registerCtrl.js?v=1.1') ?>"></script>
<script src="<?= base_url('assets/js/angular/controllers/forgotPasswordCtrl.js?v=1.1') ?>"></script>

<script>
    app.controller('categoryController', ['$scope', '$http', function($scope, $http) {
            $scope.categories = [];
            $scope.getProducts = function(category_slug) {

                return $http({
                    method: 'get',
                    url: base_url + '/api/products/' + category_slug,
                    data: {},
                    async: false,
                    crossDomain: true,
                    processData: false,
                    contentType: false,
                });


            }

            $http({
                method: 'get',
                url: base_url + '/api/categories',
                data: {}

            }).then(function(response) {

                $scope.categories = response.data;

            }, function(response) {

                console.log(response);


            });
        }]).directive("owlCarousel", function() {
            return {
                restrict: 'E',
                transclude: false,
                link: function(scope) {
                    scope.initCarousel = function(element) {
                        // provide any default options you want
                        var defaultOptions = {
                            nav: true,
                            dots: false,
                            margin: 10,
                            navText: [
                                "<i class='fa fa-angle-left'></i>",
                                "<i class='fa fa-angle-right'></i>"
                            ],

                            responsive: {
                                0: {
                                    items: 1,
                                    margin: 20,
                                },
                                600: {
                                    items: 5,
                                    margin: 20,
                                },
                                1000: {
                                    items: 5,
                                    margin: 20,
                                }
                            }
                        };
                        var customOptions = scope.$eval($(element).attr('data-options'));
                        // combine the two options objects
                        for (var key in customOptions) {
                            defaultOptions[key] = customOptions[key];
                        }
                        // init carousel
                        $(element).owlCarousel(defaultOptions);
                    };
                }
            };
        })
        .directive('owlCarouselItem', [function() {
            return {
                restrict: 'A',
                transclude: false,
                link: function(scope, element) {
                    // wait for the last item in the ng-repeat then call init
                    if (scope.$last) {
                        scope.initCarousel(element.parent());
                    }
                }
            };
        }]);
</script>
<?= $this->endSection() ?>