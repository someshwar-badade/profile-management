<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
    .w-auto {
        width: auto;
    }

    fieldset {
        background-color: rgba(37, 0, 173, 0.1);
        border-radius: 10px;
        border: 1px solid rgb(37, 0, 173);
        position: relative;
    }

    legend {
        color: rgb(37, 0, 173);
        font-size: 1rem;
    }

    .custom-control-label::before {
        background-color: white;
    }

    .remove-btn.fa.fa-times.text-default {
        position: absolute;
        top: -10px;
        right: 10px;
    }

    #myTab.nav.nav-tabs {
        overflow-y: hidden;
        overflow-x: auto;
        flex-wrap: nowrap;
    }

    #myTab.nav.nav-tabs li {
        white-space: nowrap;
    }

    .tab-pane fieldset label {
        color: gray;
    }

    .tab-pane fieldset span {
        color: black;
        font-weight: 700;
    }

    .badge {
        font-size: 0.8rem;
    }

    .badge.extra-badge{
        display: none;
    }

    a.show-more-badges:hover > .extra-badge{
        display: inline-block;
    }

    .table-personal-info td,
    .table-personal-info th {
        padding: 2px;
        border: none;
    }
</style>
<div class="content-wrapper">
    <section class="content" ng-controller="ServerSideProcessingCtrl as showCase">
        <div class="container-fluid">

            <div class="row m-0">

                <div class="col-12">
                    <h1>Profiles</h1>

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
                            <div class="card-body" style="display: block;">
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                    </colgroup>
                                    <tbody>


                                        <tr>
                                            <td colspan="2">
                                                <label for="">Primary Skills</label>
                                                <tags-input ng-model="tableFilter.primary_skills" use-strings="true" replace-spaces-with-dashes="false">
                                                    <auto-complete source="showCase.loadTags($query)"></auto-complete>
                                                </tags-input>
                                            </td>
                                            <td colspan="2">
                                                <label for="">Secondary Skills</label>
                                                <tags-input ng-model="tableFilter.secondary_skills" use-strings="true" replace-spaces-with-dashes="false">
                                                    <auto-complete source="showCase.loadTags($query)"></auto-complete>
                                                </tags-input>
                                            </td>
                                        </tr>


                                    </tbody>
                                    <tfoot ng-show="tableFilter">
                                        <tr>
                                            <td colspan="4">
                                                <button class="btn btn-sm btn-outline-secondary" ng-click="clearFilter()">Clear Fliter</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- <div class="action text-right">
                            <a href="<?= base_url(route_to('createprofile')) ?>" class="btn btn-primary">Add new profile</a>
                        </div> -->
                        <div class="card">
                            <div class="card-body">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn bg-olive active">
                                        <input type="radio" name="options" id="option_b1" ng-model="tableFilter.status" value="" autocomplete="off"> All (<?= $statuseWiseCount['all'] ? $statuseWiseCount['all'] : 0 ?>)
                                    </label>
                                    <label class="btn bg-olive">
                                        <input type="radio" name="options" id="option_b2" ng-model="tableFilter.status" value="0" autocomplete="off"> New (<?= isset($statuseWiseCount['0']) ? $statuseWiseCount['0']['count'] : 0 ?>)
                                    </label>
                                    <label class="btn bg-olive">
                                        <input type="radio" name="options" id="option_b3" ng-model="tableFilter.status" value="1" autocomplete="off"> In Process (<?= isset($statuseWiseCount['1']) ? $statuseWiseCount['1']['count'] : 0 ?>)
                                    </label>
                                    <label class="btn bg-olive">
                                        <input type="radio" name="options" id="option_b4" ng-model="tableFilter.status" value="2" autocomplete="off"> Selected (<?= isset($statuseWiseCount['2']) ? $statuseWiseCount['2']['count'] : 0 ?>)
                                    </label>
                                    <label class="btn bg-olive">
                                        <input type="radio" name="options" id="option_b5" ng-model="tableFilter.status" value="3" autocomplete="off"> Blacklisted (<?= isset($statuseWiseCount['3']) ? $statuseWiseCount['3']['count'] : 0 ?>)
                                    </label>
                                </div>
                            </div>
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

        <!-- The Modal -->
        <div class="modal" id="viewProfileModal">
            <div class="modal-dialog modal-lg mw-100">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header bg-primary">
                        <div class="col-sm-4"><small><label for="">Date of creation: </label> {{profileForm.created_at}}</small></div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-3"><small><label for="">Last modified: </label> {{profileForm.updated_at | timeAgo}}</small></div>
                        <!-- <div class="col-sm-3"><small><label for="">Updated By: </label> {{profileForm.updated_by}}</small></div> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="employeeDetails-tab" data-toggle="tab" href="#employeeDetails" role="tab" data-iserror="{{errors.employeeDetailsTab}}" aria-controls="employeeDetails" aria-selected="true">Employee Details <span ng-show="errors.employeeDetailsTab" class="fa fa-exclamation-triangle text-danger"></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="educationalQualifications-tab" data-toggle="tab" href="#educationalQualifications" role="tab" data-iserror="{{errors.educationalQualificationsTab}}" aria-controls="educationalQualifications" aria-selected="false">Educational Qualifications <span ng-show="errors.educationalQualificationsTab" class="fa fa-exclamation-triangle text-danger"></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="employmentHistory-tab" data-toggle="tab" href="#employmentHistory" role="tab" data-iserror="{{errors.employmentHistoryTab}}" aria-controls="employmentHistory" aria-selected="false">Employment History <span ng-show="errors.employmentHistoryTab" class="fa fa-exclamation-triangle text-danger"></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="uploadDocuments-tab" data-toggle="tab" href="#uploadDocuments" role="tab" data-iserror="{{errors.uploadDocumentsTab}}" aria-controls="uploadDocuments" aria-selected="false">Documents <span ng-show="errors.uploadDocumentsTab" class="fa fa-exclamation-triangle text-danger"></span></a>
                                    </li>

                                </ul>
                                <div class="tab-content" id="myTabContent" style="background-color: white;padding:20px;">
                                    <div class="tab-pane fade show active" id="employeeDetails" role="tabpanel" aria-labelledby="employeeDetails-tab">
                                        <form class="">
                                            <fieldset class="form-group p-3">
                                                <legend class="w-auto px-2">Personal details</legend>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table table-personal-info">
                                                            <colgroup>
                                                                <col style="width: 150px;">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td><label>Name: </label></td>
                                                                    <td>{{profileForm.first_name}} {{profileForm.last_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>E-mail: </label></td>
                                                                    <td>{{profileForm.email_primary}} &nbsp; {{profileForm.email_alternate}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Mobile: </label></td>
                                                                    <td>{{profileForm.mobile_primary}} &nbsp; {{profileForm.mobile_alternate}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Gender: </label></td>
                                                                    <td>{{profileForm.gender}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Marital Status: </label></td>
                                                                    <td>{{profileForm.martial_status}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Date of Birth: </label></td>
                                                                    <td>{{profileForm.dob}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>PAN Number: </label></td>
                                                                    <td>{{profileForm.pan_number}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table class="table table-personal-info">
                                                            <colgroup>
                                                                <col style="width: 250px;">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <td><label>Current company: </label></td>
                                                                    <td>{{profileForm.current_company}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Total Experience: </label></td>
                                                                    <td>{{profileForm.total_experience/12|number:0}} {{(profileForm.total_experience/12)>=2?'Years':'Year'}} {{profileForm.total_experience%12|number:0}} {{(profileForm.total_experience%12)>=2?'Months':'Month'}}</td>
                                                                    <!-- <td>{{profileForm.total_experience}} Months</td> -->
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Relevant Experience: </label></td>
                                                                    <td>{{profileForm.relevant_experience/12|number:0}} {{(profileForm.relevant_experience/12)>=2?'Years':'Year'}} {{profileForm.relevant_experience%12|number:0}} {{(profileForm.relevant_experience%12)>=2?'Months':'Month'}}</td>

                                                                    <!-- <td>{{profileForm.relevant_experience}} Months</td> -->
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Notice Period: </label></td>
                                                                    <td>{{profileForm.notice_period}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Is notice period negotiable?: </label></td>
                                                                    <td>{{profileForm.is_negotiable_np=='1'?'Yes':'No'}}
                                                                    </td>
                                                                </tr>
                                                                <tr ng-show="profileForm.is_negotiable_np=='1'">
                                                                    <td><label>Last working day: </label></td>
                                                                    <td>{{profileForm.last_working_day}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Current CTC (in Lakh/annum): </label></td>
                                                                    <td>{{profileForm.ctc}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Expected CTC (in Lakh/annum): </label></td>
                                                                    <td>{{profileForm.expected_ctc}}</td>
                                                                </tr>
                                                                <!-- <tr>
                                                                    <td><label>Is negotiable expected CTC?: </label></td>
                                                                    <td>{{profileForm.is_negotiable_ctc=='1'?'Yes':'No'}}</td>
                                                                </tr> -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>



                                            </fieldset>

                                            <fieldset class="form-group p-3">
                                                <legend class="w-auto px-2">Address</legend>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Present Address: </label> <span>{{profileForm.present_address}} Postcode- {{profileForm.present_address_postcode}}</span>
                                                    </div>


                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Permanent Address: </label> <span>{{profileForm.permanent_address}} Postcode- {{profileForm.permanent_address_postcode}}</span>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset class="form-group p-3">
                                                <legend class="w-auto px-2">Skills</legend>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label>Primary Skills: </label>
                                                        <span>
                                                            <span class="badge badge-info ml-1" ng-repeat="skill in profileForm.primary_skills">{{skill}}</span>
                                                        </span>
                                                    </div>
                                                    <div class="form-group col-md-12">

                                                        <label>Secondary Skills: </label>
                                                        <span><span class="badge badge-info ml-1" ng-repeat="skill in profileForm.secondary_skills">{{skill}}</span></span>

                                                    </div>
                                                    <div class="form-group col-md-12">

                                                        <label>Foundation Skills: </label>
                                                        <span>
                                                            <span class="badge badge-info ml-1" ng-repeat="skill in profileForm.foundation_skills">{{skill}}</span>

                                                        </span>

                                                    </div>

                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                    <div class="tab-pane fade" id="educationalQualifications" role="tabpanel" aria-labelledby="educationalQualifications-tab">
                                        <div class="table-responsive">
                                            <form class="">
                                                <fieldset class="form-group p-3 table-responsive">
                                                    <table class="table table-bordered table-stripped">
                                                        <thead>
                                                            <tr>
                                                                <td><b>Degree / Course</b></td>
                                                                <td><b>Course Title along with Board / University</b></td>
                                                                <td style="width: 25%;"><b>Name and full address of school/Institution </b></td>
                                                                <td><b>From (MM-YYYY)</b></td>
                                                                <td><b>To (MM-YYYY)</b></td>
                                                                <td><b>Full time / Part Time/ off campus / Open Univ.</b></td>
                                                                <td><b>%age/ CGPA</b></td>
                                                                <td style="width: 80px;"></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="qualification in profileForm.education_qualification">
                                                                <td>
                                                                    {{qualification.degree}}
                                                                </td>
                                                                <td>
                                                                    {{qualification.university}}
                                                                </td>
                                                                <td>
                                                                    {{qualification.institution}}
                                                                </td>
                                                                <td>
                                                                    {{qualification.from_date}}
                                                                </td>
                                                                <td>
                                                                    {{qualification.to_date}}
                                                                </td>
                                                                <td>
                                                                    {{qualification.course_type}}
                                                                </td>
                                                                <td>
                                                                    {{qualification.percentage}}
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <a href="<?= base_url('uploaded-documents') ?>/{{qualification.document_path}}" title="Download document" target="_blank" ng-show="qualification.document_path" class="fa fa-download text-success"></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                    </table>
                                                </fieldset>

                                                <fieldset class="form-group p-3 table-responsive">
                                                    <div>
                                                        <p>Professional qualifications, memberships & licences</p>
                                                        <p>
                                                        <ul>
                                                            <li>Professional qualifications obtained or being studied for</li>
                                                            <li>Memberships of professional bodies</li>
                                                            <li>Professional licenses, certificates or registrations, including registrations with a regulatory body (e.g. ICAI) and whether you are in an approved regulatory role</li>
                                                        </ul>
                                                        </p>
                                                    </div>
                                                    <table class="table table-bordered table-stripped">
                                                        <thead>

                                                            <tr>
                                                                <td style="width: 50%;"><b>Qualification/Body/Institute / Licence</b></td>
                                                                <td><b>Category/Membership level</b></td>
                                                                <td><b>Dates (MM-YYYY)</b></td>
                                                                <td style="width: 80px;"></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="qualification in profileForm.professional_qualification">
                                                                <td>
                                                                    {{qualification.qualification}}
                                                                    <div class="text-danger" ng-show="errors['professional_qualification.'+$index+'.document_path']">{{errors['professional_qualification.'+$index+'.document_path']}}</div>
                                                                </td>
                                                                <td>
                                                                    {{qualification.category}}
                                                                </td>
                                                                <td>
                                                                    {{qualification.date}}
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('uploaded-documents') ?>/{{qualification.document_path}}" title="Download document" target="_blank" ng-show="qualification.document_path" class="fa fa-download text-success"></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                    </table>
                                                </fieldset>

                                            </form>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="employmentHistory" role="tabpanel" aria-labelledby="employmentHistory-tab">
                                        <div>
                                            <p> Starting with your <b>most recent employer</b> please give details of your complete employment history since you left full time education. Include any periods of self-employment, unemployment, maternity leave or <b>military service.</b> Include all part time and temporary employment and provide details of both the agencies and placements. Under ‘position held’ state clearly if you were a partner or had an ownership interest in any of the employing companies, or if the position was part time. If you are aware that one of your employers has changed its trading name, please provide the former name first, followed by the new name.</p>
                                        </div>
                                        <div class="table-responsive">
                                            <form class="">


                                                <fieldset class="form-group p-3 animation">
                                                    <table class="table table-bordered table-stripped">
                                                        <thead>

                                                            <tr>
                                                                <td><b>Company</b></td>
                                                                <td><b>From Date</b></td>
                                                                <td><b>To Date</b></td>
                                                                <td style="width: 50%;"><b>Main Job Responsibilities</b></td>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="employer in profileForm.employment_history.employers">
                                                                <td>
                                                                    {{employer.company}}
                                                                </td>
                                                                <td>
                                                                    {{employer.from_date}}
                                                                </td>
                                                                <td>
                                                                    {{employer.to_date}}
                                                                </td>
                                                                <td>
                                                                    {{employer.job_responsibilities}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>


                                                </fieldset>

                                            </form>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="uploadDocuments" role="tabpanel" aria-labelledby="uploadDocuments-tab">
                                        <form class="">


                                            <fieldset class="form-group p-3">
                                                <legend class="w-auto px-2">Uploaded Documents</legend>

                                                <ol ng-show="profileForm.documents">
                                                    <li class="animation" ng-repeat="(key,document) in profileForm.documents">

                                                        <a href="<?= base_url('uploaded-documents') ?>/{{document.path}}" target="_blank">{{getDocumentFullname(key)}}</a>
                                                        <!-- <a class="fas fa-trash text-danger ml-2" role="button" ng-click="removeDocument(key)" title="Remove"></a> -->
                                                    </li>
                                                </ol>



                                                <div class="text-center" ng-show="profileForm.documents.length=='0'">
                                                    <p>Documents not available.</p>
                                                </div>
                                            </fieldset>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <!-- <a ng-href="{{profile.editUrl}}" class="btn btn-sm btn-primary">Edit</a> -->
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
        $scope.tableFilter.status = '';
        $scope.profileForm = {};
        $scope.statusWiseCount = {};
        $scope.documentNameList = {
            cv: "Curriculum vitae",
            aadhar_card: "Aadhar Card",
            pan_card: "PAN Card",
        }
        $scope.getDocumentFullname = function(key) {
            return $scope.documentNameList[key];
        }
        var vm = this;
        vm.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                // dataSrc: 'data',
                url: base_url + '/api/profiles',
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
            DTColumnBuilder.newColumn("first_name").withTitle('First name').renderWith(function(data, type, full) {
                let fullname = '';
                if (full.first_name) {
                    fullname += full.first_name;
                }

                if (full.last_name) {
                    fullname += ' ' + full.last_name;
                }
                return fullname;
            }).withClass('text-capitalize'),
            // DTColumnBuilder.newColumn("email_primary").withTitle('Email'),
            DTColumnBuilder.newColumn("mobile_primary").withTitle('Mobile'),
            DTColumnBuilder.newColumn("total_experience").withTitle('Experience').renderWith(function(data, type, full) {
                if (full.total_experience) {
                    var years = (full.total_experience / 12).toFixed(0);
                    var months = (full.total_experience % 12);
                    return years + (years >= 2 ? ' Years ' : ' Year ') + months + (months >= 2 ? ' Months' : ' Month');
                    // return full.total_experience+' Months';
                }
                return '';
            }),
            DTColumnBuilder.newColumn("primary_skills").withTitle('Primary Skills').renderWith(function(data, type, full) {
                var returnhtml = '';
                if (!data) {
                    return '';
                }
                try {
                    // let skills = JSON.parse(data);
                    data.forEach(function(item) {
                        returnhtml += '<span class="badge badge-info ml-1 ">' + item.text + "["+item.rating+"/10]"+ '</span>';
                    });

                } catch (e) {

                }

                // returnhtml += data.replace(/\|\|/g, '</span><span class="badge badge-info ml-1">');
                // returnhtml += "</span>";
                return returnhtml;

            }),
            DTColumnBuilder.newColumn("secondary_skills").withTitle('Secondary Skills').renderWith(function(data, type, full) {
                var returnhtml = '';

                if (!data) {
                    return '';
                }
                try {
                    // let skills = JSON.parse(data);

                    data.forEach(function(item) {
                        returnhtml += '<span class="badge badge-info ml-1">' + item.text + "["+item.rating+"/10]"+ '</span>';
                    });
                } catch (e) {

                }
                return returnhtml;

            }),
            DTColumnBuilder.newColumn("status").withTitle('Status').renderWith(function(data, type, full) {
                var status = {
                    0: 'New',
                    1: 'In-process',
                    2: 'Selected',
                    3: 'Blacklist',
                };
                if (data == '') return '';
                return status[data];

            }),
            DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {
                // return full.gender + ' ' + full.id;
                //href='" + base_url + "/profile/" + full.id + "/edit'
                var html = '<div class="dropdown">' +
                    '<button class="btn" type="button" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>' +
                    '<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">' +
                    //"<li> <a role='button' class='mx-2 text-default' ng-click='showCase.viewProfile(" + full.id + ")' ><i class='far fa-eye'></i> View</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' href='" + base_url + "/profile/" + full.id + "?tab=employeeDetails' ><i class='far fa-user'></i> Personal Details</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' href='" + base_url + "/profile/" + full.id + "?tab=educationalQualifications' ><i class='fas fa-graduation-cap'></i> Academics</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' href='" + base_url + "/profile/" + full.id + "?tab=employmentHistory' ><i class='far fa-building'></i> Employment</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' href='" + base_url + "/profile/" + full.id + "?tab=uploadDocuments' ><i class='fa fa-file'></i> Documents</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' href='" + base_url + "/profile/" + full.id + "?tab=jobPositions' ><i class='fa fa-briefcase'></i> Jobs</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' href='" + base_url + "/send-joining-form?profile_id=" + full.id + "'><i class='far fa-paper-plane'></i> Send Joining Form</a></li>" +
                    // "<li> <a role='button' class='mx-2 text-default' href='"+ base_url + "/interviews/"+full.id+"'><i class='far fa-id-card'></i> Interviews</a></li>"+
                    "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.deleteClick(" + full.id + ")' ><i class='fas fa-trash-alt'></i> Delete</a></li>" +
                    '</ul>'
                '</div>';


                return html;

            }).notSortable(),

        ];

        $scope.clearFilter = function() {

            $scope.tableFilter.primary_skills = [];
            $scope.tableFilter.secondary_skills = [];
            $scope.tableFilter.status = '';
        }

        vm.viewProfile = function(id) {
            $scope.profile = {};
            $('#viewProfileModal').modal('toggle');
            // get profile details
            $http({
                method: 'get',
                url: base_url + '/api/profiles/' + id,
            }).then(function(response) {
                console.log(response);
                $scope.profileForm = response.data;
                $scope.profile.editUrl = base_url + "/profile/" + $scope.profile.id + "/edit";
            }, function(response) {


            });
        }

        vm.deleteClick = function(id) {

            if (!confirm("Do you want to delete this record (ID:" + id + ").")) return false;

            $http({
                    method: 'delete',
                    url: base_url + '/api/profiles/' + id,

                })
                .then(function(response) {
                    $scope.editMode = false;
                    $scope.loading = false;
                    window.location = base_url + '/profiles';
                }, function(response) {

                    $scope.loading = false;
                    $scope.errors = response.data.messages;
                    console.log($scope.errors);
                    console.log($scope.errors['lang.en.title']);
                });
        }

        vm.loadTags = function(query) {
            return $http.get(base_url + '/api/get-skills-autocomplete?query=' + query);
        };
    }
</script>

<?= $this->endSection() ?>