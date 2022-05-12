<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
    .w-250-px {
        width: 250px !important;
    }

    .w-200-px {
        width: 200px !important;
    }

    .w-230-px {
        width: 230px !important;
    }

    .w-160-px {
        width: 160px !important;
    }
</style>
<div class="content-wrapper">
    <section ng-cloak class="content" ng-controller="ServerSideProcessingCtrl as showCase">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-12">
                    <h1>Leaves Report</h1>

                    <div class="col-12 my-3 p-3 bg-light shadow-sm">
                        <fieldset>
                            <legend>Filter</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <select class="select2bs4" multiple="multiple" ng-model="filterForm.employee_id" style="width: 100%;">
                                            <?php foreach ($employeeList as $e) { ?>
                                                <option value="<?= $e['employee_id'] ?>"><?= $e['employee_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Leave Type</label>
                                        <select class="select2bs4" multiple="multiple" ng-model="filterForm.leave_type_id" style="width: 100%;">
                                            <?php foreach ($leaveTypes as $e) { ?>
                                                <option value="<?= $e['id'] ?>"><?= $e['title'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="select2bs4" multiple="multiple" ng-model="filterForm.status" style="width: 100%;">
                                            <option>Approved</option>
                                            <option>Cancelled</option>
                                            <option>Pending</option>
                                            <option>Rejected</option>
                                            <option>Request for cancellation</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" ng-change="myfun()" ng-init="filterForm.date ='<?= $today ?>'" class="form-control" jqdatepicker ng-model="filterForm.date" placeholder="dd-mmm-yyyy">
                                        <div class="text-danger" ng-show="filterFormErrors.date">{{filterFormErrors.date}}</div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Report For:</label>
                                        <div class="custom-control custom-radio d-inline mr-3 ml-3">
                                            <input class="custom-control-input" type="radio" id="reportForYear" value="year" ng-true-value="year" name="filterStatus" ng-model="filterForm.reportFor">
                                            <label for="reportForYear" class="custom-control-label">Year </label>
                                        </div>
                                        <div class="custom-control custom-radio d-inline mr-3 ml-3">
                                            <input class="custom-control-input" type="radio" id="reportForMonth" value="month" ng-true-value="month" name="filterStatus" ng-model="filterForm.reportFor">
                                            <label for="reportForMonth" class="custom-control-label">Month </label>
                                        </div>
                                        <div class="custom-control custom-radio d-inline mr-3 ml-3">
                                            <input class="custom-control-input" type="radio" id="reportForDay" value="day" ng-true-value="day" name="filterStatus" ng-model="filterForm.reportFor">
                                            <label for="reportForDay" class="custom-control-label">Day </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary" ng-click="fnGenerateReport()">
                                        <div ng-show="disableDownloadBtn" role="status" class="spinner-border spinner-border-sm">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>    
                                    Get Report</button>
                                    <button class="btn btn-sm btn-success" type="button" id="downloadBtn" ng-disabled="!reportData.length||disableDownloadBtn" ng-click="downloadReport()">Dowload Excel</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>


                    <div class="table-action">
                        <div id="reportTableWrapper" class="table-responsive">
                            <table id="reportTable" class="datatable table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Sr. No.</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Leave Date</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Days</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Employee name</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Leave type</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Reason</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Action By</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Status</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Comment</th>
                                        <th data-b-a-s="thin" data-fill-color="007bb0e7">Cancellation Reason</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr ng-repeat="report in reportData">
                                        <td data-b-a-s="thin">{{$index+1}}</td>
                                        <!-- <td colspan="9">{{report|json}}</td> -->
                                        <td data-b-a-s="thin">{{report.leave_date}}</td>
                                        <td data-b-a-s="thin">{{report.full_or_half}}</td>
                                        <td data-b-a-s="thin">{{report.employee_name}}</td>
                                        <td data-b-a-s="thin">{{report.leave_type}}</td>
                                        <td data-b-a-s="thin">{{report.reason}}</td>
                                        <td data-b-a-s="thin">{{report.action_by_user}}</td>
                                        <td data-b-a-s="thin">{{report.status}}</td>
                                        <td data-b-a-s="thin">{{report.comment}}</td>
                                        <td data-b-a-s="thin">{{report.cancellation_reason}}</td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>

                        <div ng-show="!reportData.length">
                            No data available.
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

<script src="<?= base_url('assets/js/tableToExcel.js') ?>"></script>


<script>
    app.controller('ServerSideProcessingCtrl', ServerSideProcessingCtrl);

    function ServerSideProcessingCtrl($scope, $http) {
        $scope.filterForm = {
            reportFor: 'day'
        };
        $scope.filterFormErrors = {};
        $scope.disableDownloadBtn = false;
        $scope.start = 0;
        $scope.length = 2;
        $scope.reportData = [];


        $scope.fnGenerateReport = function() {

            $scope.filterFormErrors = [];
            $scope.start = 0;
            if (!$scope.filterForm.date) {
                $scope.filterFormErrors.date = "Please select a date.";
                return;
            }
            $scope.reportData = [];
            $scope.disableDownloadBtn = true
            $scope.getReport($scope.start, $scope.length);
        }

        $scope.getReport = function(start, length) {


            var apiUrl = base_url + '/api/get-leave-report';
            var method = "POST";
            var postData = {
                start: start,
                length: length,
                filter: $scope.filterForm
            }
            $http({
                method: method,
                url: apiUrl,
                data: postData,
            }).then(function(response) {
                //$scope.reportData.concat(response.data.data);

                if (response.data.data.length > 0) {
                    $scope.reportData = $scope.reportData.concat(response.data.data);
                    console.log($scope.reportData);
                    $scope.getReport(response.data.start, response.data.length);
                } else {
                    $scope.disableDownloadBtn = false
                    alert("completed");
                }

            }, function(response) {

                console.log(response);
            });
        }
        $scope.downloadReport = function() {
            var filename = prompt("Enter file name:","leave-report");
            filename = filename.trim() || "leave-report";
            TableToExcel.convert(document.getElementById("reportTable"), {
                name: filename+".xlsx",
                sheet: {
                    name: "Sheet 1"
                }
            });
        }

    }
</script>

<?= $this->endSection() ?>