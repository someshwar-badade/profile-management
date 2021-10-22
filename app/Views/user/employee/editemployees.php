<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row m-0">

                <div class="col-12">
                    <section class="abutsSection  align-items-center d-flex ">

                        <div class="container mt-10">

                            <div class="row justify-content-center align-items-center">

                                <h2><?= lang('forms.editemployee.formHeading') ?></h2>
                                <div class="col-md-12 p-3">
                                    <br>
                                </div>

                                <div ng-controller="editEmployeeCtrl" class="col-md-12 p-0">

                                    <div class="RegitserForm">


                                        <div class="edit-employee-form">
                                            <div class="form">
                                                <form ng-cloak name="editemployeeForm" id="editemployeeForm" action="<?php echo base_url('User/editemployee'); ?>" method="POST">

                                                    <!-- <input name="__RequestVerificationToken" type="hidden" value="9KSR6gYe11NTT9acglcBLcGhaHJmTmlYJAtaAFYfUnvwxTxic-2erp2pdejcf-RBJ44dr0nNGVP089Hsx_tT7c8LXDxVHd1U3VeNA_w2EiELQZ1R0"> -->

                                                    <input data-val="true" data-val-number="The field UserId must be a number." data-val-required="The UserId field is required." id="UserId" name="UserId" type="hidden" value="0">
                                                    <div class="row">
                                                        <div class="form-group col-lg-5 col-sm-6 col-6">
                                                            <label>First Name<span class="text-danger">*</span></label>
                                                            <input class="form-control char-only" ng-model="formData.fname" data-val="true" data-val-maxlength="Maximum 150 characters allowed." data-val-maxlength-max="150" data-val-regex="Please enter first name" data-val-regex-pattern=".*\S+.*" data-val-required="Please enter first name" id="fname" maxlength="150" name="fname" placeholder="First Name" type="text" value="">
                                                            <span class="field-validation-valid text-danger" data-valmsg-for="FirstName" data-valmsg-replace="true"></span>
                                                        </div>
                                                        <div class="form-group col-lg-5  col-sm-6 col-6">
                                                            <label>Last Name</label>
                                                            <input class="form-control char-only" ng-model="formData.lname" data-val="true" data-val-maxlength="Maximum 150 characters allowed." data-val-maxlength-max="150" data-val-regex="Please enter last name" data-val-regex-pattern=".*\S+.*" data-val-required="Please enter last name" id="lname" maxlength="150" name="lname" placeholder="Last Name" type="text" value="">
                                                            <span class="field-validation-valid text-danger" data-valmsg-for="LastName" data-valmsg-replace="true"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-5 col-sm-6 col-6">
                                                            <label>Login Id (Email id)<span class="text-danger">*</span></label>
                                                            <input readonly autocomplete="false" ng-model="formData.email" class="form-control text-box single-line" data-val="true" data-val-maxlength="Maximum 150 characters allowed." data-val-maxlength-max="150" data-val-regex="Please enter valid email" data-val-regex-pattern="^[a-zA-Z0-9.!#$%&amp;'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$|^[0-9]{10}$" data-val-required="Please enter email" id="LoginId" maxlength="150" name="LoginId" placeholder="Email" type="text" value="">
                                                            <span class="field-validation-valid text-danger" data-valmsg-for="LoginId" data-valmsg-replace="true"></span>
                                                        </div>
                                                        <div class="form-group col-lg-5  col-sm-6 col-6">
                                                            <label>Role<span class="text-danger">*</span></label>
                                                            <select ng-model="formData.user_role" class="form-control" data-val="true" data-val-number="The field Employee Role must be a number." data-val-required="Please select employee role." id="user_role" name="user_role">
                                                                <option value="">Please Select</option>
                                                                <option ng-selected="{{formData.user_role}} === '1'" value="1">Worker</option>
                                                                <option ng-selected="{{formData.user_role}} === '2'" value="2">Supervisor</option>
                                                            </select>
                                                            <span class="field-validation-valid text-danger" data-valmsg-for="EmpTypeId" data-valmsg-replace="true"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-5 col-sm-6 col-6">
                                                            <label>Mobile</label>
                                                            <input autocomplete="false" ng-model="formData.mobile" class="form-control text-box single-line" data-val="true" data-val-maxlength="Maximum 10 characters allowed." data-val-maxlength-max="10" data-val-regex="Please enter valid mobile" data-val-regex-pattern="^[a-zA-Z0-9.!#$%&amp;'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$|^[0-9]{10}$" data-val-required="Please enter mobile" id="LoginId" maxlength="10" name="LoginId" placeholder="Mobile" type="text" value="">
                                                            <span class="field-validation-valid text-danger" data-valmsg-for="LoginId" data-valmsg-replace="true"></span>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="form-button col-lg-8 offset-lg-2 col-sm-12 col-12 text-right">
                                                            <br><br>
                                                            <!-- <button type="button" class="btn btn-success"> Create</button> -->
                                                            <button type="button" ng-disabled="loading" ng-click="submitClick()" class="btn btn-success knowmore">
                                                                <div ng-show="loading" class="css-animated-loader"></div><?= lang('forms.editemployee.submitBtn.label') ?>
                                                            </button>
                                                            &nbsp;&nbsp;
                                                            <button type="button" class="btn btn-danger" ng-click="cancelClick()" data-dismiss="modal">Cancel</button>
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

                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>


<script>
    app.controller('editEmployeeCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {

        $scope.editMode = false;
        $scope.loading = false;
        $scope.errors = '';
        $scope.formData = {}

        $scope.slugify = function() {
            $scope.formData.slug = slugifyFilter($scope.formData.lang.en.title);
        }
        //$scope.formData.slug = urlencodeFilter($scope.formData.en.title);

        $scope.cancelClick = function() {
            window.location = base_url + '/employees';
        }

        $scope.submitClick = function() {

            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;


            $http({
                    method: 'put',
                    url: base_url + '/api/employees/' + $scope.formData.id,
                    // data:{'mobile':$scope.mobile,'password':$scope.password}
                    data: {
                        'fname': $scope.formData.fname,
                        'lname': $scope.formData.lname,
                        'email': $scope.formData.email,
                        'mobile': $scope.formData.mobile,
                        'user_role': $scope.formData.user_role,
                    }


                })
                .then(function(response) {
                    $scope.editMode = false;
                    $scope.loading = false;
                    window.location = base_url + '/employees';
                }, function(response) {

                    $scope.loading = false;
                    $scope.errors = response.data.messages;
                    console.log($scope.errors);
                    console.log($scope.errors['lang.en.title']);
                });
        }


        //get category details
        $http({
            method: 'get',
            url: base_url + '/api/employees/' + '<?= $id ?>',
        }).then(function(response) {
            console.log(response);
            $scope.formData = response.data;

        }, function(response) {


        });


    }]);
</script>

<?= $this->endSection() ?>