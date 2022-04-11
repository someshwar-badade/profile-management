<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section ng-cloak class="content" ng-controller="dashboardCtrl">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-12">
                    <h1>Dashboard</h1>
                </div>
            </div>

            <div class="row">

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?=base_url(route_to('profiles'))?>" style="color: inherit;">
                        <div class="info-box shadow-sm">
                            <span class="info-box-icon bg-info"><i class="fas fa-id-card"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Profiles</span>
                                <span class="info-box-number"><?= $counts['profiles'] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?=base_url(route_to('sendJoiningForm'))?>" style="color: inherit;">
                        <div class="info-box shadow-sm">
                            <span class="info-box-icon bg-success"><i class="fa fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">On-board</span>
                                <span class="info-box-number"><?= $counts['onboards'] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?=base_url(route_to('JobPositions'))?>" style="color: inherit;">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-warning"><i class="fas fa-graduation-cap"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Job Positions</span>
                                <span class="info-box-number"><?= $counts['jobPositions'] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?=base_url(route_to('clients'))?>" style="color: inherit;">
                        <div class="info-box shadow-lg">
                            <span class="info-box-icon bg-danger"><i class="fa fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Clients</span>
                                <span class="info-box-number"><?= $counts['clients'] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">


                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">On-board Approval Pendings</h3>

                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="candidate in onboardPendingList">
                                        <td>
                                            {{candidate.first_name + ' ' +  last_name}}
                                        </td>
                                        <td> {{candidate.email_primary}}</td>
                                        <td>
                                            <span class="text-danger">Approval Pending</span>
                                        </td>
                                        <td>
                                            <a href="{{base_url+'/editJoiningForm/'+candidate.id}}" class="text-muted">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>

                                    <tr ng-show="!onboardPendingPlaseholder && !onboardPendingList" class="no-data">
                                        <td colspan="4">No data available</td>

                                    </tr>
                                    <tr ng-show="onboardPendingPlaseholder" class="placeholder-wraper">
                                        <td colspan="4">
                                            <div class="text-placeholder placeholder"></div>
                                            <div class="text-placeholder placeholder"></div>
                                            <div class="text-placeholder placeholder"></div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">

                        <div class="card-header border-0">
                            <h3 class="card-title">Last 5 on-boards</h3>

                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>On-board Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="candidate in onboardList">
                                        <td>
                                            {{candidate.first_name + ' ' +  last_name}}
                                        </td>
                                        <td> {{candidate.email_primary}}</td>
                                        <td>
                                            {{dateFormat(candidate.approval_dt)}}
                                        </td>
                                        <td>
                                            <a href="{{base_url+'/editJoiningForm/'+candidate.id}}" class="text-muted">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>

                                    <tr ng-show="!onboardPlaseholder && !onboardList" class="no-data">
                                        <td colspan="4">No data available</td>

                                    </tr>
                                    <tr ng-show="onboardPlaseholder" class="placeholder-wraper">
                                        <td colspan="4">
                                            <div class="text-placeholder placeholder"></div>
                                            <div class="text-placeholder placeholder"></div>
                                            <div class="text-placeholder placeholder"></div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>


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
    app.controller('dashboardCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {
        $scope.onboardPendingList = null;
        $scope.onboardPendingPlaseholder = false;
        $scope.getOnBoardApprovalPendingList = function() {
            $scope.onboardPendingPlaseholder = true;
            $http({
                method: 'get',
                url: base_url + '/api/joining-form-list?start=0&length=10&filter[status]=1',
            }).then(function(response) {
                console.log(response);
                $scope.onboardPendingPlaseholder = false;
                $scope.onboardPendingList = response.data.data;
            }, function(response) {
                $scope.onboardPendingPlaseholder = false;

            });
        }

        $scope.getOnBoardApprovalPendingList();



        $scope.onboardList = null;
        $scope.onboardPlaseholder = false;
        $scope.getOnBoardList = function() {

            $scope.onboardPlaseholder = true;
            $http({
                method: 'get',
                url: base_url + '/api/joining-form-list?&columns[0][data]=approval_dt&order[0][column]=0&order[0][dir]=desc&start=0&length=5&filter[status]=2',
            }).then(function(response) {

                $scope.onboardPlaseholder = false;
                $scope.onboardList = response.data.data;
            }, function(response) {
                $scope.onboardPlaseholder = false;

            });
        }

        $scope.getOnBoardList();


    }]);
</script>
<?= $this->endSection() ?>