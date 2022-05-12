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
                    <h1>Leave Approval
                    </h1>

                    <div class="col-12 my-3 p-3 bg-light shadow-sm">

                            <div class="filter">
                                <div class="custom-control custom-radio d-inline mr-3">
                                    <input class="custom-control-input custom-control-input-warning"  type="radio" id="filterAll" value="Pending" ng-true-value="Pending" name="filterStatus" ng-model="filterForm.status">
                                    <label for="filterAll" class="custom-control-label text-warning">Pending ({{statusWiseCount.pending}})</label>
                                </div>
                                <div class="custom-control custom-radio d-inline mr-3">
                                    <input class="custom-control-input custom-control-input-success" type="radio" id="filterActive"  name="filterStatus" value="Approved" ng-true-value="Approved" ng-model="filterForm.status">
                                    <label for="filterActive" class="custom-control-label text-success">Approved ({{statusWiseCount.approved}})</label>
                                </div>
                                <div class="custom-control custom-radio d-inline mr-3">
                                    <input class="custom-control-input custom-control-input-danger" type="radio"  id="filterInactive" value="Rejected" ng-true-value="Rejected" name="filterStatus" ng-model="filterForm.status">
                                    <label for="filterInactive" class="custom-control-label text-danger">Rejected ({{statusWiseCount.rejected}})</label>
                                </div>
                                <div class="custom-control custom-radio d-inline mr-3">
                                    <input class="custom-control-input custom-control-input-info" type="radio"  id="filterReqCancel" value="Request for cancellation" ng-true-value="Request for cancellation" name="filterStatus" ng-model="filterForm.status">
                                    <label for="filterReqCancel" class="custom-control-label text-info">Request for cancellation ({{statusWiseCount.reqcancel}})</label>
                                </div>
                                <div class="custom-control custom-radio d-inline mr-3">
                                    <input class="custom-control-input custom-control-input-secondary" type="radio"  id="filterCancelled" value="Cancelled" ng-true-value="Cancelled" name="filterStatus" ng-model="filterForm.status">
                                    <label for="filterCancelled" class="custom-control-label text-secondary">Cancelled ({{statusWiseCount.cancelled}})</label>
                                </div>
                            </div>

                        </div>

                    <div class="table-action">

                        <div class="table-responsive">
                            <small>
                                <table datatable="" dt-options="showCase.dtOptions" dt-instance="showCase.dtInstance" dt-columns="showCase.dtColumns" class="row-border hover"></table>
                            </small>
                        </div>

                    </div>
                </div>
            </div>


            <div class="modal" id="viewApprovalModal">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header p-2 bg-primary">
                            <h5 class="modal-title">Leave Approval</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row " ng-show="clientForm.created_at">
                                <div class="col-md-12">

                                    <small class="text-default text-mutex pull-right" style="margin-left: auto;">Created at: {{clientForm.created_at}}</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Employee Name<sup class="text-danger">*</sup></label>
                                            <div class="col-sm-9">
                                                {{clientForm.employee_name}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Leave Type<sup class="text-danger">*</sup></label>
                                            <div class="col-sm-9">
                                                {{clientForm.leave_type}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Reason<sup class="text-danger">*</sup></label>
                                            <div class="col-sm-9">
                                                {{clientForm.reason}}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Date(s)<sup class="text-danger">*</sup></label>
                                            <div class="col-sm-9">
                                                <table class="table table-sm">
                                                    <tbody>
                                                        <tr ng-repeat="selectDate in clientForm.dates">
                                                            <td>{{selectDate.date}}</td>
                                                            <td>{{selectDate.full_or_half}} Day</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td><label for="">Total :</label></td>
                                                            <td>{{clientForm.total_days}} Day(s)</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>


                                            </div>
                                        </div>

                                        <div ng-show="clientForm.status == 'Pending'" class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Comment<sup class="text-danger">*</sup></label>
                                            <div class="col-sm-9">
                                                <textarea ng-model="clientForm.comment" class="form-control" maxlength="300" cols="30" rows="2">{{clientForm.comment}}</textarea>
                                                <small class="text-muted pull-right">{{clientForm.comment.length || 0}}/300</small>
                                            </div>
                                        </div>
                                        <div ng-show="clientForm.status != 'Pending'" class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Comment<sup class="text-danger">*</sup></label>
                                            <div class="col-sm-9">
                                                {{clientForm.comment}}
                                            </div>
                                        </div>

                                        <div class="form-group row" ng-show="clientForm.status=='Cancelled' || clientForm.status=='Request for cancellation'">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right">Cancellation Reason</label>
                                            <div class="col-sm-9">
                                                {{clientForm.cancellation_reason}}
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <div class="row" ng-show="clientFormErrors.errorMessage">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        {{clientFormErrors.errorMessage}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" ng-show="clientForm.status=='Request for cancellation'" class="btn btn-sm btn-outline-warning" ng-click="showCase.cancelLeave()">Cancel Leave</button>
                            <button type="button" ng-show="clientForm.status=='Pending'" class="btn btn-sm btn-outline-success" ng-click="showCase.approveLeave()">Approve</button>
                            <button type="button" ng-show="clientForm.status=='Pending'" class="btn btn-sm btn-outline-danger" ng-click="showCase.rejectLeave()">Reject</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal" aria-label="Close">Close</button>
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
    app.controller('ServerSideProcessingCtrl', ServerSideProcessingCtrl);

    function ServerSideProcessingCtrl($scope, DTOptionsBuilder, DTColumnBuilder, $compile, $http) {

        var vm = this;
        $scope.statusWiseCount;
        $scope.clientForm = {
            dates: [],
            status: 'Pending'
        };
        $scope.errorMessages = null;

        $scope.filterForm = {status:'Pending'};
        vm.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('order', [
                [0, 'desc']
            ]).withOption('autoWidth', false)
            .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                // dataSrc: 'data',
                url: base_url + '/api/leaves-for-approval',
                data: {
                    filter: $scope.filterForm
                },
                type: 'GET',
                complete:function(){
                    $scope.statusWiseCount = vm.dtInstance.DataTable.context[0].json.statusWiseCount;
                    $scope.$apply();
                   
                }
            })
            // or here
            .withDataProp('data')
            .withOption('processing', true)
            .withOption('serverSide', true)
            .withPaginationType('full_numbers')
            .withOption('error',function(json){
                console.log("====");
                console.log(json);
            })
            .withOption('createdRow', function(row) {
                // Recompiling so we can bind Angular directive to the DT
                $compile(angular.element(row).contents())($scope);
                
            })
            .withOption('responsive', true);;
        vm.dtColumns = [
            DTColumnBuilder.newColumn("user_leave_id").withTitle('ID'),
            DTColumnBuilder.newColumn("employee_name").withTitle('Employee Name'),
            DTColumnBuilder.newColumn("leave_type").withTitle('Leave Type'),
            DTColumnBuilder.newColumn('dates').withTitle('From Date').renderWith(function(data, type, full) {
                var returnhtml = '';
                if (!data) {
                    return '';
                }
                try {
                    // let skills = JSON.parse(data);
                    data.forEach(function(item) {
                        var classBadge = 'opacity-50';

                        if (full.status == 'Approved') {
                            classBadge = "opacity-100";
                        }

                        if (full.status == 'Rejected') {
                            classBadge = "opacity-25";
                        }

                        if (full.status == 'Cancelled') {
                            classBadge = "opacity-25";
                        }

                        let full_or_half_day = item.full_or_half == '0.5' ? "<hr class='half-day'>" : "<hr>";
                        returnhtml += '<span class="leave-date badge badge-dark ml-1 ' + classBadge + ' ">' + item.date + full_or_half_day + '</span>';
                    });

                } catch (e) {

                }
                return returnhtml;

            }).notSortable(),
            DTColumnBuilder.newColumn("total_days").withTitle('Day(s)'),
            // DTColumnBuilder.newColumn("reason").withTitle('Reason'),
            DTColumnBuilder.newColumn("action_by_user").withTitle('Action By').withClass("w-250-px"),
            DTColumnBuilder.newColumn("status").withTitle('Status').renderWith(function(data, type, full) {
                var returnhtml = '';
                if (!data) {
                    return '';
                }
                try {
                    // let skills = JSON.parse(data);
                    var classBadge = 'badge-info';

                    if (data == 'Approved') {
                        classBadge = "badge-success";
                    }

                    if (data == 'Rejected') {
                        classBadge = "badge-danger";
                    }

                    if (data == 'Cancelled') {
                        classBadge = "badge-secondary";
                    }
                    if (data == 'Pending') {
                        classBadge = "badge-warning";
                    }


                    returnhtml = '<span class="badge ' + classBadge + ' ml-1 " title="' + (full.comment ? full.comment : '') + '">' + data + '</span>';


                } catch (e) {

                }
                return returnhtml;
            }),
            // DTColumnBuilder.newColumn("created_at").withTitle('Created Date'),
            DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {

                // return full.gender + ' ' + full.id;
                //href='" + base_url + "/profile/" + full.id + "/edit'
                var html = '<div class="dropdown">' +
                    '<button class="btn" type="button" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>' +
                    '<ul class="dropdown-menu">' +
                    "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.viewClient(" + full.user_leave_id + ")' ><i class='far fa-eye'></i> View</a></li>" +
                    '</ul>'
                '</div>';


                return html;

            }).notSortable(),


        ];

        vm.clearFilter = function() {

            $scope.filterForm.action_by = '';
            $scope.filterForm.model = '';
            $scope.filterForm.action_type = '';
            $scope.filterForm.from_dt = '';
            $scope.filterForm.to_dt = '';
        }
        
        // vm.initializeDatepicker = function() {
        //     $('.past-datepicker').datetimepicker({
        //         format: 'd-M-Y',
        //         scrollInput: false,
        //         timepicker: false,
        //         maxDate: new Date(),
        //         // validateOnBlur:false,
        //         // onSelectDate: function() {
        //         //   $scope.joiningForm.dob = $(el).val()
        //         // }
        //     });

        //     $('.datepicker').datetimepicker({
        //         format: 'd-M-Y',
        //         scrollInput: false,
        //         timepicker: false,
        //         // validateOnBlur:false,
        //         // onSelectDate: function(el) {
        //         //   console.log(el);
        //         //  $scope.interviewForm.shedule_dt = el;
        //         // }
        //     });
        // }

        vm.dtInstance = {};

        vm.reloadData = function() {
           
            vm.dtInstance._renderer.rerender();
        }
       
       
        vm.viewClient = function(client = '') {

            $scope.clientFormErrors = {};
            $('#viewApprovalModal').modal('toggle');
            if (client != '') {

                $http({
                    method: 'get',
                    url: base_url + '/api/leaves/' + client,
                }).then(function(response) {

                    $scope.clientForm = response.data;
                    //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
                }, function(response) {


                });
            } else {
                $scope.resetForm()

            }

        }

        vm.approveLeave = function(index) {

            $scope.clientFormErrors = {};
            var apiUrl = base_url + '/api/update-leaves-status';
            var method = "POST";
            var postData = angular.copy($scope.clientForm);
            postData.status = 'Approved'
            $http({
                method: method,
                url: apiUrl,
                data: postData,
            }).then(function(response) {

                $('#viewApprovalModal').modal('toggle');
                $scope.resetForm()
                $scope.clientFormErrors = {};

                toastr.success(response.data.messages.success);
                vm.reloadData();
                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.clientFormErrors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else if (!!response.data.messages.errorMessage) {
                    toastr.error(response.data.messages.errorMessage);
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });


        }
        vm.rejectLeave = function(index) {

            $scope.clientFormErrors = {};
            var apiUrl = base_url + '/api/update-leaves-status';
            var method = "POST";
            var postData = angular.copy($scope.clientForm);
            postData.status = 'Rejected';

            $http({
                method: method,
                url: apiUrl,
                data: postData,
            }).then(function(response) {

                $('#viewApprovalModal').modal('toggle');
                $scope.resetForm()
                $scope.clientFormErrors = {};

                toastr.success(response.data.messages.success);
                vm.reloadData();
                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.clientFormErrors = response.data.messages;

                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else if (!!response.data.messages.errorMessage) {
                    toastr.error(response.data.messages.errorMessage);
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });


        }
        vm.cancelLeave = function(index) {

            $scope.clientFormErrors = {};
            var apiUrl = base_url + '/api/update-leaves-status';
            var method = "POST";
            var postData = angular.copy($scope.clientForm);
            postData.status = 'Cancelled';

            $http({
                method: method,
                url: apiUrl,
                data: postData,
            }).then(function(response) {

                $('#viewApprovalModal').modal('toggle');
                $scope.resetForm()
                $scope.clientFormErrors = {};

                toastr.success(response.data.messages.success);
                vm.reloadData();
                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.clientFormErrors = response.data.messages;

                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else if (!!response.data.messages.errorMessage) {
                    toastr.error(response.data.messages.errorMessage);
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });


        }

        $scope.resetForm = function() {
            $scope.clientForm = {
                dates: [],
                status: 'Pending'
            };
            $scope.clientFormErrors = null;
        }
    }
</script>

<?= $this->endSection() ?>