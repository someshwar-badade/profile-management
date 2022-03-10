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

    <?php if (hasCapability('joining_form/add')) { ?>
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
                                    <input type="text" id="candidateFullName" ng-model="joiningForm.first_name" ng-init="joiningForm.first_name='<?= isset($profile['first_name']) ? $profile['first_name'] : '' ?>'" maxlength="50" name="first_name" class="form-control">
                                    <div class="text-danger" ng-show="errors.first_name">{{errors.first_name}}</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="inputName">Last Name <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" id="candidateFullName" ng-model="joiningForm.last_name" ng-init="joiningForm.last_name='<?= isset($profile['last_name']) ? $profile['last_name'] : '' ?>'" maxlength="50" name="last_name" class="form-control">
                                    <div class="text-danger" ng-show="errors.last_name">{{errors.last_name}}</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="inputName">E-mail <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="email" id="emailPrimary" ng-model="joiningForm.email_primary" ng-init="joiningForm.email_primary='<?= isset($profile['email_primary']) ? $profile['email_primary'] : '' ?>'" maxlength="100" name="email_primary" class="form-control">
                                    <div class="text-danger" ng-show="errors.email_primary">{{errors.email_primary}}</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="inputName">Aadhar Number <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" id="candidateFullName" ng-model="joiningForm.aadhar_number" ng-init="joiningForm.aadhar_number='<?= isset($profile['aadhar_number']) ? $profile['aadhar_number'] : '' ?>'" maxlength="12" name="aadhar_number" class="form-control">
                                    <div class="text-danger" ng-show="errors.aadhar_number">{{errors.aadhar_number}}</div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3" for="inputName">PAN Number <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" id="candidateFullName" ng-model="joiningForm.pan_number" ng-init="joiningForm.pan_number='<?= isset($profile['pan_number']) ? $profile['pan_number'] : '' ?>'" maxlength="10" name="pan_number" class="form-control">
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


            <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Approve Joining Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" ng-click="approveJoiningForm()" class="btn btn-primary">Approve</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    <?php } ?>

    <section ng-cloak class="content" ng-controller="ServerSideProcessingCtrl as showCase">
        <div class="container-fluid">

            <div class="row m-0">

                <div class="col-12">
                    <h1>List</h1>


                    <div>
                        <div ng-show="tableAction.loader" class="spinner-border text-primary"></div>
                        <div class="col-md-12 alert alert-success alert-dismissible fade show" role="alert" ng-show="tableAction.successMessage">
                            {{tableAction.successMessage}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert" ng-show="tableAction.errorMessage">
                            {{tableAction.errorMessage}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-action">

                        <div class="table-responsive">
                            <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" dt-instance="dtInstance" class="row-border hover"></table>
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

    function ServerSideProcessingCtrl($scope, DTOptionsBuilder, DTColumnBuilder, $compile, $http, $filter) {
        $scope.tableFilter = {};
        $scope.profile = {};
        $scope.tableAction = {};
        $scope.tableAction.loader = false;
        $scope.tableAction.successMessage = '';
        $scope.tableAction.errorMessage = '';

        // $scope.joiningForm = {};
        var vm = this;
        $scope.dtInstance = {};
        vm.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                // dataSrc: 'data',
                url: base_url + '/api/joining-form-list',
                data: {
                    filter: $scope.tableFilter
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
            DTColumnBuilder.newColumn("first_name").withTitle('First Name'),
            DTColumnBuilder.newColumn("last_name").withTitle('Last Name'),
            // DTColumnBuilder.newColumn("").withTitle('Full Name').withTitle('Candidate name').renderWith(function(data, type, full) {
            //     return "<a role='button' class='text-primary' href='" + base_url + "/profile/" + full.id + "/edit'  >" + full.candidate_name + "</a>";
            // }),
            DTColumnBuilder.newColumn("email_primary").withTitle('Email'),
            DTColumnBuilder.newColumn("mobile_primary").withTitle('Mobile'),
            DTColumnBuilder.newColumn("created_at").withTitle('Created Date').renderWith(function(data, type, full) {
                return $filter('date')(new Date(data), 'dd-MMM-yyyy');
            }),
            DTColumnBuilder.newColumn("is_accept_declaration").withTitle('Form Submited Date').renderWith(function(data, type, full) {
                if (!data) {
                    return '';
                }
                return $filter('date')(new Date(data), 'dd-MMM-yyyy');
            }),
            DTColumnBuilder.newColumn("status").withTitle('Status').renderWith(function(data, type, full) {
                let html;
                html = "<span class='text-info'>New</span>";
                if (full.status == '1') {
                    html = "<span class='text-danger'>Approval Pending</span>";
                }
                if (full.status == '2') {
                    html = "<span class='text-success'>Approved</span>";
                }
                return html;
            }),
            // DTColumnBuilder.newColumn("primary_skills").withTitle('Top Skils'),
            // DTColumnBuilder.newColumn("secondary_skills").withTitle('Middle Skils'),
            DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {
                // return full.gender + ' ' + full.id;
                //href='" + base_url + "/profile/" + full.id + "/edit'

                var html = '<div class="dropdown">' +
                    '<button class="btn" type="button" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>' +
                    '<ul class="dropdown-menu">' +
                    "<li> <a role='button' class='mx-2 text-default' href='" + base_url + "/editJoiningForm/" + full.id + "' ><i class='far fa-eye'></i> View/Edit</a></li>" +
                    // "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.deleteClick(" + full.id + ")' ><i class='fas fa-trash-alt'></i> Delete</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.sendLink(" + full.id + ")' ><i class='far fa-paper-plane'></i> Send Link</a></li>" +
                    "<li> <a target='_blank' class='mx-2 text-default' href='" + base_url + "/download-joining-form/" + full.id + "' ><i class='fas fa-download'></i> Download</a></li>"
                if (full.status == '1') {
                    html += "<li> <a  class='mx-2 text-default' role='button'  ng-click='showCase.approveJoiningForm(" + full.id + ")' ><i class='fas fa-user-check'></i> Approve</a></li>"
                }
                if (full.status == '2') {

                    html += "<li> <a  class='mx-2 text-default'  href='#' ><i class='far fa-user'></i> Create User</a></li>";
                }
                html += '</ul>'
                '</div>';


                return html;


            }).notSortable(),

        ];

        $scope.clearFilter = function() {
            $scope.tableFilter.status = '';
            $scope.tableFilter.title = '';;
        }

        vm.viewProfile = function(id) {
            $scope.profile = {};
            $('#viewProfileModal').modal('toggle');
            // get profile details
            $http({
                method: 'get',
                url: base_url + '/api/joining-form-list/' + id,
            }).then(function(response) {
                console.log(response);
                $scope.profile = response.data;
                $scope.profile.editUrl = base_url + "/editJoiningForm/" + $scope.profile.id + "/edit";
            }, function(response) {


            });
        }

        vm.deleteClick = function(id) {

            if (!confirm("Do you want to delete this record (ID:" + id + ").")) return false;

            $http({
                    method: 'delete',
                    url: base_url + '/api/joining-form-list/' + id,

                })
                .then(function(response) {
                    $scope.editMode = false;
                    $scope.loading = false;
                    window.location = base_url + '/joining-form-list';
                }, function(response) {

                    $scope.loading = false;
                    $scope.errors = response.data.messages;
                    console.log($scope.errors);
                    console.log($scope.errors['lang.en.title']);
                });
        }

        vm.sendLink = function(id) {
            $scope.tableAction.loader = true;
            // if (!confirm("Do you want to delete this record (ID:" + id + ").")) return false;

            $http({
                    method: 'post',
                    url: base_url + '/api/employee-joining-form/send-link',
                    data: {
                        id: id
                    }
                })
                .then(function(response) {


                    $scope.tableAction.loader = false;
                    $scope.tableAction.successMessage = response.data.success;
                    $scope.tableAction.errorMessage = '';
                    // console.log(response);
                    toastr.success(response.data.messages.success);
                }, function(response) {

                    $scope.tableAction.loader = false;
                    $scope.tableAction.successMessage = '';

                    if (response.data.status == 403) {
                        $scope.tableAction.errorMessage = response.data.messages.errorMessage;
                    } else {
                        $scope.tableAction.errorMessage = "Something went wrong !!";

                    }
                });
        }

        vm.approveJoiningForm = function(id) {

            if (!confirm("You can not modify the details after approve this form!")) {
                return false;
            }
            $scope.tableAction.loader = true;
            // if (!confirm("Do you want to delete this record (ID:" + id + ").")) return false;

            $http({
                    method: 'post',
                    url: base_url + '/api/employee-joining-form/approve',
                    data: {
                        id: id
                    }
                })
                .then(function(response) {

                    console.log($scope.dtInstance);
                    $scope.dtInstance._renderer.reloadData();
                    $scope.tableAction.loader = false;
                    $scope.tableAction.successMessage = response.data.success;
                    $scope.tableAction.errorMessage = '';
                    // console.log(response);
                    toastr.success(response.data.messages.success);
                }, function(response) {

                    $scope.tableAction.loader = false;
                    $scope.tableAction.successMessage = '';

                    if (response.data.status == 403) {
                        $scope.tableAction.errorMessage = response.data.messages.errorMessage;
                    } else {
                        $scope.tableAction.errorMessage = "Something went wrong !!";

                    }
                });
        }
    }



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