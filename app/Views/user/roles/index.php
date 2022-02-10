<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content" ng-controller="rolesCtrl">
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
                                    <select ng-model="role" ng-change="getCapabilities();" ng-init="role=''" class="form-control">
                                        <option value="">Select Role</option>
                                        <?php foreach ($roles as $role) { ?>
                                            <option value="<?= $role['id'] ?>"><?= $role['display_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                <div class="table-responsive">
                            <table ng-show="capabilities.length>0" class="table table-stripped">
                                <colgroup>
                                    <col width="250px;">
                                    <col>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Capability</th>
                                        <th>Is allowed?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="cap in capabilities">


                                        <td >{{cap.capability}}</td>
                                        <td >
                                            <label class="form-check-label ml-5 mb-3">
                                                <input type="checkbox" class="form-check-input" ng-model="capabilities[$index].is_allowed" ng-true-value="'1'" ng-false-value="'0'">
                                            </label>
                                        </td>
                                        

                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <button class="btn btn-primary" ng-click="saveCapabilities()">Save</button>
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
        $scope.capabilities = {};
        $scope.old_module='';
        $scope.getCapabilities = function() {
            if ($scope.role == '') {
                $scope.capabilities = {}
                return false;
            }

            $scope.errors = '';
            $scope.successMessage = '';
            $scope.loading = true;


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
            $scope.loading = true;


            var apiUrl = base_url + '/api/capabilities/' + $scope.role;
            var method = "POST";
            $http({
                method: method,
                url: apiUrl,
                data: $scope.capabilities
            }).then(function(response) {

                $scope.loading = false;
                console.log(response);
                $scope.capabilities = response.data;
                toastr.success("Updated Successfully");
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
    }]);
</script>

<?= $this->endSection() ?>