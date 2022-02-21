<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
    .w-250-px{
        width: 250px !important;
    }
    .w-200-px{
        width: 200px !important;
    }
    .w-230-px{
        width: 230px !important;
    }
    .w-160-px{
        width: 160px !important;
    }
</style>
<div class="content-wrapper">
    <section class="content" ng-controller="ServerSideProcessingCtrl as showCase">
        <div class="container-fluid">

            <div class="row m-0">

                <div class="col-12">
                    <h1>Logs</h1>

                    <div class="table-action">


                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Filter</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive" style="display: block;">
                                <table class="table  table-bordered">
                                    <colgroup>
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                    </colgroup>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <label for="">Model</label>
                                                <select ng-model="showCase.tableFilter.model" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="client">Client</option>
                                                    <option value="joining_form">Joining Form</option>
                                                    <option value="job_position">Job Position</option>
                                                    <option value="login">Login</option>
                                                    <option value="profile">Profile</option>
                                                </select>
                                            </td>
                                            <td>
                                                <label for="">Action</label>
                                                <select ng-model="showCase.tableFilter.action_type" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="created">Created</option>
                                                    <option value="updated">Updated</option>
                                                    <option value="deleted">Deleted</option>
                                                </select>
                                            </td>
                                            <td>
                                                <label for="">Action Date</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="From date" class="form-control datepicker" ng-init="showCase.initializeDatepicker();" maxlength="15" ng-model="showCase.tableFilter.from_dt">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="To date" class="form-control datepicker" ng-init="showCase.initializeDatepicker();" maxlength="15" ng-model="showCase.tableFilter.to_dt">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <label for="">Action By </label>
                                                <input type="text" placeholder="Action by user" class="form-control"  maxlength="15" ng-model="showCase.tableFilter.action_by">
                                                
                                            </td>

                                        </tr>

                                       


                                    </tbody>
                                    <tfoot ng-show="showCase.tableFilter">
                                        <tr>
                                            <td colspan="4">
                                                <button class="btn btn-sm btn-outline-secondary" ng-click="showCase.clearFilter()">Clear Fliter</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="table-responsive">
                            <small>

                                <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="row-border hover"></table>
                            </small>
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
        vm.tableFilter = {};
        vm.dtOptions = DTOptionsBuilder.newOptions()
         .withOption('order', [[0, 'desc']]).withOption('autoWidth', false)
            .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                // dataSrc: 'data',
                url: base_url + '/api/logs',
                data: {
                    filter: vm.tableFilter
                },
                type: 'GET'
            })
            // or here
            .withDataProp('data')
            .withOption('processing', true)
            .withOption('serverSide', true)
            .withPaginationType('full_numbers')
            .withOption('createdRow', function(row) {
                // Recompiling so we can bind Angular directive to the DT
                $compile(angular.element(row).contents())($scope);
            })
            .withOption('responsive', true);;
        vm.dtColumns = [
            DTColumnBuilder.newColumn("id").withTitle('ID'),
            DTColumnBuilder.newColumn("created_at").withTitle('Action Date').withClass("w-230-px"),
            DTColumnBuilder.newColumn("action_by").withTitle('Action By').withClass("w-250-px"),
            DTColumnBuilder.newColumn("model").withTitle('Model'),
            DTColumnBuilder.newColumn("action_type").withTitle('Action Type'),
            DTColumnBuilder.newColumn("chaged_data").withTitle('Changed Data'),
           

        ];

        vm.clearFilter = function() {

            vm.tableFilter.action_by = '';
            vm.tableFilter.model = '';
            vm.tableFilter.action_type = '';
            vm.tableFilter.from_dt = '';
            vm.tableFilter.to_dt = '';
        }
        vm.initializeDatepicker = function() {
            $('.past-datepicker').datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false,
                maxDate: new Date(),
                // validateOnBlur:false,
                // onSelectDate: function() {
                //   $scope.joiningForm.dob = $(el).val()
                // }
            });

            $('.datepicker').datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false,
                // validateOnBlur:false,
                // onSelectDate: function(el) {
                //   console.log(el);
                //  $scope.interviewForm.shedule_dt = el;
                // }
            });
        }
      

       
    }
</script>

<?= $this->endSection() ?>