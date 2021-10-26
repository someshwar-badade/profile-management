<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="abutsSection clearfix">
    <div class="container mt-5">
        <div class="row justify-content-center">

            <div ng-controller="loginCtrl" class="col-md-6 p-0">
                <div class="justify-content-center">
                    <div class="card">

                    <div class="card-header text-center">
                        <h2><?= lang('forms.login.formHeading') ?></h2>

                    </div>
                        <div class="card-body">
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


                                <!-- <div class="form-group">
                            <p> <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotpasswordModal"> <?= lang('forms.login.forgotPassword') ?> </a></p>
                            </div> -->

                                <div class="form-row justify-content-center">

                                    <div class="col-5">
                                        <div class="form-group ">
                                            <button type="button" ng-disabled="loading" ng-click="submitClick()" class="btn btn-block knowmore">
                                                <div ng-show="loading" class="css-animated-loader"></div><?= lang('forms.login.submitBtn.label') ?>
                                            </button>
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