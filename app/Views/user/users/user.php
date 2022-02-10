<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section ng-cloak class="content" ng-controller="usersCtrl">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-12">
                    <h1>User</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add new user</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="fname" class="col-sm-2 col-form-label">First Name <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                      <input type="text" maxlength="50" class="form-control" id="fname" placeholder="First Name" ng-model="user.fname">
                      <div class="text-danger" ng-show="errors.fname">{{errors.fname}}</div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-2 col-form-label">Last Name <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                      <input type="text" maxlength="50" class="form-control" id="fname" placeholder="Last Name" ng-model="user.lname">
                      <div class="text-danger" ng-show="errors.lname">{{errors.lname}}</div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                      <input type="text" maxlength="50" class="form-control" id="inputEmail3" placeholder="Email" ng-model="user.email">
                      <div class="text-danger" ng-show="errors.email">{{errors.email}}</div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                      <input type="text" maxlength="12" class="form-control" id="mobile" placeholder="Mobile" ng-model="user.mobile">
                      <div class="text-danger" ng-show="errors.mobile">{{errors.mobile}}</div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="password" maxlength="30" class="form-control" id="password" placeholder="Password" ng-model="user.password">
                                <div class="input-group-append">
                                  <button ng-click="genPasswordClick()">Generate</button>  
                                </div>
                        </div>
                      <div class="text-danger" ng-show="errors.password">{{errors.password}}</div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                    <div ng-dropdown-multiselect="" options="roleList" selected-model="user.selected_role" extra-settings="example13settings"></div>
                  
                      
                      <div class="text-danger" ng-show="errors.role">{{errors.role}}</div>
                    </div>
                  </div>
                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" ng-click="saveUser()" class="btn btn-primary">Save</button>
                  <a role="button" class="btn btn-default float-right" href="<?=base_url(route_to('users'))?>" >Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<?= $this->endSection() ?>

<?= $this->section('javascript') ?>


<script>
    app.controller('usersCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {
        $scope.loading = false;
        $scope.errors = '';
        $scope.successMessage = '';
        $scope.user = {};
        $scope.user.selected_role = [];
        $scope.roleList = JSON.parse('<?= json_encode($roleList) ?>');
        $scope.example13settings = {
                smartButtonMaxItems: 3,
                template: '{{option.display_name}}',
                buttonClasses: "btn btn-primary btn-sm",
                checkBoxes: true,
                showCheckAll: false,
                showUncheckAll: false,
                selectionLimit:1,
                smartButtonTextConverter: function(skip, option) {
                    return option.display_name;
                }
                };

        $scope.saveUser = function(){
            $scope.errors = '';
            $scope.successMessage = '';
            $scope.loading = true;

            var apiUrl = base_url + '/api/user';
            var method = "POST";
            $http({
                method: method,
                url: apiUrl,
                data: $scope.user
            }).then(function(response) {
               
                $scope.loading = false;
                $scope.successMessage = response.data.success;
                toastr.success(response.data.success);
                $scope.user={};
                $scope.user.selected_role=[];
                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    toastr.error("Something went wrong !!");
                }

            });

        }

        $scope.genPasswordClick = function(){
            $scope.user.password = genPassword();
        }
    }]);
</script>

<?= $this->endSection() ?>