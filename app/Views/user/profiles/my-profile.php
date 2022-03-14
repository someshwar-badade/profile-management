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
</style>
<div class="content-wrapper">
    <section ng-cloak class="content-header" ng-controller="profileFormCtrl">
        <div class="container-fluid">
            <?php if (isset($showTitle) == null) { ?>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h1 style="display: inline-block;"> My Profile</h1>
                        <div class="input-group " style="flex-direction: row-reverse;">
                            <div class="dropdown ">

                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonDownload" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Download Resume
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonDownload">
                                    <a class="dropdown-item" href="<?= base_url(route_to('downloadMyResume')) ?>?template=template1&colorPrimary={{colorPrimary.replace('#','')}}">Template 1</a>
                                    <a class="dropdown-item" href="<?= base_url(route_to('downloadMyResume')) ?>?template=template2&colorPrimary={{colorPrimary.replace('#','')}}">Template 2</a>
                                    <a class="dropdown-item" href="<?= base_url(route_to('downloadMyResume')) ?>?template=template3&colorPrimary={{colorPrimary.replace('#','')}}">Template 3</a>
                                </div>
                            </div>
                            <div class="input-group-append">
                                <input type="color" class="form-control" style="width: 50px;padding:0;" ng-model="colorPrimary">
                            </div>
                        </div>


                    </div>
                </div>


            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Completed:
                <div class="progress">
                    <div class="progress-bar bg-success" ng-style="{'width':formComlpletion+'%'}">{{formComlpletion}}%</div>
                </div> -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="employeeDetails-tab" data-toggle="tab" href="#employeeDetails" role="tab" data-iserror="{{errors.employeeDetailsTab}}" aria-controls="employeeDetails" aria-selected="true">Candidate Details <span ng-show="errors.employeeDetailsTab" class="fa fa-exclamation-triangle text-danger"></span></a>
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
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>First Name<sup class="text-danger">*</sup></label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="First Name" ng-model="profileForm.first_name">
                                            <div class="text-danger" ng-show="errors.first_name">{{errors.first_name}}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Last Name<sup class="text-danger">*</sup></label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Last Name" ng-model="profileForm.last_name">
                                            <div class="text-danger" ng-show="errors.last_name">{{errors.last_name}}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Gender<sup class="text-danger">*</sup></label>
                                            <div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="gender1" name="gender" value="Male" ng-model="profileForm.gender" class="custom-control-input">
                                                    <label class="custom-control-label" for="gender1">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="gender2" name="gender" value="Female" ng-model="profileForm.gender" class="custom-control-input">
                                                    <label class="custom-control-label" for="gender2">Female</label>
                                                </div>
                                                <div class="text-danger" ng-show="errors['gender']">{{errors['gender']}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Marital Status<sup class="text-danger">*</sup></label>
                                            <div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline1" name="marital_status" value="Married" ng-model="profileForm.marital_status" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline1">Married</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline2" name="marital_status" value="Single" ng-model="profileForm.marital_status" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline2">Single</label>
                                                </div>
                                                <div class="text-danger" ng-show="errors['marital_status']">{{errors['marital_status']}}</div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>E-mail (primary)<sup class="text-danger">*</sup></label>
                                            <input type="email" maxlength="50" class="form-control" placeholder="E-mail" ng-model="profileForm.email_primary">
                                            <div class="text-danger" ng-show="errors.email_primary">{{errors.email_primary}}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>E-mail (alternate)</label>
                                            <input type="email" maxlength="50" class="form-control" placeholder="E-mail" ng-model="profileForm.email_alternate">
                                            <div class="text-danger" ng-show="errors.email_alternate">{{errors.email_alternate}}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Mobile No.(primary)<sup class="text-danger">*</sup></label>
                                            <input type="text" maxlength="15" class="form-control only-numbers" placeholder="Mobile No." ng-model="profileForm.mobile_primary">
                                            <div class="text-danger" ng-show="errors['mobile_primary']">{{errors['mobile_primary']}}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Mobile No.(alternate)</label>
                                            <input type="text" maxlength="15" class="form-control only-numbers" placeholder="Mobile No." ng-model="profileForm.mobile_alternate">
                                            <div class="text-danger" ng-show="errors['mobile_alternate']">{{errors['mobile_alternate']}}</div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-2">
                                            <label>Date of Birth<sup class="text-danger">*</sup></label>
                                            <input type="text" id="dob" class="form-control past-datepicker" ng-init="initializeDatepicker();" placeholder="dd-mmm-yyyy" ng-model="profileForm.dob">
                                            <div class="text-danger" ng-show="errors.dob">{{errors.dob}}</div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>PAN Number<sup class="text-danger">*</sup></label>
                                            <input type="text" maxlength="10" class="form-control" placeholder="PAN Number" ng-model="profileForm.pan_number">
                                            <div class="text-danger" ng-show="errors.pan_number">{{errors.pan_number}}</div>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="form-row">

                                        <div class="form-group col-md-3">
                                            <label>Current company</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Company Name" ng-model="profileForm.current_company">
                                            <div class="text-danger" ng-show="errors.current_company">{{errors.current_company}}</div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Total Experience</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <input type="text" maxlength="2" class="form-control only-numbers" ng-model="profileForm.total_experience_y">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Y</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <input type="text" maxlength="2" class="form-control only-numbers" ng-change="validateMaxExpMonth()" ng-model="profileForm.total_experience_m">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">M</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <input type="text" maxlength="3" class="form-control only-numbers" ng-model="profileForm.total_experience"> -->
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Relevant Experience</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <input type="text" maxlength="2" class="form-control only-numbers" ng-model="profileForm.relevant_experience_y">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Y</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <input type="text" maxlength="2" class="form-control only-numbers" ng-change="validateMaxExpMonth()" ng-model="profileForm.relevant_experience_m">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">M</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <input type="text" maxlength="3" class="form-control only-numbers" ng-model="profileForm.relevant_experience"> -->
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-2">
                                            <label>Notice Period (in Months)</label>
                                            <input type="text" maxlength="2" class="form-control" placeholder="Company Name" ng-model="profileForm.notice_period">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Is notice period negotiable ?</label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" ng-model="profileForm.is_negotiable_np" value="1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" ng-model="profileForm.is_negotiable_np" value="0">
                                                    No
                                                </label>
                                            </div>
                                            <!-- <div>
                                            <label>
                                                <input type="checkbox" ng-model="profileForm.is_negotiable_np" ng-true-value="'1'" ng-false-value="'0'"> {{profileForm.is_negotiable_np=='1'?'Yes':'No'}}
                                            </label>
                                        </div> -->
                                        </div>

                                        <div class="form-group col-md-3" ng-show="profileForm.is_negotiable_np=='1'">
                                            <label>Last working day</label>
                                            <input type="text" class="form-control datepicker" ng-init="initializeDatepicker();" placeholder="dd-mmm-yyyy" ng-model="profileForm.last_working_day">
                                            <div class="text-danger" ng-show="errors['profileForm.last_working_day']">{{errors['employee_other_details.last_working_day']}}</div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Current CTC (in Lakh/annum)</label>
                                            <input type="text" maxlength="10" class="form-control" ng-model="profileForm.ctc">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Expected CTC (in Lakh/annum)</label>
                                            <input type="text" maxlength="10" class="form-control" ng-model="profileForm.expected_ctc">
                                        </div>
                                        <!-- <div class="form-group col-md-2">
                                        <label>Is negotiable expected CTC?</label>
                                        <div>
                                            <label>
                                                <input type="checkbox" ng-model="profileForm.is_negotiable_ctc" ng-true-value="'1'" ng-false-value="'0'"> {{profileForm.is_negotiable_ctc=='1'?'Yes':'No'}}
                                            </label>
                                        </div>
                                    </div> -->

                                    </div>

                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Address</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Present Address</label>
                                            <input type="text" maxlength="200" class="form-control" ng-model="profileForm.present_address">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Postcode</label>
                                            <input type="text" maxlength="6" class="form-control only-numbers" ng-model="profileForm.present_address_postcode">
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Permanent Address</label>
                                            <input type="text" maxlength="200" class="form-control" ng-model="profileForm.permanent_address">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Postcode</label>
                                            <input type="text" maxlength="6" class="form-control only-numbers" ng-model="profileForm.permanent_address_postcode">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Preferred work locations </label>
                                            <div>
                                                <tags-input ng-model="profileForm.preferred_work_locations" use-strings="true" replace-spaces-with-dashes="false"></tags-input>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Skills</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Primary Skills</label>
                                            <a role="button" ng-show="profileForm.primary_skills.length>0" class="btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#primarySkillsRatingModal">Rate Your Skills</a>
                                            <tags-input ng-model="profileForm.primary_skills" on-tag-added="onTagAdded($tag)" replace-spaces-with-dashes="false">
                                                <auto-complete source="loadTags($query)"></auto-complete>
                                            </tags-input>

                                            <!-- <div star-rating rating-value="3" max="5" on-rating-selected="getSelectedRating(rating)"></div> -->

                                        </div>
                                        <div class="form-group col-md-12">

                                            <label>Secondary Skills</label>
                                            <a role="button" ng-show="profileForm.secondary_skills.length>0" class="btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#secondarySkillsRatingModal">Rate Your Skills</a>
                                            <tags-input ng-model="profileForm.secondary_skills" on-tag-added="onTagAdded($tag)" replace-spaces-with-dashes="false">
                                                <auto-complete source="loadTags($query)"></auto-complete>
                                            </tags-input>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Foundation Skills</label>
                                            <a role="button" ng-show="profileForm.foundation_skills.length>0" class="btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#foundationSkillsRatingModal">Rate Your Skills</a>
                                            <tags-input ng-model="profileForm.foundation_skills" on-tag-added="onTagAdded($tag)" replace-spaces-with-dashes="false">
                                                <auto-complete source="loadTags($query)"></auto-complete>
                                            </tags-input>
                                        </div>
                                    </div>

                                </fieldset>


                                <button type="button" class="btn btn-primary" ng-click="submitForm('save-employee-details','#educationalQualifications')">
                                    <div ng-show="loading" class="css-animated-loader"></div>Save
                                </button>
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
                                                        <div class="text-danger" ng-show="errors['education_qualification.'+$index+'.document_path']">{{errors['education_qualification.'+$index+'.document_path']}}</div>
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
                                                            <a role="button" class="fa fa-edit text-primary" ng-click="edit_e_qualification($index)" title="Edit" data-toggle="modal" data-target="#educationalQualification"></a>
                                                            <a href="<?= base_url('uploaded-documents') ?>/{{qualification.document_path}}" title="Download document" target="_blank" ng-show="qualification.document_path" class="fa fa-download text-success"></a>
                                                            <a role="button" class="fa fa-trash text-danger" ng-click="remove_e_qualification($index)" title="Remove"></a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="8">
                                                        <a role="button" class="text-primary" ng-click="addEducationQualification()" data-toggle="modal" data-target="#educationalQualification"> <i class="fa fa-plus"></i> Add</a>
                                                    </td>
                                                </tr>

                                            </tfoot>
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
                                                        <a role="button" class="fa fa-edit text-primary" ng-click="edit_p_qualification($index)" title="Edit" data-toggle="modal" data-target="#professionalQualification"></a>
                                                        <a href="<?= base_url('uploaded-documents') ?>/{{qualification.document_path}}" title="Download document" target="_blank" ng-show="qualification.document_path" class="fa fa-download text-success"></a>

                                                        <a role="button" class="fa fa-trash text-danger" title="Remove" ng-click="remove_p_qualification($index)"></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">
                                                        <a role="button" class="text-primary" ng-click="addProfetionalQualification()" data-toggle="modal" data-target="#professionalQualification"> <i class="fa fa-plus"></i> Add</a>
                                                    </td>
                                                </tr>

                                            </tfoot>
                                        </table>
                                    </fieldset>
                                    <!-- <button type="button" class="btn btn-primary" ng-click="submitForm('save-education-details','#professionalQualifications')">
                                    <div ng-show="loading" class="css-animated-loader"></div>Save
                                </button> -->
                                </form>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="employmentHistory" role="tabpanel" aria-labelledby="employmentHistory-tab">
                            <div>
                                <p> Starting with your <b>most recent employer</b> please give details of your complete employment history since you left full time education. Include any periods of self-employment, unemployment, maternity leave or <b>military service.</b> Include all part time and temporary employment and provide details of both the agencies and placements. Under ‘position held’ state clearly if you were a partner or had an ownership interest in any of the employing companies, or if the position was part time. If you are aware that one of your employers has changed its trading name, please provide the former name first, followed by the new name.</p>
                            </div>
                            <div class="table-responsive">
                                <form class="">


                                    <fieldset class="form-group p-3 animation" ng-repeat="employer in profileForm.employment_history.employers">
                                        <legend class="w-auto px-2">Employer {{$index+1}}</legend>
                                        <a role="button" class="remove-btn fa fa-times text-default" ng-click="remove_employer($index)" title="Remove"></a>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Company<sup class="text-danger">*</sup></label>
                                                <input type="text" maxlength="50" class="form-control" placeholder="Company" ng-model="profileForm.employment_history.employers[$index].company">
                                                <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.company']">{{errors['employment_history.employers.'+$index+'.company']}}</div>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label>From Date</label>
                                                <input type="text" class="form-control month-year-picker" ng-init="initializeMonthYear();" placeholder="MMM-YYYY" ng-model="profileForm.employment_history.employers[$index].from_date">
                                                <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.from_date']">{{errors['employment_history.employers.'+$index+'.from_date']}}</div>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label>To Date</label>
                                                <input type="text" class="form-control month-year-picker" ng-init="initializeMonthYear();" placeholder="MMM-YYYY" ng-model="profileForm.employment_history.employers[$index].to_date">
                                                <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.to_date']">{{errors['employment_history.employers.'+$index+'.to_date']}}</div>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Position held</label>
                                                <input type="text" maxlength="50" class="form-control" placeholder="Position held" ng-model="profileForm.employment_history.employers[$index].position_held">
                                                <div class="text-danger" ng-show="employment_history_errors.position_held">{{employment_history_errors.position_held}}</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Main Job Responsibilities</label>
                                                <input type="text" maxlength="50" class="form-control" placeholder="Job Responsibilities" ng-model="profileForm.employment_history.employers[$index].job_responsibilities">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Company Address</label>
                                                <input type="text" maxlength="50" class="form-control" placeholder="Address" ng-model="profileForm.employment_history.employers[$index].address">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>City</label>
                                                <input type="text" maxlength="50" class="form-control" placeholder="City" ng-model="profileForm.employment_history.employers[$index].city">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="form-group p-3">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <a role="button" class="text-primary" ng-click="addEmployer()"> <i class="fa fa-plus"></i> Add Employer</a>
                                            </div>
                                        </div>

                                    </fieldset>


                                    <button type="button" class="btn btn-primary" ng-click="submitForm('save-employment-history','#backgroundInfo')">
                                        <div ng-show="loading" class="css-animated-loader"></div>Save
                                    </button>

                                </form>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="uploadDocuments" role="tabpanel" aria-labelledby="uploadDocuments-tab">
                            <form class="">
                                <fieldset class="form-group p-3">
                                    <!-- <legend class="w-auto px-2">Select Documents</legend> -->
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="">Select Document</label>
                                            <select ng-model="documentName" class="form-control" ng-init="documentName=''">
                                                <option value="">Select</option>
                                                <option value="{{key}}" ng-repeat="(key,document) in documentNameList">{{document}}</option>
                                            </select>
                                        </div>

                                        <div ng-hide="documentName==''" class="col-sm-6">
                                            <label for="">&nbsp;</label>
                                            <input type="file" id="customFile" file-input="document" class="form-control" ngf-select>

                                            <div class="text-danger" ng-show="errors.document">{{errors.document}}</div>
                                        </div>
                                        <div ng-hide="documentName==''" class="col-sm-2">
                                            <label for="">&nbsp;</label>
                                            <div><a ng-click="uploadDocument()" class="btn btn-primary">
                                                    <div ng-show="loading" class="css-animated-loader"></div> Upload
                                                </a> </div>
                                        </div>


                                        <div class="col-md-12" ng-show="errors">
                                            <ol class="text-danger">
                                                <li ng-show="errors['documents.aadhar_card']">{{errors['documents.aadhar_card']}}</li>
                                                <li ng-show="errors['documents.cheque']">{{errors['documents.cheque']}}</li>
                                                <li ng-show="errors['documents.pan_card']">{{errors['documents.pan_card']}}</li>
                                            </ol>
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Uploaded Documents</legend>

                                    <ol ng-show="profileForm">
                                        <li class="animation" ng-repeat="(key,document) in profileForm.documents">

                                            <a href="<?= base_url('uploaded-documents') ?>/{{document.path}}" target="_blank">{{getDocumentFullname(key)}}</a>
                                            <a class="fa fa-trash text-danger ml-2" role="button" ng-click="removeDocument(key)" title="Remove"></a>
                                        </li>
                                    </ol>



                                    <div class="text-center" ng-show="documentList.length=='0'">
                                        <p>Documents not available.</p>
                                    </div>
                                </fieldset>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="educationalQualification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Educational Qualification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>Degree / Course<sup class="text-danger">*</sup></label>
                                    <input type="text" maxlength="30" class="form-control" ng-model="e_qualification.degree">
                                    <div class="text-danger" ng-show="errors.degree">{{errors.degree}}</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Course Title along with Board / University<sup class="text-danger">*</sup></label>
                                    <input type="text" maxlength="30" class="form-control" ng-model="e_qualification.university">
                                    <div class="text-danger" ng-show="errors.university">{{errors.university}}</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Name and full address of school/Institution<sup class="text-danger">*</sup></label>
                                    <input type="text" maxlength="100" class="form-control" ng-model="e_qualification.institution">
                                    <div class="text-danger" ng-show="errors.institution">{{errors.institution}}</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>From (MM-YYYY)<sup class="text-danger">*</sup></label>
                                    <input type="text" maxlength="8" class="form-control month-year-picker" placeholder="MMM-YYYY" ng-init="initializeMonthYear();" ng-model="e_qualification.from_date">
                                    <div class="text-danger" ng-show="errors.from_date">{{errors.from_date}}</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>To (MM-YYYY)<sup class="text-danger">*</sup></label>
                                    <input type="text" maxlength="8" class="form-control month-year-picker" placeholder="MMM-YYYY" ng-init="initializeMonthYear();" ng-model="e_qualification.to_date">
                                    <div class="text-danger" ng-show="errors.to_date">{{errors.to_date}}</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Percentage / CGPA<sup class="text-danger">*</sup></label>
                                    <input type="text" maxlength="3" class="form-control" ng-model="e_qualification.percentage">
                                    <div class="text-danger" ng-show="errors.percentage">{{errors.percentage}}</div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Full time / Part Time/ off campus / Open Univ.<sup class="text-danger">*</sup></label>
                                    <input type="text" maxlength="20" class="form-control" ng-model="e_qualification.course_type">
                                    <div class="text-danger" ng-show="errors.course_type">{{errors.course_type}}</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Certificate</label>
                                    <input type="file" id="edudocument" file-input="edudocument" class="form-control" ngf-select>
                                    <div class="text-danger" ng-show="errors.edudocument">{{errors.edudocument}}</div>
                                </div>

                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" ng-click="saveEducationQualification()" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="professionalQualification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Professional Qualification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form>
                            <div class="form-group">
                                <label>Qualification / Body / Institute / Licence<sup class="text-danger">*</sup></label>
                                <input type="text" maxlength="30" class="form-control" ng-model="p_qualification.qualification">
                                <div class="text-danger" ng-show="errors.qualification">{{errors.qualification}}</div>
                            </div>

                            <div class="form-group">
                                <label>Category / Membership level<sup class="text-danger">*</sup></label>
                                <input type="text" maxlength="30" class="form-control" ng-model="p_qualification.category">
                                <div class="text-danger" ng-show="errors.category">{{errors.category}}</div>
                            </div>

                            <div class="form-group">
                                <label>Dates (MM-YYYY)<sup class="text-danger">*</sup></label>
                                <input type="text" maxlength="8" placeholder="MMM-YYYY" class="form-control month-year-picker" ng-init="initializeMonthYear();" ng-model="p_qualification.date">
                                <div class="text-danger" ng-show="errors.date">{{errors.date}}</div>
                            </div>


                            <div class="form-group">
                                <label>Certificate</label>
                                <input type="file" id="professionalDocument" file-input="professionalDocument" class="form-control" ngf-select>
                                <div class="text-danger" ng-show="errors.professionalDocument">{{errors.professionalDocument}}</div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" ng-click="saveProfessionalQualification()" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="primarySkillsRatingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Rate Your Primary Skills</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Skill</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="skill in profileForm.primary_skills">
                                    <td style="vertical-align: middle;">{{skill.text}}</td>
                                    <td>
                                        <div class="rating">
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_10" value="10" ng-true-value="10"> <label class="form-check-label" for="rating_{{$index}}_10">10</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_9" value="9" ng-true-value="9"> <label class="form-check-label" for="rating_{{$index}}_9">9</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_8" value="8" ng-true-value="8"> <label class="form-check-label" for="rating_{{$index}}_8">8</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_7" value="7" ng-true-value="7"> <label class="form-check-label" for="rating_{{$index}}_7">7</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_6" value="6" ng-true-value="6"> <label class="form-check-label" for="rating_{{$index}}_6">6</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_5" value="5" ng-true-value="5"> <label class="form-check-label" for="rating_{{$index}}_5">5</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_4" value="4" ng-true-value="4"> <label class="form-check-label" for="rating_{{$index}}_4">4</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_3" value="3" ng-true-value="3"> <label class="form-check-label" for="rating_{{$index}}_3">3</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_2" value="2" ng-true-value="2"> <label class="form-check-label" for="rating_{{$index}}_2">2</label>
                                            <input type="radio" ng-model="skill.rating" id="rating_{{$index}}_1" value="1" ng-true-value="1"> <label class="form-check-label" for="rating_{{$index}}_1">1</label>
                                        </div>
                                        <!-- <input type="range" min="1" max="10" ng-model="skill.rating" class="slider"> <span>{{skill.rating}}</span> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="secondarySkillsRatingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Rate Your Secondary Skills</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Skill</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="skill in profileForm.secondary_skills">
                                    <td style="vertical-align: middle;">{{skill.text}}</td>
                                    <td>
                                        <div class="rating">
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_10" value="10" ng-true-value="10"> <label class="form-check-label" for="sk_rating_{{$index}}_10">10</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_9" value="9" ng-true-value="9"> <label class="form-check-label" for="sk_rating_{{$index}}_9">9</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_8" value="8" ng-true-value="8"> <label class="form-check-label" for="sk_rating_{{$index}}_8">8</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_7" value="7" ng-true-value="7"> <label class="form-check-label" for="sk_rating_{{$index}}_7">7</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_6" value="6" ng-true-value="6"> <label class="form-check-label" for="sk_rating_{{$index}}_6">6</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_5" value="5" ng-true-value="5"> <label class="form-check-label" for="sk_rating_{{$index}}_5">5</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_4" value="4" ng-true-value="4"> <label class="form-check-label" for="sk_rating_{{$index}}_4">4</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_3" value="3" ng-true-value="3"> <label class="form-check-label" for="sk_rating_{{$index}}_3">3</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_2" value="2" ng-true-value="2"> <label class="form-check-label" for="sk_rating_{{$index}}_2">2</label>
                                            <input type="radio" ng-model="skill.rating" id="sk_rating_{{$index}}_1" value="1" ng-true-value="1"> <label class="form-check-label" for="sk_rating_{{$index}}_1">1</label>
                                        </div>
                                        <!-- <input type="range" min="1" max="10" ng-model="skill.rating" class="slider"> <span>{{skill.rating}}</span> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="foundationSkillsRatingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Rate Your Foundation Skills</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Skill</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="skill in profileForm.foundation_skills">
                                    <td style="vertical-align: middle;">{{skill.text}}</td>
                                    <td>
                                        <div class="rating">
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_10" value="10" ng-true-value="10"> <label class="form-check-label" for="fk_rating_{{$index}}_10">10</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_9" value="9" ng-true-value="9"> <label class="form-check-label" for="fk_rating_{{$index}}_9">9</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_8" value="8" ng-true-value="8"> <label class="form-check-label" for="fk_rating_{{$index}}_8">8</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_7" value="7" ng-true-value="7"> <label class="form-check-label" for="fk_rating_{{$index}}_7">7</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_6" value="6" ng-true-value="6"> <label class="form-check-label" for="fk_rating_{{$index}}_6">6</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_5" value="5" ng-true-value="5"> <label class="form-check-label" for="fk_rating_{{$index}}_5">5</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_4" value="4" ng-true-value="4"> <label class="form-check-label" for="fk_rating_{{$index}}_4">4</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_3" value="3" ng-true-value="3"> <label class="form-check-label" for="fk_rating_{{$index}}_3">3</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_2" value="2" ng-true-value="2"> <label class="form-check-label" for="fk_rating_{{$index}}_2">2</label>
                                            <input type="radio" ng-model="skill.rating" id="fk_rating_{{$index}}_1" value="1" ng-true-value="1"> <label class="form-check-label" for="fk_rating_{{$index}}_1">1</label>
                                        </div>
                                        <!-- <input type="range" min="1" max="10" ng-model="skill.rating" class="slider"> <span>{{skill.rating}}</span> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    </section>
</div>



<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<script>
    app.controller('profileFormCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {

        $scope.editMode = false;
        $scope.loading = false;
        $scope.errors = '';
        $scope.successMessage = '';
        $scope.formData = {};
        $scope.profileForm = {
            employment_history: null
        };
        $scope.e_qualification = {};
        $scope.p_qualification = {};
        $scope.gap_declaration = {};
        $scope.mediclaim = {};
        $scope.formComlpletion = 0;
        //$scope.profileForm.education_qualification = new Array();

        $scope.documentNameList = {
            cv: "Curriculum vitae",
            aadhar_card: "Aadhar Card",
            pan_card: "PAN Card",
        }

        $scope.getDocumentFullname = function(key) {
            return $scope.documentNameList[key];
        }

        $scope.validateMaxExpMonth = function() {

            if ($scope.profileForm.total_experience_m < 0) {
                $scope.profileForm.total_experience_m = 0;
            }
            if ($scope.profileForm.total_experience_m > 11) {
                $scope.profileForm.total_experience_m = 11;
            }
            if ($scope.profileForm.relevant_experience_m < 0) {
                $scope.profileForm.relevant_experience_m = 0;
            }
            if ($scope.profileForm.relevant_experience_m > 11) {
                $scope.profileForm.relevant_experience_m = 11;
            }



        }

        $scope.initializeDatepicker = function() {
            $('.past-datepicker').datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false,
                maxDate: new Date(),
                // onSelectDate: function() {
                //   $scope.profileForm.dob = $(el).val()
                // }
            });

            $('.datepicker').datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false,
                // onSelectDate: function() {
                //   $scope.profileForm.dob = $(el).val()
                // }
            });
        }

        $scope.initializeMonthYear = function() {

            $('.month-year-picker').datetimepicker({
                format: 'M Y',
                scrollInput: false,
                timepicker: false,
                maxDate: new Date(),
                validateOnBlur: false,
                // onSelectDate: function(el,obj) {
                //   $scope.profileForm.dob = $('').val()

                // console.log(obj);
                // console.log(obj[0].name);
                // console.log(obj[0].dataset.rowindex);
                // if(obj[0].name=='eqFromDate'){
                //     $scope.profileForm.education_qualification[obj[0].dataset.rowindex].from_date = obj[0].value;
                // }
                // if(obj[0].name=='eqToDate'){
                //     $scope.profileForm.education_qualification[obj[0].dataset.rowindex].to_date = obj[0].value;
                // }


                // },
                // onClose: function (value,obj) {
                //     console.log(value);
                //     this.setOptions({
                //     value:value
                //     });
                // },
            });
        }


        $http({
            method: 'get',
            url: base_url + '/api/my-profile',
        }).then(function(response) {
            $scope.profileForm = response.data.profileDetails;
            console.log(response);
        }, function(response) {
            if (response.data.status == 403) {
                toastr.error(response.data.messages.errorMessage);
            } else {
                toastr.error("Something went wrong !!");
            }

        });

        $scope.addEducationQualification = function() {

            $scope.e_qualification = {
                "id": "",
                "profile_id": $scope.profileForm.id,
                "degree": "",
                "university": "",
                "institution": "",
                "from_date": "",
                "to_date": "",
                "course_type": "",
                "percentage": "",
                "document_path": ""
            };
            $('#edudocument').val('');
            $scope.edudocument = null;
            $scope.errors = '';
        }
        $scope.edit_e_qualification = function(index) {

            $scope.e_qualification = angular.copy($scope.profileForm.education_qualification[index]);
            $scope.errors = '';
        }
        $scope.saveEducationQualification = function() {
            console.log($scope.e_qualification);
            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;
            $scope.successMessage = '';
            // console.log($scope.profile);
            var apiUrl = base_url + '/api/my-profile/save-education-details';
            var method = "POST";
            // console.log($scope.profileForm);
            $http({
                method: method,
                url: apiUrl,
                headers: {
                    'Content-Type': undefined
                },

                transformRequest: function(data) {
                    var formData = new FormData();

                    formData.append("requestData", angular.toJson(data.model));
                    // for (var i = 0; i < data.files.length; i++) {
                    //     formData.append("photo" + i, data.files[i]);
                    // }
                    angular.forEach(data.document, function(file) {
                        formData.append('edudocument', file);
                    });
                    return formData;
                },
                data: {
                    model: $scope.e_qualification,
                    document: $scope.edudocument
                },
                // data: $scope.profileForm
            }).then(function(response) {
                $scope.addEducationQualification();
                $scope.editMode = false;
                $scope.loading = false;
                $scope.profileForm.education_qualification = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    // toastr.error("Please fill all the fileds."); 
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.remove_e_qualification = function(index) {
            if (!confirm("Are you sure?")) {
                return;
            }
            // $scope.profileForm.education_qualification.splice(index, 1);
            var apiUrl = base_url + '/api/my-profile/remove-education-details';
            var method = "POST";
            var id = $scope.profileForm.education_qualification[index].id;
            // console.log($scope.profileForm);
            $http({
                method: method,
                url: apiUrl,
                data: {
                    id: id,
                },
                // data: $scope.profileForm
            }).then(function(response) {

                $scope.loading = false;
                $scope.profileForm.education_qualification = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    toastr.error("Something went wrong !!");
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });

        }

        $scope.addProfetionalQualification = function() {


            $scope.p_qualification = {
                "id": "",
                "profile_id": $scope.profileForm.id,
                "qualification": "",
                "category": "",
                "date": "",
                "document_path": ""
            };
            $('#professionalDocument').val('');
            $scope.professionalDocument = null;
            $scope.errors = '';
        }

        $scope.saveProfessionalQualification = function() {
            // console.log($scope.e_qualification);
            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;
            $scope.successMessage = '';
            // console.log($scope.profile);
            var apiUrl = base_url + '/api/my-profile/save-professional-qualification';
            var method = "POST";
            // console.log($scope.profileForm);
            $http({
                method: method,
                url: apiUrl,
                headers: {
                    'Content-Type': undefined
                },

                transformRequest: function(data) {
                    var formData = new FormData();

                    formData.append("requestData", angular.toJson(data.model));
                    // for (var i = 0; i < data.files.length; i++) {
                    //     formData.append("photo" + i, data.files[i]);
                    // }
                    angular.forEach(data.document, function(file) {
                        formData.append('professionalDocument', file);
                    });
                    return formData;
                },
                data: {
                    model: $scope.p_qualification,
                    document: $scope.professionalDocument
                },
                // data: $scope.profileForm
            }).then(function(response) {
                $scope.addProfetionalQualification();
                $scope.editMode = false;
                $scope.loading = false;
                $scope.profileForm.professional_qualification = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    // toastr.error("Something went wrong !!"); 
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.edit_p_qualification = function(index) {

            $scope.p_qualification = angular.copy($scope.profileForm.professional_qualification[index]);
            $scope.errors = '';
        }

        $scope.remove_p_qualification = function(index) {
            // $scope.profileForm.professional_qualification.splice(index, 1);
            if (!confirm("Are you sure?")) {
                return;
            }
            // $scope.profileForm.education_qualification.splice(index, 1);
            var apiUrl = base_url + '/api/my-profile/remove-professional-qualification';
            var method = "POST";
            var id = $scope.profileForm.professional_qualification[index].id;
            // console.log($scope.profileForm);
            $http({
                method: method,
                url: apiUrl,
                data: {
                    id: id,
                },
                // data: $scope.profileForm
            }).then(function(response) {

                $scope.loading = false;
                $scope.profileForm.professional_qualification = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    toastr.error("Something went wrong !!");
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.addEmploymentSummary = function() {

            $scope.profileForm.employment_history.employment_summary.push({
                "date_from": "",
                "date_to": "",
                "company": "",
                "reason_for_leaving": "",
                "gap": "",
            });
        }
        $scope.remove_employment_summary = function(index) {
            $scope.profileForm.employment_history.employment_summary.splice(index, 1);
        }

        $scope.addEmployer = function() {

            if (!('employers' in $scope.profileForm.employment_history)) {
                $scope.profileForm.employment_history.employers = [];

            }

            $scope.profileForm.employment_history.employers.push({
                'position_held': '',
                'from_date': '',
                'to_date': '',
                'company': '',
                'department': '',
                'nature_of_job': '',
                'address': '',
                'city': '',
                'telephone': '',
                'job_responsibilities': '',
                'annual_ctc': '',
                'reporting_manager': '',
                'contact_number_manager': '',
                'email_manager': '',
                'reason_of_leaving': '',
                'hr_name': '',
                'hr_contact_number': '',
                'hr_email': '',
                'hr_designation': '',
            });
        }
        $scope.remove_employer = function(index) {
            $scope.profileForm.employment_history.employers.splice(index, 1);
        }





        $scope.submitForm = function(formType, nextTab = '', reload = false) {

            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;
            $scope.successMessage = '';
            // console.log($scope.profile);
            var apiUrl = base_url + '/api/my-profile/' + formType;
            var method = "POST";
            // console.log($scope.profileForm);
            $http({
                method: method,
                url: apiUrl,
                data: $scope.profileForm
            }).then(function(response) {
                $scope.editMode = false;
                $scope.loading = false;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);
                if (nextTab != '') {
                    $('#myTab a[href="' + nextTab + '"]').tab('show');
                }
                if (reload) {
                    window.location.reload();
                }

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                if (response.data.status == 403) {

                    if (!!response.data.messages.redirectUrl) {
                        window.location.href = response.data.messages.redirectUrl;
                    }
                    if (response.data.messages.errorMessage != '') {
                        toastr.error(response.data.messages.errorMessage);
                    }

                } else {
                    toastr.error("Please fill all the required information.");
                }

                var errorTab;
                if ($scope.errors.employeeDetailsTab) {
                    errorTab = "#employeeDetails";
                } else if ($scope.errors.educationalQualificationsTab) {
                    errorTab = "#educationalQualifications";
                } else if ($scope.errors.employmentHistoryTab) {
                    errorTab = "#employmentHistory";
                } else if ($scope.errors.backgroundInfoTab) {
                    errorTab = "#backgroundInfo";
                } else if ($scope.errors.uploadDocumentsTab) {
                    errorTab = "#uploadDocuments";
                } else if ($scope.errors.declarationTab) {
                    errorTab = "#declaration";
                }
                console.log(errorTab);
                if (errorTab != '') {
                    $('#myTab a[href="' + errorTab + '"]').tab('show');
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });

        }



        $scope.uploadDocument = function() {

            $scope.errors = '';
            $scope.loading = true;
            var apiUrl = base_url + '/api/my-profile/documents';
            $http({
                    method: 'POST',
                    url: apiUrl,
                    headers: {
                        'Content-Type': undefined
                    },

                    transformRequest: function(data) {
                        var formData = new FormData();
                        formData.append("id", $scope.profileForm.id);
                        formData.append("documentName", $scope.documentName);
                        // for (var i = 0; i < data.files.length; i++) {  
                        //     formData.append("file" + i, data.files[i]);  
                        // }  
                        angular.forEach(data.document, function(file) {
                            formData.append('document', file);
                        });
                        return formData;
                    },
                    data: {
                        // model: $scope.formData,
                        document: $scope.document
                    }
                })
                .then(function(response) {
                    $scope.editMode = false;
                    $scope.loading = false;
                    $scope.profileForm.documents = response.data.documentList;
                    $scope.documentName = '';
                    $('#customFile').val('');
                    toastr.success(response.data.messages.success);
                    // $scope.formData = {};
                    // window.location = base_url + '/admin/categories';
                }, function(response) {

                    if (response.data.status == 403) {
                        toastr.error(response.data.messages.errorMessage);
                    } else {
                        // toastr.error("Something went wrong !!"); 
                    }

                    $scope.loading = false;
                    $scope.errors = response.data.messages;

                });
        }

        $scope.removeDocument = function(documentName) {
            if (!confirm('Do you want to remove this document?')) {
                return;
            }
            $scope.errors = '';
            $scope.loading = true;
            var apiUrl = base_url + '/api/my-profile/remove-document';
            $http({
                    method: 'POST',
                    url: apiUrl,
                    data: {
                        // model: $scope.formData,
                        document: documentName,
                        id: $scope.profileForm.id
                    }
                })
                .then(function(response) {
                    $scope.editMode = false;
                    $scope.loading = false;
                    $scope.profileForm.documents = response.data.documentList;
                    $scope.successMessage = response.data.messages.success;
                    toastr.success(response.data.messages.success);
                    // $scope.formData = {};
                    // window.location = base_url + '/admin/categories';
                }, function(response) {

                    if (response.data.status == 403) {
                        toastr.error(response.data.messages.errorMessage);
                    } else {
                        // toastr.error("Something went wrong !!"); 
                    }

                    $scope.loading = false;
                    $scope.errors = response.data.messages;

                });
        }


        $scope.loadTags = function(query) {
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

    }]);
</script>
<?= $this->endSection() ?>