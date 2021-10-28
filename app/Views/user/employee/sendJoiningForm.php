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


    <section class="content" ng-controller="ServerSideProcessingCtrl as showCase">
        <div class="container-fluid">

            <div class="row m-0">

                <div class="col-12">
                    <h1>List</h1>



                    <div class="table-action">

                        <div>
                            <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="row-border hover"></table>
                        </div>

                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->

        <!-- The Modal -->
        <div class="modal" id="viewProfileModal">
            <div class="modal-dialog modal-lg mw-100">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header bg-primary">
                        <div class="col-sm-4"><small><label for="">Date of creation: </label> {{profile.created_at}}</small></div>
                        <div class="col-sm-4"><small><label for="">Last modified: </label> {{profile.updated_at | timeAgo}}</small></div>
                        <div class="col-sm-3"><small><label for="">Updated By: </label> {{profile.updated_by}}</small></div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">

                        <!-- <div class="form-group row">
                                <label class="col-sm-3" for="inputName">Candidate full name </label>
                                <div class="col-sm-3">{{profile.candidate_name}}</div>

                                <label class="col-sm-3" for="inputName">Gender </label>
                                <div class="col-sm-3">
                                    <span ng-show="profile.gender=='0'">Male</span>
                                    <span ng-show="profile.gender=='1'">Female</span>
                                </div>
                            </div> -->

                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">First Name </label>
                            <div class="col-sm-3">{{profile.first_name}}</div>

                            <label class="col-sm-3" for="inputName">Last Name </label>
                            <div class="col-sm-3">{{profile.candidate_name}}</div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">Father Name </label>
                            <div class="col-sm-3">{{profile.candidate_name}}</div>

                            <label class="col-sm-3" for="inputName">Mother Name </label>
                            <div class="col-sm-3">{{profile.candidate_name}}</div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">Mobile Number (primary) </label>
                            <div class="col-sm-3">{{profile.mobile_primary}}</div>
                            <!-- <label class="col-sm-3" for="inputName">Mobile Number (alternate)</label>
                                <div class="col-sm-3">
                                    {{profile.mobile_alternate}}
                                </div> -->
                            <label class="col-sm-3" for="inputName">Email (primary) </label>
                            <div class="col-sm-3">
                                {{profile.email_primary}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="inputName">Aadhar Card Number </label>
                            <div class="col-sm-3">{{profile.mobile_primary}}</div>

                            <label class="col-sm-3" for="inputName">PAN Card Number </label>
                            <div class="col-sm-3">
                                {{profile.email_primary}}
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                                <label class="col-sm-3" for="inputName">Email (primary) </label>
                                <div class="col-sm-3">
                                    {{profile.email_primary}}
                                </div>
                                <label class="col-sm-3" for="inputName">Email (alternate)</label>
                                <div class="col-sm-3">
                                    {{profile.email_alternate}}
                                </div>
                            </div> -->


                        <!-- <div class="form-group row">
                                <label class="col-sm-3" for="inputName">Resume</label>
                                <div class="col-sm-3">
                                    <div ng-show="profile.resume_pdf">
                                        <a class="iframe" ng-href="https://docs.google.com/gview?url={{profile.resume_pdf_url}}&embedded=true">{{profile.resume_pdf_name}}</a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div ng-show="profile.resume_doc">
                                        <a class="iframe" ng-href="https://docs.google.com/gview?url={{profile.resume_doc_url}}&embedded=true">{{profile.resume_doc_name}}</a>
                                    </div>
                                </div>
                            </div> -->



                        <div ng-show="profile.preferred_work_locations.length" class="form-group row">
                            <label class="col-sm-3" for="inputName">Preferred work locations </label>
                            <div class="col-sm-9">
                                <span class="badge badge-secondary ml-1" ng-repeat="work_location in profile.preferred_work_locations">{{work_location}}</span>
                            </div>
                        </div>

                        <div ng-show="profile.categories.length" class="form-group row">
                            <label class="col-sm-3" for="inputName">Categories </label>
                            <div class="col-sm-9">
                                <span class="badge badge-secondary ml-1" ng-repeat="categorie in profile.categories">{{categorie}}</span>
                            </div>
                        </div>

                        <div ng-show="profile.top_skills.length" class="form-group row">
                            <label class="col-sm-3" for="topSkills">Top Skills</label>
                            <div class="col-sm-9">
                                <span class="badge badge-secondary ml-1" ng-repeat="skill in profile.top_skills">{{skill}}</span>

                            </div>
                        </div>

                        <div ng-show="profile.middle_skills.length" class="form-group row">
                            <label class="col-sm-3" for="middleSkills">Middle Skills</label>
                            <div class="col-sm-9">
                                <span class="badge badge-secondary ml-1" ng-repeat="skill in profile.middle_skills">{{skill}}</span>

                            </div>
                        </div>

                        <div ng-show="profile.foundation_skills.length" class="form-group row">
                            <label class="col-sm-3" for="foundationSkills">Foundation Skills</label>
                            <div class="col-sm-9">
                                <span class="badge badge-secondary ml-1" ng-repeat="skill in profile.foundation_skills">{{skill}}</span>

                            </div>
                        </div>
                        <div ng-show="profile.certifications.length" class="form-group row">
                            <h4>Certifications</h4>
                        </div>
                        <div ng-show="profile.certifications.length" class="certifications">
                            <ol>
                                <!-- <label class="col-sm-3" for="foundationSkills"></label> -->
                                <li ng-repeat="certification in profile.certifications">
                                    {{certification.description}}
                                </li>
                            </ol>
                        </div>

                        <div ng-show="profile.work_experience.length" class="form-group row">
                            <h4>Work Experience</h4>
                        </div>

                        <div ng-show="profile.work_experience.length" class="work-experience">

                            <div class="form-group row">
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th style="width: 50%;">Responsibility</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="experience in profile.work_experience">
                                            <td>
                                                {{$index+1}}
                                            </td>
                                            <td>
                                                {{experience.company_name}}
                                            </td>
                                            <td>
                                                {{experience.from_date}}
                                            </td>
                                            <td>
                                                {{experience.to_date}}
                                            </td>
                                            <td>
                                                {{experience.responsibility}}
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a ng-href="{{profile.editUrl}}" class="btn btn-sm btn-primary">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>


<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    app.controller('ServerSideProcessingCtrl', ServerSideProcessingCtrl);

    function ServerSideProcessingCtrl($scope, DTOptionsBuilder, DTColumnBuilder, $compile, $http) {
        $scope.tableFilter = {};
        $scope.profile = {};
        // $scope.joiningForm = {};
        var vm = this;
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
            // DTColumnBuilder.newColumn("top_skills").withTitle('Top Skils'),
            // DTColumnBuilder.newColumn("middle_skills").withTitle('Middle Skils'),
            DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {
                // return full.gender + ' ' + full.id;
                //href='" + base_url + "/profile/" + full.id + "/edit'
                return "<a role='button' class='text-primary' ng-click='showCase.viewProfile(" + full.id + ")' >View</a>" +
                    "<a role='button' class='mx-1 text-danger' ng-click='showCase.deleteClick(" + full.id + ")' >Delete</a>"+
                    "<a target='_blank' class='mx-1 text-info' href='"+base_url+"/download-joining-form/" + full.id + "' >Download</a>";

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
                $scope.profile.editUrl = base_url + "/joining-form-list/" + $scope.profile.id + "/edit";
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
                console.log($scope.errors);
                console.log($scope.errors['lang.en.title']);
            });

        }
    }]);
</script>

<?= $this->endSection() ?>