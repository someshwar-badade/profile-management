<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section ng-cloak class="content" ng-controller="rolesCtrl">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-12">
                    <h1>Roles</h1>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">

                                <div class="form-group col-md-2 offset-md-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text bg-secondary">Role</span>
                                        </div>
                                        
                                        <select ng-model="role" ng-change="getCapabilities();" ng-init="role=''" class="form-control">
                                            <option value="">Select Role</option>
                                            <?php foreach ($roles as $role) { ?>
                                                <option value="<?= $role['id'] ?>"><?= $role['display_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-8 offset-md-2 col-sm-12">
                                    <div class="table-responsive">

                                        <table ng-show="capabilities.length>0" class="table table-stripped">
                                            <colgroup>
                                                <col style="width: 250px;">
                                                <col>
                                                <col style="width: 150px;">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" ><i class=" fa fa-search"></i></span>
                                                            </div>
                                                            <input type="text" ng-model="searchText" placeholder="Type here to search..." class="form-control col-md-3">
                                                        </div>
                                                        <!-- <label for="">Search Capability</label> -->
                                                    </td>
                                                </tr>
                                               
                                                <tr>
                                                    <th>Capability</th>
                                                    <th>Description</th>
                                                    <th>Is allowed?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr ng-repeat="cap in capabilities | filter:searchText"> -->
                                                <tr ng-repeat="(key, cap) in capabilities | customFilter:searchText">
                                                    <td>{{cap.capability}}</td>
                                                    <td>{{cap.description}}</td>
                                                    <td>
                                                        <label class="form-check-label ml-5 mb-3">
                                                            <input type="checkbox" class="form-check-input" ng-model="cap.is_allowed" ng-true-value="'1'" ng-false-value="'0'">
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr ng-show="loading">
                                                    <td colspan="3" class="text-center text-primary">
                                                        <div role="status" class="spinner-border">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <button ng-disabled="saveLoading" class="btn btn-primary" ng-click="saveCapabilities()">
                                                            <div ng-show="saveLoading" role="status" class="spinner-border spinner-border-sm">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                            <i ng-show="!saveLoading" class="fa fa-save"></i>
                                                            Save
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    app.controller('rolesCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {
        $scope.loading = false;
        $scope.saveLoading = false;
        $scope.capabilities = {};
        $scope.old_module = '';
        $scope.getCapabilities = function() {
            $scope.loading = true;
            $scope.capabilities = {}
            if ($scope.role == '') {
                return false;
            }

            $scope.errors = '';
            $scope.successMessage = '';



            var apiUrl = base_url + '/api/capabilities/' + $scope.role;
            var method = "GET";
            $http({
                method: method,
                url: apiUrl,
            }).then(function(response) {

                $scope.loading = false;
                console.log(response);
                $scope.capabilities = response.data;

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

        $scope.saveCapabilities = function() {
            $scope.errors = '';
            $scope.successMessage = '';
            $scope.saveLoading = true;


            var apiUrl = base_url + '/api/capabilities/' + $scope.role;
            var method = "POST";
            $http({
                method: method,
                url: apiUrl,
                data: $scope.capabilities
            }).then(function(response) {

                $scope.saveLoading = false;
                console.log(response);
                $scope.capabilities = response.data;
                toastr.success("Updated Successfully");
                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.saveLoading = false;
                $scope.errors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    toastr.error("Something went wrong !!");
                }

            });
        }
    }]);
</script>

<?= $this->endSection() ?>