<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div>
                    <h1><?= $pageHeading ?></h1>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section ng-cloak class="content" ng-controller="sendJoiningFormCtrl">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card card-primary">
                    <nav class="navbar navbar-expand sticky-form-header">
                        <div ng-show="loading" class="spinner-border text-primary"></div>
                        <div class="text-success">{{successMessage}}</div>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><button class="btn btn-sm btn-success " ng-click="submitClick()">
                                    Send</button>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url(route_to('user-dashboard')) ?>" class="btn btn-sm btn-secondary ml-2">Cancel</a>

                            </li>
                        </ul>
                    </nav>

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">First Name <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" id="candidateFullName" ng-model="joiningForm.first_name" maxlength="50" name="first_name" class="form-control">
                                <div class="text-danger" ng-show="errors.first_name">{{errors.first_name}}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">Last Name <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" id="candidateFullName" ng-model="joiningForm.last_name" maxlength="50" name="last_name" class="form-control">
                                <div class="text-danger" ng-show="errors.last_name">{{errors.last_name}}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">Email <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="email" id="emailPrimary" ng-model="joiningForm.email_primary" maxlength="100" name="email_primary" class="form-control">
                                <div class="text-danger" ng-show="errors.email_primary">{{errors.email_primary}}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">Aadhar Number <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" id="candidateFullName" ng-model="joiningForm.aadhar_number" maxlength="12" name="aadhar_number" class="form-control">
                                <div class="text-danger" ng-show="errors.aadhar_number">{{errors.aadhar_number}}</div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">PAN Number <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" id="candidateFullName" ng-model="joiningForm.pan_number" maxlength="10" name="pan_number" class="form-control">
                                <div class="text-danger" ng-show="errors.pan_number">{{errors.pan_number}}</div>
                            </div>
                        </div>

                        <!-- </div> -->


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    app.controller('sendJoiningFormCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {

        $scope.editMode = false;
        $scope.loading = false;
        $scope.errors = '';
        $scope.successMessage = '';
        $scope.joiningForm = {}


        $scope.submitClick = function() {

            $scope.errors = '';
            $scope.successMessage = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;


            var apiUrl = base_url + '/api/send-joining-form';
            var method = "POST";
            $http({
                method: method,
                url: apiUrl,
                data: $scope.joiningForm
            }).then(function(response) {
                $scope.editMode = false;
                $scope.loading = false;

                $scope.successMessage = response.data.success;
                $scope.joiningForm = response.data.joiningForm;


                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                console.log($scope.errors);
                console.log($scope.errors['lang.en.title']);
            });

        }
    }]);
</script>

<?= $this->endSection() ?>