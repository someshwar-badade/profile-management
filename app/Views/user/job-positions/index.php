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
                    <h1>Job Positions</h1>
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
                                            <td>
                                                <label for="">Job Code</label>
                                                <input type="text" maxlength="10" class="form-control" ng-model="tableFilter.job_code">
                                            </td>
                                            <td>
                                                <label for="">Title</label>
                                                <input type="text" maxlength="30" class="form-control" ng-model="tableFilter.title">
                                            </td>
                                            <td>
                                                <label for="">Position received date</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="From date" class="form-control datepicker" ng-init="showCase.initializeDatepicker();" maxlength="15" ng-model="tableFilter.received_date_from">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="To date" class="form-control datepicker" ng-init="showCase.initializeDatepicker();" maxlength="15" ng-model="tableFilter.received_date_to">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label for="">Valid to date</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="From date" class="form-control datepicker" ng-init="showCase.initializeDatepicker();" maxlength="15" ng-model="tableFilter.valid_date_from">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="To date" class="form-control datepicker" ng-init="showCase.initializeDatepicker();" maxlength="15" ng-model="tableFilter.valid_date_to">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

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


                        <div class="action text-right">
                            <button type="button" ng-click="showCase.viewForm();" class="btn btn-sm btn-outline-primary mb-2"><i class="fa fa-plus"></i> Add new</button>
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
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header p-2 bg-primary">
                        <h5 class="modal-title">Job Position Details</h5>
                        <!-- <div class="col-sm-3"><small><label for="">Updated By: </label> {{profileForm.updated_by}}</small></div> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal">

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Client<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" ng-model="showCase.jobPositionForm.client_name">
                                                <option value="">Select</option>
                                                <?php foreach ($clients as $c) {
                                                    echo "<option value='" . $c['client_name'] . "'>" . $c['client_name'] . "</option>";
                                                } ?>
                                            </select>
                                            <div class="text-danger" ng-show="showCase.jobPositionFormErrors.client_name">{{showCase.jobPositionFormErrors.client_name}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Job Code<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="10" class="form-control form-control-sm" ng-model="showCase.jobPositionForm.job_code">
                                            <div class="text-danger" ng-show="showCase.jobPositionFormErrors.job_code">{{showCase.jobPositionFormErrors.job_code}}</div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Title<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="100" class="form-control form-control-sm" ng-model="showCase.jobPositionForm.title">
                                            <div class="text-danger" ng-show="showCase.jobPositionFormErrors.title">{{showCase.jobPositionFormErrors.title}}</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group  row">

                                                <label class="col-sm-6 col-form-label col-form-label-sm text-right">Min Experience</label>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" maxlength="2" class="form-control only-numbers" ng-model="showCase.jobPositionForm.min_exp_y">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Y</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" maxlength="2" class="form-control only-numbers" ng-change="showCase.validateMinExpMonth()" ng-model="showCase.jobPositionForm.min_exp_m">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">M</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group  row">

                                                <label class="col-sm-6 col-form-label col-form-label-sm text-right">Max Experience</label>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-group input-group-sm ">
                                                                <input type="text" maxlength="2" class="form-control only-numbers" ng-model="showCase.jobPositionForm.max_exp_y">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Y</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group input-group-sm ">
                                                                <input type="text" maxlength="2" class="form-control only-numbers" ng-change="showCase.validateMaxExpMonth()" ng-model="showCase.jobPositionForm.max_exp_m">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">M</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Job Locations</label>
                                        <div class="col-sm-9">
                                            <tags-input ng-model="showCase.jobPositionForm.locations" use-strings="true" replace-spaces-with-dashes="false">
                                                <!-- <auto-complete source="showCase.loadTags($query)"></auto-complete> -->
                                            </tags-input>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Description<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <textarea cols="30" rows="2" id="desc" class="form-control" ng-model="showCase.jobPositionForm.desc"></textarea>
                                            <div class="text-danger" ng-show="showCase.jobPositionFormErrors.desc">{{showCase.jobPositionFormErrors.desc}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Primary skills<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <tags-input ng-model="showCase.jobPositionForm.primary_skills" on-tag-added="onTagAdded($tag)" use-strings="true" replace-spaces-with-dashes="false">
                                                <auto-complete source="showCase.loadTags($query)"></auto-complete>
                                            </tags-input>

                                            <div class="text-danger" ng-show="showCase.jobPositionFormErrors.primary_skills">{{showCase.jobPositionFormErrors.primary_skills}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Match Primary skills</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" ng-model="showCase.jobPositionForm.match_primary_skills">
                                                <option value="0">Match all skills</option>
                                                <option ng-repeat="skill in showCase.jobPositionForm.primary_skills" value="{{$index+1}}"> Match Any {{$index+1}} {{$index>1?"skills":"skill"}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Secondary skills<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <tags-input ng-model="showCase.jobPositionForm.secondary_skills" on-tag-added="onTagAdded($tag)" use-strings="true" replace-spaces-with-dashes="false">
                                                <auto-complete source="showCase.loadTags($query)"></auto-complete>
                                            </tags-input>

                                            <div class="text-danger" ng-show="showCase.jobPositionFormErrors.secondary_skills">{{showCase.jobPositionFormErrors.secondary_skills}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Match Secondary skills</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" ng-model="showCase.jobPositionForm.match_secondary_skills">
                                                <option value="0">Match all skills</option>
                                                <option ng-repeat="skill in showCase.jobPositionForm.secondary_skills" value="{{$index+1}}"> Match Any {{$index+1}} {{$index>1?"skills":"skill"}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Position received date<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9"><input type="text" maxlength="20" class="form-control form-control-sm datepicker" ng-init="showCase.initializeDatepicker();" ng-model="showCase.jobPositionForm.position_received_date">
                                            <div class="text-danger" ng-show="showCase.jobPositionFormErrors.position_received_date">{{showCase.jobPositionFormErrors.position_received_date}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Valid to date<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9"><input type="text" maxlength="20" class="form-control form-control-sm datepicker" ng-init="showCase.initializeDatepicker();" ng-model="showCase.jobPositionForm.valid_to_date">
                                            <div class="text-danger" ng-show="showCase.jobPositionFormErrors.valid_to_date">{{showCase.jobPositionFormErrors.valid_to_date}}</div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-success" ng-click="showCase.saveForm()">Save</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal" id="matchingProfileModal">
            <div class="modal-dialog modal-lg mw-100">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Matching Profiles</h5>
                        <!-- <div class="col-sm-3"><small><label for="">Updated By: </label> {{profileForm.updated_by}}</small></div> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-body" style="display: block;">
                                        <h5>{{showCase.jobPositionDetails.title}} <small>({{showCase.jobPositionDetails.job_code}}, {{showCase.jobPositionDetails.client_name}})</small></h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="text-secondary">Primary Skills ({{(showCase.jobPositionDetails.match_primary_skills != "0") ?'Match '+ showCase.jobPositionDetails.match_primary_skills +' skill(s)':'Match all skills'}}):</span>{{showCase.jobPositionDetails.primary_skills}}
                                            </div>
                                            <div class="col-md-6">
                                                <span class="text-secondary">Secondary Skills ({{(showCase.jobPositionDetails.match_secondary_skills != "0") ?'Match '+ showCase.jobPositionDetails.match_secondary_skills +' skill(s)':'Match all skills'}}):</span>{{showCase.jobPositionDetails.secondary_skills}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="text-secondary">Experience:</span> {{ (showCase.jobPositionDetails.min_experience / 12)|number:1}} - {{ (showCase.jobPositionDetails.max_experience / 12)|number:1}} Years
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>

                                <div ng-show="showCase.messages.success" class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{showCase.messages.success}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Experience</th>
                                            <th>Primary Skills</th>
                                            <th>Secondary Skills</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr ng-repeat="m_profile in showCase.matchingProfileList">
                                            <td>
                                                <input type="checkbox" ng-disabled="m_profile.isShortlisted" ng-checked="m_profile.isShortlisted" ng-model="showCase.toBeShortlistProfiles[$index]" ng-true-value="{{m_profile.id}}">

                                            </td>
                                            <td>{{m_profile.id}}</td>
                                            <td>
                                                <a target="_blank" ng-href="{{base_url+'/profile/'+m_profile.id}}">{{m_profile.first_name}} {{m_profile.last_name}}</a>

                                            </td>
                                            <td>{{m_profile.total_experience/12|number:0}} {{(m_profile.total_experience/12)>=2?'Years':'Year'}} {{m_profile.total_experience%12|number:0}} {{(m_profile.total_experience%12)>=2?'Months':'Month'}}</td>
                                            <td>
                                                <span class="badge badge-success ml-1" ng-repeat="skill in m_profile.primary_skills_matched">{{skill}}</span>
                                                <span class="badge badge-info ml-1" ng-repeat="skill in m_profile.primary_skills_other">{{skill}}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success ml-1" ng-repeat="skill in m_profile.secondary_skills_matched">{{skill}}</span>
                                                <span class="badge badge-info ml-1" ng-repeat="skill in m_profile.secondary_skills_other">{{skill}}</span>
                                            </td>
                                        </tr>
                                        <tr ng-show="showCase.matchingProfileList.length==0">
                                            <td colspan="6">
                                                <h5 class="text-center">No data available in table.</h5>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <table style="width: 100%;" datatable="" dt-options="showCase.matchingProfilesOptions" dt-columns="showCase.matchingProfilesColumns" class="table row-border hover"></table> -->
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-success" ng-click="showCase.saveShortlistedCandidates()">Shortlist Candidates</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" id="shortListedProfileModal">
            <div class="modal-dialog modal-lg mw-100">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Shortlisted Profiles</h5>
                        <!-- <div class="col-sm-3"><small><label for="">Updated By: </label> {{profileForm.updated_by}}</small></div> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-body" style="display: block;">
                                        <h5>{{showCase.jobPositionDetails.title}} <small>({{showCase.jobPositionDetails.job_code}}, {{showCase.jobPositionDetails.client_name}})</small></h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="text-secondary">Primary Skills ({{(showCase.jobPositionDetails.match_primary_skills != "0") ?'Match '+ showCase.jobPositionDetails.match_primary_skills +' skill(s)':'Match all skills'}}):</span>{{showCase.jobPositionDetails.primary_skills}}
                                            </div>
                                            <div class="col-md-6">
                                                <span class="text-secondary">Secondary Skills ({{(showCase.jobPositionDetails.match_secondary_skills != "0") ?'Match '+ showCase.jobPositionDetails.match_secondary_skills +' skill(s)':'Match all skills'}}):</span>{{showCase.jobPositionDetails.secondary_skills}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="text-secondary">Experience:</span> {{ (showCase.jobPositionDetails.min_experience / 12)|number:1}} - {{ (showCase.jobPositionDetails.max_experience / 12)|number:1}} Years
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Experience</th>
                                            <th>Primary Skills</th>
                                            <th>Secondary Skills</th>
                                            <th>Applied Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr ng-repeat="m_profile in showCase.shortlistProfiles">
                                            <td>
                                                <input type="checkbox" ng-disabled="m_profile.isShortlisted" ng-checked="m_profile.isShortlisted" ng-model="showCase.toBeShortlistProfiles[$index]" ng-true-value="{{m_profile.id}}">

                                            </td>
                                            <td>{{m_profile.id}}</td>
                                            <td><a target="_blank" ng-href="{{base_url+'/profile/'+m_profile.id}}">{{m_profile.first_name}} {{m_profile.last_name}}</a></td>
                                            <td>{{m_profile.total_experience/12|number:0}} {{(m_profile.total_experience/12)>=2?'Years':'Year'}} {{m_profile.total_experience%12|number:0}} {{(m_profile.total_experience%12)>=2?'Months':'Month'}}</td>
                                            <td>
                                                <span class="badge badge-success ml-1" ng-repeat="skill in m_profile.primary_skills_matched">{{skill}}</span>
                                                <span class="badge badge-info ml-1" ng-repeat="skill in m_profile.primary_skills_other">{{skill}}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success ml-1" ng-repeat="skill in m_profile.secondary_skills_matched">{{skill}}</span>
                                                <span class="badge badge-info ml-1" ng-repeat="skill in m_profile.secondary_skills_other">{{skill}}</span>
                                            </td>
                                            <td>{{m_profile.applied_dt}}</td>
                                        </tr>
                                        <tr ng-show="showCase.shortlistProfiles.length==0">
                                            <td colspan="7">
                                                <h5 class="text-center">No data available in table.</h5>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <table style="width: 100%;" datatable="" dt-options="showCase.matchingProfilesOptions" dt-columns="showCase.matchingProfilesColumns" class="table row-border hover"></table> -->
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-sm btn-primary" ng-click="srtpCtrl.shortlistCandidates()">Shortlist Candidates</button> -->
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" aria-label="Close">Close</button>
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

    function ServerSideProcessingCtrl($scope, DTOptionsBuilder, DTColumnBuilder, $compile, $http, $filter) {
        var vm = this;
        vm.showFilter = false;
        vm.varToggleClass = "fa-chevron-down";
        $scope.tableFilter = {};
        vm.matchingProfileList = {};
        vm.shortlistProfiles = {};
        vm.jobPositionForm = {};
        vm.jobPositionDetails = {};
        vm.messages = {};

        vm.validateMinExpMonth = function() {
            vm.jobPositionForm.min_exp_m
            if (vm.jobPositionForm.min_exp_m < 0) {
                vm.jobPositionForm.min_exp_m = 0;
            }
            if (vm.jobPositionForm.min_exp_m > 11) {
                vm.jobPositionForm.min_exp_m = 11;
            }
        }
        vm.validateMaxExpMonth = function() {
            vm.jobPositionForm.max_exp_m
            if (vm.jobPositionForm.max_exp_m < 0) {
                vm.jobPositionForm.max_exp_m = 0;
            }
            if (vm.jobPositionForm.max_exp_m > 11) {
                vm.jobPositionForm.max_exp_m = 11;
            }
        }


        vm.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                // dataSrc: 'data',
                url: base_url + '/api/job-positions',
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
            DTColumnBuilder.newColumn("job_code").withTitle('Job Code'),
            DTColumnBuilder.newColumn("title").withTitle('Title'),
            DTColumnBuilder.newColumn("").withTitle('Experience').renderWith(function(data, type, full) {
                var min = (full.min_experience / 12).toFixed(1);
                var max = (full.max_experience / 12).toFixed(1);
                return min + ' - ' + max + ' Years';
            }),
            DTColumnBuilder.newColumn("primary_skills").withTitle('Primary Skills').renderWith(function(data, type, full) {
                var returnhtml = '<span class="badge badge-info ml-1">';

                returnhtml += data.replace(/\|\|/g, '</span><span class="badge badge-info ml-1">');
                returnhtml += "</span>";
                returnhtml += "<p><small><b>" + (full.match_primary_skills > 0 ? 'Match any ' + full.match_primary_skills + ' skill(s)' : 'Match all skills') + "</b></small><p>";
                return returnhtml;

            }),
            DTColumnBuilder.newColumn("secondary_skills").withTitle('Secondary Skills').renderWith(function(data, type, full) {
                var returnhtml = '<span class="badge badge-info ml-1">';

                returnhtml += data.replace(/\|\|/g, '</span><span class="badge badge-info ml-1">');
                returnhtml += "</span>";
                returnhtml += "<p><small><b>" + (full.match_secondary_skills > 0 ? 'Match any ' + full.match_secondary_skills + ' skill(s)' : 'Match all skills') + "</b></small><p>";
                return returnhtml;

            }), // 
            DTColumnBuilder.newColumn("position_received_date").withTitle('Position received date').renderWith(function(data, type, full) {
                return $filter('date')(new Date(data), 'dd-MMM-yyyy');
            }),
            DTColumnBuilder.newColumn("valid_to_date").withTitle('Valid to date').renderWith(function(data, type, full) {
                return $filter('date')(new Date(data), 'dd-MMM-yyyy');
            }),
            DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {
                // return full.gender + ' ' + full.id;
                //href='" + base_url + "/profile/" + full.id + "/edit'
                var html = '<div class="dropdown">' +
                    '<button class="btn" type="button" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>' +
                    '<ul class="dropdown-menu">' +
                    "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.viewForm(" + full.id + ")' ><i class='far fa-eye'></i> View</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.matchingProfiles(" + full.id + ")' ><i class='fa fa-users'></i> Matching Profiles</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.shortlistedProfiles(" + full.id + ")' ><i class='fa fa-user-check'></i> Shortlisted Profiles</a></li>" +
                    "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.shortlistedProfiles(" + full.id + ")' ><i class='fa fa-user'></i> Applications</a></li>" +
                    //   "<li> <a role='button' class='mx-2 text-default' href='"+ base_url + "/send-joining-form?profile_id="+full.id+"'><i class='far fa-paper-plane'></i> Send Joining Form</a></li>"+
                    // "<li> <a role='button' class='mx-2 text-default' href='"+ base_url + "/interviews/"+full.id+"'><i class='far fa-id-card'></i> Interviews</a></li>"+
                    //   "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.deleteClick(" + full.id + ")' ><i class='fas fa-trash-alt'></i> Delete</a></li>"+
                    '</ul>'
                '</div>';


                return html;

            }).notSortable(),

        ];

        $scope.clearFilter = function() {
            $scope.tableFilter.job_code = '';
            $scope.tableFilter.title = '';
            $scope.tableFilter.received_date_from = '';
            $scope.tableFilter.received_date_to = '';
            $scope.tableFilter.valid_date_from = '';
            $scope.tableFilter.valid_date_to = '';
            $scope.tableFilter.primary_skills = [];
            $scope.tableFilter.secondary_skills = [];

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

        vm.viewForm = function(id = '') {
            vm.jobPositionForm = {};
            vm.jobPositionFormErrors = {};
            vm.toBeShortlistProfiles = {};
            vm.messages = {};
            $('#viewProfileModal').modal('toggle');
            if (id != '') {

                $http({
                    method: 'get',
                    url: base_url + '/api/job-position/' + id,
                }).then(function(response) {

                    vm.jobPositionForm = response.data;
                    //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
                }, function(response) {


                });
            }
        }

        vm.matchingProfiles = function(id) {
            $('#matchingProfileModal').modal('toggle');
            vm.matchingProfileList = {};
            vm.jobPositionDetails = {};
            vm.messages = {};
            if (id != '') {

                vm.getMatchingProfilesList(id);
            }


        }


        vm.getMatchingProfilesList = function(id) {
            $http({
                method: 'get',
                // url: base_url + '/api/profiles?job_position_id='+id,
                url: base_url + '/api/profiles?job_position_id=' + id,
            }).then(function(response) {

                vm.matchingProfileList = response.data.data;
                vm.jobPositionDetails = response.data.jobPositionDetails;
                vm.jobPositionDetails.primary_skills = vm.jobPositionDetails.primary_skills.replace(/\|\|/g, ', ');
                vm.jobPositionDetails.secondary_skills = vm.jobPositionDetails.secondary_skills.replace(/\|\|/g, ', ');
                //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
            }, function(response) {


            });
        }

        vm.saveShortlistedCandidates = function() {
            vm.messages = {};
            //
            $http({
                method: 'post',
                url: base_url + '/api/save-shortlist-candidates',
                data: {
                    'toBeShortlistProfiles': vm.toBeShortlistProfiles,
                    'job_position_id': vm.jobPositionDetails.id
                }
            }).then(function(response) {
                vm.getMatchingProfilesList(vm.jobPositionDetails.id);
                vm.messages = response.data.messages;
            }, function(response) {


            });
        }

        vm.shortlistedProfiles = function(id) {

            $('#shortListedProfileModal').modal('toggle');
            vm.shortlistProfiles = {};
            vm.jobPositionDetails = {};
            vm.messages = {};
            if (id != '') {

                $http({
                    method: 'get',
                    // url: base_url + '/api/profiles?job_position_id='+id,
                    url: base_url + '/api/profiles?shortlisted=true&job_position_id=' + id,
                }).then(function(response) {

                    vm.shortlistProfiles = response.data.data;
                    vm.jobPositionDetails = response.data.jobPositionDetails;
                    vm.jobPositionDetails.primary_skills = vm.jobPositionDetails.primary_skills.replace(/\|\|/g, ', ');
                    vm.jobPositionDetails.secondary_skills = vm.jobPositionDetails.secondary_skills.replace(/\|\|/g, ', ');
                    //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
                }, function(response) {


                });
            }
        }

        vm.saveForm = function() {
            vm.jobPositionFormErrors = '';
            vm.messages = {};
            // get profile details
            $http({
                method: 'post',
                url: base_url + '/api/job-position',
                data: vm.jobPositionForm
            }).then(function(response) {
                console.log(response);
                $('#viewProfileModal').modal('toggle');
                vm.jobPositionForm = {};
                //$scope.profileForm = response.data;
                // $scope.profile.editUrl = base_url + "/profile/" + $scope.profile.id + "/edit";
            }, function(response) {

                vm.loading = false;
                vm.jobPositionFormErrors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    toastr.error("Something went wrong !!");
                }
            });
        }

        vm.loadTags = function(query) {
            return $http.get(base_url + '/api/get-skills-autocomplete?query=' + query);
        };

        $scope.onTagAdded = function($tag) {
            if ($tag.text != '') {
                //save new tags
                $http({
                    method: 'post',
                    url: base_url + '/api/get-skills-autocomplete',
                    data: $tag
                }).then(function(response) {

                }, function(response) {});
            }
        }
    }
</script>

<?= $this->endSection() ?>