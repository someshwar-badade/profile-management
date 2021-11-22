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
<section ng-cloak class="abutsSection clearfix" ng-controller="joiningFormCtrl">
    <div class="container-fluid mt-5">
        <?php if (!$showTitle) { ?>
            <div class="row justify-content-center">
                <h2>Joining Form ()</h2>
            </div>
        <?php } ?>
        <div class="row mt-5">


            <div class="col-md-12">
                Form Completed:
                <div class="progress">
                    <div class="progress-bar bg-success" ng-style="{'width':formComlpletion+'%'}">{{formComlpletion}}%</div>
                </div>
                <p>Please complete the form in <strong>BLOCK CAPITALS</strong> as fully as possible using sign. No section should be left blank. The information you provide in this form will be subject to verification by the company.</p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="employeeDetails-tab" data-toggle="tab" href="#employeeDetails" role="tab" aria-controls="employeeDetails" aria-selected="true">Employee Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="educationalQualifications-tab" data-toggle="tab" href="#educationalQualifications" role="tab" aria-controls="educationalQualifications" aria-selected="false">Educational Qualifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="employmentHistory-tab" data-toggle="tab" href="#employmentHistory" role="tab" aria-controls="employmentHistory" aria-selected="false">Employment History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="backgroundInfo-tab" data-toggle="tab" href="#backgroundInfo" role="tab" aria-controls="backgroundInfo" aria-selected="false">Background Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="uploadDocuments-tab" data-toggle="tab" href="#uploadDocuments" role="tab" aria-controls="uploadDocuments" aria-selected="false">Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="declaration-tab" data-toggle="tab" href="#declaration" role="tab" aria-controls="declaration" aria-selected="false">Declaration & Authorization</a>
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
                                        <input type="text" maxlength="50" class="form-control" placeholder="First Name" ng-model="joiningForm.first_name">
                                        <div class="text-danger" ng-show="errors.first_name">{{errors.first_name}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Last Name<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Last Name" ng-model="joiningForm.last_name">
                                        <div class="text-danger" ng-show="errors.last_name">{{errors.last_name}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Father's Name</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Father's Name" ng-model="joiningForm.father_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Mother's Name</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Mother's Name" ng-model="joiningForm.mother_name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Gender<sup class="text-danger">*</sup></label>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="gender1" name="gender" value="Male" ng-model="joiningForm.employee_other_details.gender" class="custom-control-input">
                                                <label class="custom-control-label" for="gender1">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="gender2" name="gender" value="Female" ng-model="joiningForm.employee_other_details.gender" class="custom-control-input">
                                                <label class="custom-control-label" for="gender2">Female</label>
                                            </div>
                                            <div class="text-danger" ng-show="errors['employee_other_details.gender']">{{errors['employee_other_details.gender']}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Marital Status<sup class="text-danger">*</sup></label>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="marital_status" value="Married" ng-model="joiningForm.employee_other_details.marital_status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Married</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="marital_status" value="Single" ng-model="joiningForm.employee_other_details.marital_status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">Single</label>
                                            </div>
                                            <div class="text-danger" ng-show="errors['employee_other_details.marital_status']">{{errors['employee_other_details.marital_status']}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Spouse's Name</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Spouse's Name" ng-model="joiningForm.spouse_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kid(s) Name</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Kid(s) Name" ng-model="joiningForm.kids_name">
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-2">
                                        <label>Date of Birth<sup class="text-danger">*</sup></label>
                                        <input type="text" id="dob" class="form-control past-datepicker" ng-init="initializeDatepicker();" placeholder="Date of Birth" ng-model="joiningForm.dob">
                                        <div class="text-danger" ng-show="errors.dob">{{errors.dob}}</div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Place of Birth</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Place of Birth" ng-model="joiningForm.place_of_birth">

                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Nationality (both, if dual national)</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Indian" ng-model="joiningForm.nationality">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Blood Group<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="5" class="form-control" placeholder="Blood Group" ng-model="joiningForm.employee_other_details.blood_group">
                                        <div class="text-danger" ng-show="errors['employee_other_details.blood_group']">{{errors['employee_other_details.blood_group']}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Medical conditions, if any</label>
                                        <input type="text" maxlength="50" class="form-control" ng-model="joiningForm.employee_other_details.medical_condition">
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-3">
                                        <label>PAN Number<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="10" class="form-control" placeholder="PAN Number" ng-model="joiningForm.pan_number">
                                        <div class="text-danger" ng-show="errors.pan_number">{{errors.pan_number}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Aadhar Number<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="12" class="form-control" placeholder="Aadhar Number" ng-model="joiningForm.aadhar_number">
                                        <div class="text-danger" ng-show="errors.aadhar_number">{{errors.aadhar_number}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>UAN Number</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="UAN Number" ng-model="joiningForm.employee_other_details.uan_number">
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-3">
                                        <label>Total Experience(Years)</label>
                                        <input type="text" maxlength="3" class="form-control" ng-model="joiningForm.employee_other_details.total_experience">

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Type of employment with BitString</label>
                                        <select ng-model="joiningForm.employee_other_details.nature_of_job_hired" ng-init="joiningForm.employee_other_details.nature_of_job_hired=''" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Contract">Contract</option>

                                        </select>

                                    </div>

                                </div>



                            </fieldset>

                            <fieldset class="form-group p-3">
                                <legend class="w-auto px-2">Contact details</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Email (primary)<sup class="text-danger">*</sup></label>
                                        <input type="email" maxlength="50" class="form-control" placeholder="Email" ng-model="joiningForm.email_primary">
                                        <div class="text-danger" ng-show="errors.email_primary">{{errors.email_primary}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Mobile<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="15" class="form-control" placeholder="Mobile" ng-model="joiningForm.mobile_primary">
                                        <div class="text-danger" ng-show="errors['mobile_primary']">{{errors['mobile_primary']}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Emergency Contact Name and Relation<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Emergency Contact Name" ng-model="joiningForm.employee_other_details.emergency_contact_name">
                                        <div class="text-danger" ng-show="errors['employee_other_details.emergency_contact_name']">{{errors['employee_other_details.emergency_contact_name']}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Emergency Mobile No<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Emergency Mobile No" ng-model="joiningForm.employee_other_details.emergency_contact_mobile">
                                        <div class="text-danger" ng-show="errors['employee_other_details.emergency_contact_mobile']">{{errors['employee_other_details.emergency_contact_mobile']}}</div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group p-3">
                                <legend class="w-auto px-2">Bank details</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Bank Name & Branch<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Bank Name & Branch" ng-model="joiningForm.employee_other_details.bank_name_branch">
                                        <div class="text-danger" ng-show="errors['employee_other_details.bank_name_branch']">{{errors['employee_other_details.bank_name_branch']}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Bank A/c No<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="20" class="form-control" placeholder="Bank A/c No" ng-model="joiningForm.employee_other_details.bank_account_number">
                                        <div class="text-danger" ng-show="errors['employee_other_details.bank_account_number']">{{errors['employee_other_details.bank_account_number']}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>IFS Code<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="11" class="form-control" placeholder="IFS Code" ng-model="joiningForm.employee_other_details.bank_ifsc_code">
                                        <div class="text-danger" ng-show="errors['employee_other_details.bank_ifsc_code']">{{errors['employee_other_details.bank_ifsc_code']}}</div>
                                    </div>
                                </div>

                            </fieldset>

                            <fieldset class="form-group p-3">
                                <legend class="w-auto px-2">Address</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Present Address <sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="300" class="form-control" ng-model="joiningForm.employee_other_details.present_address">
                                        <div class="text-danger" ng-show="errors['employee_other_details.present_address']">{{errors['employee_other_details.present_address']}}</div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Postcode <sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="6" class="form-control" ng-model="joiningForm.employee_other_details.present_address_postcode">
                                        <div class="text-danger" ng-show="errors['employee_other_details.present_address_postcode']">{{errors['employee_other_details.present_address_postcode']}}</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>For how long are you residing at this address (Year/Months)<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="2" class="form-control" ng-model="joiningForm.employee_other_details.present_address_residing_duration">
                                        <div class="text-danger" ng-show="errors['employee_other_details.present_address_residing_duration']">{{errors['employee_other_details.present_address_residing_duration']}}</div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Permanent Address<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="300" class="form-control" ng-model="joiningForm.employee_other_details.permanent_address">
                                        <div class="text-danger" ng-show="errors['employee_other_details.permanent_address']">{{errors['employee_other_details.permanent_address']}}</div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Postcode<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="6" class="form-control" ng-model="joiningForm.employee_other_details.permanent_address_postcode">
                                        <div class="text-danger" ng-show="errors['employee_other_details.permanent_address_postcode']">{{errors['employee_other_details.permanent_address_postcode']}}</div>
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
                                <fieldset class="form-group p-3">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <td><b>Degree / Course</b></td>
                                                <td><b>Course Title along with Board / University</b></td>
                                                <td style="width: 25%;"><b>Name and full address of school/Institution </b></td>
                                                <td><b>From (MM/YYYY)</b></td>
                                                <td><b>To (MM/YYYY)</b></td>
                                                <td><b>Full time / Part Time/ off campus / Open Univ.</b></td>
                                                <td><b>%age/ CGPA</b></td>
                                                <td style="width: 80px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="qualification in joiningForm.education_qualification">
                                                <td>
                                                    {{qualification.degree}}
                                                </td>
                                                <td>
                                                    {{qualification.degree}}
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

                                <fieldset class="form-group p-3">
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
                                                <td><b>Dates (MM/YY)</b></td>
                                                <td style="width: 80px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="qualification in joiningForm.professional_qualification">
                                                <td>
                                                    {{qualification.qualification}}
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
                            <p><b>Please sign an authorization letter to allow us to do a complete background check.</b></p>
                        </div>
                        <div class="table-responsive">
                            <form class="">


                                <fieldset class="form-group p-3 animation" ng-repeat="employer in joiningForm.employment_history.employers">
                                    <legend class="w-auto px-2">Employer {{$index+1}}</legend>
                                    <a role="button" class="remove-btn fa fa-times text-default" ng-click="remove_employer($index)" title="Remove"></a>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Company<sup class="text-danger">*</sup></label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Company" ng-model="joiningForm.employment_history.employers[$index].company">
                                            <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.company']">{{errors['employment_history.employers.'+$index+'.company']}}</div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Department</label>
                                            <input type="text" maxlength="20" class="form-control" placeholder="Department" ng-model="joiningForm.employment_history.employers[$index].department">
                                            <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.department']">{{errors['employment_history.employers.'+$index+'.department']}}</div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Position held</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Position held" ng-model="joiningForm.employment_history.employers[$index].position_held">
                                            <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.position_held']">{{errors['employment_history.employers.'+$index+'.position_held']}}</div>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>From Date</label>
                                            <input type="text" class="form-control month-year-picker" ng-init="initializeMonthYear();" placeholder="From Date" ng-model="joiningForm.employment_history.employers[$index].from_date">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>To Date</label>
                                            <input type="text" class="form-control month-year-picker" ng-init="initializeMonthYear();" placeholder="To Date" ng-model="joiningForm.employment_history.employers[$index].to_date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Nature of Job<sup class="text-danger">*</sup></label>
                                            <input type="text" maxlength="30" class="form-control" placeholder="Nature of Job" ng-model="joiningForm.employment_history.employers[$index].nature_of_job">
                                            <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.nature_of_job']">{{errors['employment_history.employers.'+$index+'.nature_of_job']}}</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Main Job Responsibilities</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Job Responsibilities" ng-model="joiningForm.employment_history.employers[$index].job_responsibilities">
                                        </div>


                                        <div class="form-group col-md-2">
                                            <label>Annual CTC (in Lacs)</label>
                                            <input type="text" maxlength="30" class="form-control" placeholder="Annual CTC" ng-model="joiningForm.employment_history.employers[$index].annual_ctc">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Address</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Address" ng-model="joiningForm.employment_history.employers[$index].address">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>City</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="City" ng-model="joiningForm.employment_history.employers[$index].city">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Telephone</label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="Telephone" ng-model="joiningForm.employment_history.employers[$index].telephone">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Name of Reporting Manager<sup class="text-danger">*</sup></label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Name of Reporting Manager" ng-model="joiningForm.employment_history.employers[$index].reporting_manager">
                                            <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.reporting_manager']">{{errors['employment_history.employers.'+$index+'.reporting_manager']}}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Contact Number<sup class="text-danger">*</sup></label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="Contact Number" ng-model="joiningForm.employment_history.employers[$index].contact_number_manager">
                                            <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.contact_number_manager']">{{errors['employment_history.employers.'+$index+'.contact_number_manager']}}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Email<sup class="text-danger">*</sup></label>
                                            <input type="email" maxlength="50" class="form-control" placeholder="Email" ng-model="joiningForm.employment_history.employers[$index].email_manager">
                                            <div class="text-danger" ng-show="errors['employment_history.employers.'+$index+'.email_manager']">{{errors['employment_history.employers.'+$index+'.email_manager']}}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Reason for Leaving</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Reason for Leaving" ng-model="joiningForm.employment_history.employers[$index].reason_of_leaving">
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>HR Name</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="HR Name" ng-model="joiningForm.employment_history.employers[$index].hr_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>HR Contact Number</label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="HR Contact Number" ng-model="joiningForm.employment_history.employers[$index].hr_contact_number">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>HR Email</label>
                                            <input type="email" maxlength="50" class="form-control" placeholder="HR Email" ng-model="joiningForm.employment_history.employers[$index].hr_email">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>HR Designation</label>
                                            <input type="text" maxlength="20" class="form-control" placeholder="HR Designation" ng-model="joiningForm.employment_history.employers[$index].hr_designation">
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



                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Gap Declaration</legend>
                                    <table class="table table-bordered table-stripped">
                                        <thead>

                                            <tr>

                                                <th><b>Sr. No.</b></th>
                                                <th style="width: 40%;"><b>Particulars (Reason)</b></th>
                                                <th><b>From</b></th>
                                                <th><b>to</b></th>
                                                <td style="width: 80px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="animation" ng-repeat="gap in joiningForm.gap_declaration">
                                                <td>
                                                    {{$index+1}}
                                                </td>
                                                <td>
                                                    {{gap.particular}}
                                                </td>
                                                <td>
                                                    {{gap.from_date}}
                                                </td>
                                                <td>
                                                    {{gap.to_date}}
                                                </td>

                                                <td>
                                                    <a role="button" class="fa fa-edit text-primary" ng-click="edit_gap_declaration($index)" title="Edit" data-toggle="modal" data-target="#gapDeclaration"></a>
                                                    <a href="<?= base_url('uploaded-documents') ?>/{{gap.document_path}}" title="Download document" target="_blank" ng-show="gap.document_path" class="fa fa-download text-success"></a>

                                                    <a role="button" class="fa fa-trash text-danger" ng-click="remove_gap_declartion($index)"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <a role="button" class="text-primary" ng-click="addGapDeclaration()" data-toggle="modal" data-target="#gapDeclaration"> <i class="fa fa-plus"></i> Add</a>
                                                    <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert" ng-show="errors.gap_declaration">{{errors.gap_declaration}}</div>
                                                </td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                    <p>* GAP Declaration to be filed when there is a time gap between two Employments OR between Education and Employment OR between Education and Education.</p>
                                    <p>* Any gap of more than 3 months to be filled in with complete details and supporting documents.</p>
                                </fieldset>

                                <button type="button" class="btn btn-primary" ng-click="submitForm('save-employment-history','#backgroundInfo')">
                                    <div ng-show="loading" class="css-animated-loader"></div>Save
                                </button>

                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="backgroundInfo" role="tabpanel" aria-labelledby="backgroundInfo-tab">
                        <div class="table-responsive">
                            <form class="">
                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Criminal and Civil Record</legend>
                                    <div class="form-row">
                                        <table class="table table-bordered">
                                            <colgroup>
                                                <col>
                                                <col style="width: 90%;">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C01" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C01?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C01') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C02" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C02?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C02') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C03" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C03?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C03') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C04" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C04?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C04') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C05" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C05?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C05') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C06" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C06?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C06') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C07" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C07?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C07') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C08" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C08?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C08') ?>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Business Interests</legend>
                                    <div class="form-row">
                                        <table class="table table-bordered">
                                            <colgroup>
                                                <col>
                                                <col style="width: 90%;">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.business_interest.B01" value="1"> {{joiningForm.background_info.business_interest.B01?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('B01') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.business_interest.B02" value="1"> {{joiningForm.background_info.business_interest.B02?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('B02') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.business_interest.B03" value="1"> {{joiningForm.background_info.business_interest.B03?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('B03') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.business_interest.B04" value="1"> {{joiningForm.background_info.business_interest.B04?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('B04') ?>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Other actions and disqualifications</legend>
                                    <div class="form-row">
                                        <table class="table table-bordered">
                                            <colgroup>
                                                <col>
                                                <col style="width: 90%;">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.other_disqualification.O01" value="1"> {{joiningForm.background_info.other_disqualification.O01?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('O01') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.other_disqualification.O02" value="1"> {{joiningForm.background_info.other_disqualification.O02?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('O02') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.other_disqualification.O03" value="1"> {{joiningForm.background_info.other_disqualification.O03?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('O03') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.other_disqualification.O04" value="1"> {{joiningForm.background_info.other_disqualification.O04?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('O04') ?>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Previous Addresses</legend>
                                    <p>Please include full personal address history to cover the last 7 years including dates.</p>
                                    <div class="form-row">

                                        <table class="table table-bordered">
                                            <colgroup>
                                                <col style="width: 60%;">
                                                <col>
                                                <col>
                                                <col>
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th>Address</th>
                                                    <th>Postcode</th>
                                                    <th>Dates resident at this address (from and to)</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="p_address in joiningForm.background_info.previous_address">
                                                    <td>
                                                        <input type="text" class="form-control" maxlength="200" ng-model="joiningForm.background_info.previous_address[$index].address">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" maxlength="6" ng-model="joiningForm.background_info.previous_address[$index].postcode">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" maxlength="25" placeholder="Jan 2001 - Dec 2003" ng-model="joiningForm.background_info.previous_address[$index].dates">
                                                    </td>
                                                    <td>
                                                        <a role="button" class="fa fa-trash text-danger" ng-click="remove_p_address($index)"></a>
                                                    </td>
                                                </tr>


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">
                                                        <a role="button" class="text-primary" ng-click="addPreviousAddress()"> <i class="fa fa-plus"></i> Add new line</a>
                                                        <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert" ng-show="errors.previous_address">{{errors.previous_address}}</div>
                                                    </td>
                                                </tr>

                                            </tfoot>
                                        </table>
                                    </div>
                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Mediclaim / Medical Insurance</legend>
                                    <table class="table table-bordered table-stripped">
                                        <thead>

                                            <tr>

                                                <th><b>Name</b></th>
                                                <th><b>Relationship</b></th>
                                                <th><b>Date of Birth</b></th>
                                                <th><b>Age</b></th>
                                                <td style="width: 80px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="person in joiningForm.mediclaim">

                                                <td>
                                                    {{person.name}}
                                                </td>
                                                <td> {{person.relationship}}
                                                </td>
                                                <td> {{person.dob}}
                                                </td>
                                                <td> {{person.age}}
                                                </td>

                                                <td>
                                                    <a role="button" class="fa fa-edit text-primary" ng-click="edit_mediclaim($index)" title="edit" data-toggle="modal" data-target="#mediclaim"></a>
                                                    <a href="<?= base_url('uploaded-documents') ?>/{{person.document_path}}" title="Download document" target="_blank" ng-show="person.document_path" class="fa fa-download text-success"></a>

                                                    <a role="button" class="fa fa-trash text-danger" ng-click="remove_mediclaim($index)"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <a role="button" class="text-primary" ng-click="addMediclaim()" data-toggle="modal" data-target="#mediclaim"> <i class="fa fa-plus"></i> Add new line</a>
                                                </td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                    <p>* Please submit passport size photograph of all the members mentioned above.</p>
                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Employees Close Relatives working with BitString, if any</legend>
                                    <table class="table table-bordered table-stripped">
                                        <thead>

                                            <tr>

                                                <th><b>Name</b></th>
                                                <th><b>Relationship</b></th>
                                                <th><b>Position</b></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="gap in joiningForm.background_info.relative_with_bitstring">

                                                <td>
                                                    <input type="text" class="form-control" maxlength="50" ng-model="joiningForm.background_info.relative_with_bitstring[$index].name">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="20" ng-model="joiningForm.background_info.relative_with_bitstring[$index].relationship">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="20" ng-model="joiningForm.background_info.relative_with_bitstring[$index].position">
                                                </td>


                                                <td>
                                                    <a role="button" class="fa fa-trash text-danger" ng-click="remove_relative_bitstring($index)"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <a role="button" class="text-primary" ng-click="addRelativeBitstring()"> <i class="fa fa-plus"></i> Add new line</a>
                                                    <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert" ng-show="errors.relative_with_bitstring">{{errors.relative_with_bitstring}}</div>
                                                </td>
                                            </tr>


                                        </tfoot>
                                    </table>

                                </fieldset>

                                <button type="button" class="btn btn-primary" ng-click="submitForm('save-background-information','#uploadDocuments')">
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


                                </div>
                            </fieldset>

                            <fieldset class="form-group p-3">
                                <legend class="w-auto px-2">Uploaded Documents</legend>

                                <ol ng-show="documentList">
                                    <li class="animation" ng-repeat="(key,document) in documentList">

                                        <a href="<?= base_url('uploaded-documents') ?>/{{document.path}}" target="_blank">{{getDocumentFullname(key)}}</a>
                                        <a class="fa fa-trash text-danger ml-2" role="button" ng-click="removeDocument(key)" title="Remove"></a>
                                    </li>
                                </ol>
                                <div class="text-center" ng-show="documentList.length=='0'">
                                    <p>Documents not available.</p>
                                </div>
                            </fieldset>

                    </div>

                    <div class="tab-pane fade" id="declaration" role="tabpanel" aria-labelledby="declaration-tab">
                        <div class="table-responsive">
                            <form class="">
                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Data Protection</legend>
                                    <div>
                                        <p>I hereby give my consent to the employer or any agent thereof to process the data supplied in this application form for the purposes of recruitment and selection. I accept that this data may be sent and processed in or outside India.</p>
                                        <p>You have the right to apply for a copy of our information and to have any inaccuracies corrected.</p>

                                    </div>
                                </fieldset>
                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Declaration & Authorization</legend>
                                    <div>
                                        <p>I certify that to the best of my knowledge all the information given in this form is true and complete. I understand that any appointment offered will be subject to the information given on this form being correct. I understand that any offer of employment is conditional upon the verification of any or all of the information I have supplied. I understand and accept that the provision of misleading, false or inaccurate information or the omission of a material fact may be legitimate cause for the immediate withdrawal of any offer of employment or, if I am already employed, for disciplinary action up to and including dismissal.</p>
                                        <p>I authorize BitString IT Services Pvt Ltdor any agent thereof to verify information presented on this form and to make inquiries of the school, college or university where a qualification was gained as well as approach previous employers and personal references for verification of my employment records. I acknowledge that all referees are disclosing the above information at my express request and that I will make no claim whatsoever against such referee, its agents and/or employees arising out of disclosure of such information. This shall be the case whether the content of any such document obtained is accurate or inaccurate and/or any information is true or untrue.</p>

                                    </div>
                                </fieldset>

                                <center>
                                    <button type="button" class="btn btn-primary" ng-click="submitForm('accept-declaration','',true)">
                                        <div ng-show="loading" class="css-animated-loader"></div>Accept and Submit Form
                                    </button>
                                </center>
                            </form>
                        </div>
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
                                <input type="text" class="form-control" ng-model="e_qualification.degree">
                                <div class="text-danger" ng-show="errors.degree">{{errors.degree}}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Course Title along with Board / University<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" ng-model="e_qualification.university">
                                <div class="text-danger" ng-show="errors.university">{{errors.university}}</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Name and full address of school/Institution<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" ng-model="e_qualification.institution">
                                <div class="text-danger" ng-show="errors.institution">{{errors.institution}}</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>From (MM/YYYY)<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control month-year-picker" ng-init="initializeMonthYear();" ng-model="e_qualification.from_date">
                                <div class="text-danger" ng-show="errors.from_date">{{errors.from_date}}</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>To (MM/YYYY)<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control month-year-picker" ng-init="initializeMonthYear();" ng-model="e_qualification.to_date">
                                <div class="text-danger" ng-show="errors.to_date">{{errors.to_date}}</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Percentage / CGPA<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" ng-model="e_qualification.percentage">
                                <div class="text-danger" ng-show="errors.percentage">{{errors.percentage}}</div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Full time / Part Time/ off campus / Open Univ.<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" ng-model="e_qualification.course_type">
                                <div class="text-danger" ng-show="errors.course_type">{{errors.course_type}}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Certificate<sup class="text-danger">*</sup></label>
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

    <div class="modal fade" id="gapDeclaration" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Gap Declaration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label>Particulars (Reason)<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" ng-model="gap_declaration.particular">
                                <div class="text-danger" ng-show="errors.particular">{{errors.particular}}</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>From (MM/YYYY)<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control month-year-picker" ng-init="initializeMonthYear();" ng-model="gap_declaration.from_date">
                                <div class="text-danger" ng-show="errors.from_date">{{errors.from_date}}</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>To (MM/YYYY)<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control month-year-picker" ng-init="initializeMonthYear();" ng-model="gap_declaration.to_date">
                                <div class="text-danger" ng-show="errors.to_date">{{errors.to_date}}</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Certificate<sup class="text-danger">*</sup></label>
                                <input type="file" id="gapdocument" file-input="gapdocument" class="form-control" ngf-select>
                                <div class="text-danger" ng-show="errors.gapdocument">{{errors.gapdocument}}</div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" ng-click="saveGapDeclaration()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mediclaim" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Mediclaim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label>Name<sup class="text-danger">*</sup></label>
                            <input type="text" maxlength="30" class="form-control" ng-model="mediclaim.name">
                            <div class="text-danger" ng-show="errors.name">{{errors.name}}</div>
                        </div>

                        <div class="form-group">
                            <label>Relationship<sup class="text-danger">*</sup></label>
                            <input type="text" maxlength="30" class="form-control" ng-model="mediclaim.relationship">
                            <div class="text-danger" ng-show="errors.relationship">{{errors.relationship}}</div>
                        </div>

                        <div class="form-group">
                            <label>Date of Birth<sup class="text-danger">*</sup></label>
                            <input type="text" maxlength="30" class="form-control past-datepicker" ng-init="initializeDatepicker();" ng-model="mediclaim.dob">
                            <div class="text-danger" ng-show="errors.dob">{{errors.dob}}</div>
                        </div>


                        <div class="form-group">
                            <label>Photo<sup class="text-danger">*</sup></label>
                            <input type="file" id="mediclaimdocumentPhoto" file-input="mediclaimdocumentPhoto" class="form-control" ngf-select>
                            <div class="text-danger" ng-show="errors.mediclaimdocumentPhoto">{{errors.mediclaimdocumentPhoto}}</div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" ng-click="saveMediclaim()" class="btn btn-primary">Save changes</button>
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
                            <label>Dates (MM/YY)<sup class="text-danger">*</sup></label>
                            <input type="text" maxlength="30" class="form-control month-year-picker" ng-init="initializeMonthYear();" ng-model="p_qualification.date">
                            <div class="text-danger" ng-show="errors.date">{{errors.date}}</div>
                        </div>


                        <div class="form-group">
                            <label>Certificate<sup class="text-danger">*</sup></label>
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

</section>



<script>
    app.controller('joiningFormCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {

        $scope.editMode = false;
        $scope.loading = false;
        $scope.errors = '';
        $scope.successMessage = '';
        $scope.formData = {};
        $scope.joiningForm = {
            employment_history: null
        };
        $scope.e_qualification = {};
        $scope.p_qualification = {};
        $scope.gap_declaration = {};
        $scope.mediclaim = {};
        $scope.formComlpletion = 0;
        //$scope.joiningForm.education_qualification = new Array();

        $scope.documentNameList = {
            aadhar_card: "Aadhar Card",
            cheque: "Cancelled Cheque",
            settlement_letter: "Full and final settlement letter",
            education_certificate: "Highest education certificate",
            internship_letter: "Internship / Apprentice Letter",
            pan_card: "PAN Card",
            passport: "Passport",
            relieving_letter: "Relieving and experience letter",
            resignation_letter: "Resignation Letter",
            salary_slip: "Salary Slip (Last 3 Months)",
            ssc_certificate: "SSC Certificate"
        }

        $scope.getDocumentFullname = function(key) {
            return $scope.documentNameList[key];
        }

        $scope.initializeDatepicker = function() {
            $('.past-datepicker').datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false,
                maxDate: new Date(),
                // onSelectDate: function() {
                //   $scope.joiningForm.dob = $(el).val()
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
                //   $scope.joiningForm.dob = $('').val()

                // console.log(obj);
                // console.log(obj[0].name);
                // console.log(obj[0].dataset.rowindex);
                // if(obj[0].name=='eqFromDate'){
                //     $scope.joiningForm.education_qualification[obj[0].dataset.rowindex].from_date = obj[0].value;
                // }
                // if(obj[0].name=='eqToDate'){
                //     $scope.joiningForm.education_qualification[obj[0].dataset.rowindex].to_date = obj[0].value;
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
            url: base_url + '/api/employee-joining-form/' + '<?= $id ? $id : '0' ?>',
        }).then(function(response) {
            $scope.joiningForm = response.data.joiningFormDetails;
            $scope.formComlpletion = response.data.formComlpletion;
            $scope.documentList = response.data.joiningFormDetails.documents;

        }, function(response) {
            console.log(response);

        });

        $scope.addEducationQualification = function() {

            $scope.e_qualification = {
                "id": "",
                "joining_form_id": $scope.joiningForm.id,
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

            $scope.e_qualification = angular.copy($scope.joiningForm.education_qualification[index]);
            $scope.errors = '';
        }
        $scope.saveEducationQualification = function() {
            console.log($scope.e_qualification);
            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;
            $scope.successMessage = '';
            // console.log($scope.profile);
            var apiUrl = base_url + '/api/employee-joining-form/save-education-details';
            var method = "POST";
            // console.log($scope.joiningForm);
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
                // data: $scope.joiningForm
            }).then(function(response) {
                $scope.addEducationQualification();
                $scope.editMode = false;
                $scope.loading = false;
                $scope.joiningForm.education_qualification = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.remove_e_qualification = function(index) {
            if (!confirm("Are you sure?")) {
                return;
            }
            // $scope.joiningForm.education_qualification.splice(index, 1);
            var apiUrl = base_url + '/api/employee-joining-form/remove-education-details';
            var method = "POST";
            var id = $scope.joiningForm.education_qualification[index].id;
            // console.log($scope.joiningForm);
            $http({
                method: method,
                url: apiUrl,
                data: {
                    id: id,
                },
                // data: $scope.joiningForm
            }).then(function(response) {

                $scope.loading = false;
                $scope.joiningForm.education_qualification = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });

        }

        $scope.addProfetionalQualification = function() {


            $scope.p_qualification = {
                "id": "",
                "joining_form_id": $scope.joiningForm.id,
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
            var apiUrl = base_url + '/api/employee-joining-form/save-professional-qualification';
            var method = "POST";
            // console.log($scope.joiningForm);
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
                // data: $scope.joiningForm
            }).then(function(response) {
                $scope.addProfetionalQualification();
                $scope.editMode = false;
                $scope.loading = false;
                $scope.joiningForm.professional_qualification = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.edit_p_qualification = function(index) {

            $scope.p_qualification = angular.copy($scope.joiningForm.professional_qualification[index]);
            $scope.errors = '';
        }

        $scope.remove_p_qualification = function(index) {
            // $scope.joiningForm.professional_qualification.splice(index, 1);
            if (!confirm("Are you sure?")) {
                return;
            }
            // $scope.joiningForm.education_qualification.splice(index, 1);
            var apiUrl = base_url + '/api/employee-joining-form/remove-professional-qualification';
            var method = "POST";
            var id = $scope.joiningForm.professional_qualification[index].id;
            // console.log($scope.joiningForm);
            $http({
                method: method,
                url: apiUrl,
                data: {
                    id: id,
                },
                // data: $scope.joiningForm
            }).then(function(response) {

                $scope.loading = false;
                $scope.joiningForm.professional_qualification = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.addEmploymentSummary = function() {

            $scope.joiningForm.employment_history.employment_summary.push({
                "date_from": "",
                "date_to": "",
                "company": "",
                "reason_for_leaving": "",
                "gap": "",
            });
        }
        $scope.remove_employment_summary = function(index) {
            $scope.joiningForm.employment_history.employment_summary.splice(index, 1);
        }

        $scope.addEmployer = function() {

            if (!('employers' in $scope.joiningForm.employment_history)) {
                $scope.joiningForm.employment_history.employers = [];

            }

            $scope.joiningForm.employment_history.employers.push({
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
            $scope.joiningForm.employment_history.employers.splice(index, 1);
        }




        $scope.addPreviousAddress = function() {
            $scope.joiningForm.background_info.previous_address.push({
                "address": "",
                "postcode": "",
                "dates": ""
            });
        }
        $scope.remove_p_address = function(index) {
            $scope.joiningForm.background_info.previous_address.splice(index, 1);
        }

        $scope.addGapDeclaration = function() {

            if (!('gap_declaration' in $scope.joiningForm)) {
                $scope.joiningForm.gap_declaration = [];

            }

            $scope.gap_declaration = {
                "id": "",
                "joining_form_id": $scope.joiningForm.id,
                "particular": "",
                "from_date": "",
                "to_date": "",
                "document_path": ""
            };
            $('#gapdocument').val('');
            $scope.gapdocument = null;
            $scope.errors = '';
        }

        $scope.saveGapDeclaration = function() {
            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;
            $scope.successMessage = '';
            // console.log($scope.profile);
            var apiUrl = base_url + '/api/employee-joining-form/save-gap-declaration';
            var method = "POST";
            // console.log($scope.joiningForm);
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
                        formData.append('gapdocument', file);
                    });
                    return formData;
                },
                data: {
                    model: $scope.gap_declaration,
                    document: $scope.gapdocument
                },
                // data: $scope.joiningForm
            }).then(function(response) {
                $scope.addGapDeclaration();
                $scope.editMode = false;
                $scope.loading = false;
                $scope.joiningForm.gap_declaration = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.edit_gap_declaration = function(index) {
            $scope.gap_declaration = angular.copy($scope.joiningForm.gap_declaration[index]);
            $scope.errors = '';
        }

        $scope.remove_gap_declartion = function(index) {
            if (!confirm("Are you sure?")) {
                return;
            }
            // $scope.joiningForm.employment_history.gap_declaration.splice(index, 1);
            var apiUrl = base_url + '/api/employee-joining-form/remove-gap-declaration';
            var method = "POST";
            var id = $scope.joiningForm.gap_declaration[index].id;
            // console.log($scope.joiningForm);
            $http({
                method: method,
                url: apiUrl,
                data: {
                    id: id,
                },
                // data: $scope.joiningForm
            }).then(function(response) {

                $scope.loading = false;
                $scope.joiningForm.gap_declaration = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }


        $scope.addMediclaim = function() {

            if (!('mediclaim' in $scope.joiningForm)) {
                $scope.joiningForm.mediclaim = [];

            }

            $scope.mediclaim = {
                "id": "",
                "joining_form_id": $scope.joiningForm.id,
                "name": "",
                "relationship": "",
                "dob": "",
                "age": "",
                "document_path": ""
            };
            $('#mediclaimdocumentPhoto').val('');
            $scope.mediclaimdocumentPhoto = null;
            $scope.errors = '';
        }

        $scope.saveMediclaim = function() {
            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;
            $scope.successMessage = '';
            // console.log($scope.profile);
            var apiUrl = base_url + '/api/employee-joining-form/save-mediclaim';
            var method = "POST";
            // console.log($scope.joiningForm);
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
                        formData.append('mediclaimdocumentPhoto', file);
                    });
                    return formData;
                },
                data: {
                    model: $scope.mediclaim,
                    document: $scope.mediclaimdocumentPhoto
                },
                // data: $scope.joiningForm
            }).then(function(response) {
                $scope.addMediclaim();
                $scope.editMode = false;
                $scope.loading = false;
                $scope.joiningForm.mediclaim = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.edit_mediclaim = function(index) {
            $scope.mediclaim = angular.copy($scope.joiningForm.mediclaim[index]);
            $scope.errors = '';
        }

        $scope.remove_mediclaim = function(index) {
            // $scope.joiningForm.background_info.mediclaim.splice(index, 1);
            if (!confirm("Are you sure?")) {
                return;
            }
            // $scope.joiningForm.employment_history.gap_declaration.splice(index, 1);
            var apiUrl = base_url + '/api/employee-joining-form/remove-mediclaim';
            var method = "POST";
            var id = $scope.joiningForm.mediclaim[index].id;
            // console.log($scope.joiningForm);
            $http({
                method: method,
                url: apiUrl,
                data: {
                    id: id,
                },
                // data: $scope.joiningForm
            }).then(function(response) {

                $scope.loading = false;
                $scope.joiningForm.mediclaim = response.data.list;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);

                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });
        }

        $scope.calculate_age = function(index) {
            $scope.joiningForm.background_info.mediclaim[index].age = calcAge($scope.joiningForm.background_info.mediclaim[index].dob);
        }

        $scope.addRelativeBitstring = function() {

            if (!('relative_with_bitstring' in $scope.joiningForm.background_info)) {
                $scope.joiningForm.background_info.relative_with_bitstring = [];

            }

            $scope.joiningForm.background_info.relative_with_bitstring.push({
                "name": "",
                "relationship": "",
                "position": ""
            });
        }
        $scope.remove_relative_bitstring = function(index) {
            $scope.joiningForm.background_info.relative_with_bitstring.splice(index, 1);
        }


        $scope.submitForm = function(formType, nextTab = '', reload = false) {

            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;
            $scope.successMessage = '';
            // console.log($scope.profile);
            var apiUrl = base_url + '/api/employee-joining-form/' + formType;
            var method = "POST";
            // console.log($scope.joiningForm);
            $http({
                method: method,
                url: apiUrl,
                data: $scope.joiningForm
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
                toastr.error("Something went wrong !!");
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });

        }



        $scope.uploadDocument = function() {

            $scope.errors = '';
            $scope.loading = true;
            var apiUrl = base_url + '/api/employee-joining-form/documents';
            $http({
                    method: 'POST',
                    url: apiUrl,
                    headers: {
                        'Content-Type': undefined
                    },

                    transformRequest: function(data) {
                        var formData = new FormData();
                        formData.append("id", $scope.joiningForm.id);
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
                    $scope.documentList = response.data.documentList;
                    $scope.documentName = '';
                    $('#customFile').val('');
                    // $scope.formData = {};
                    // window.location = base_url + '/admin/categories';
                }, function(response) {

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
            var apiUrl = base_url + '/api/employee-joining-form/remove-document';
            $http({
                    method: 'POST',
                    url: apiUrl,
                    data: {
                        // model: $scope.formData,
                        document: documentName,
                        id: $scope.joiningForm.id
                    }
                })
                .then(function(response) {
                    $scope.editMode = false;
                    $scope.loading = false;
                    $scope.documentList = response.data.documentList;
                    $scope.successMessage = response.data.messages.success;
                    toastr.success(response.data.messages.success);
                    // $scope.formData = {};
                    // window.location = base_url + '/admin/categories';
                }, function(response) {

                    $scope.loading = false;
                    $scope.errors = response.data.messages;

                });
        }

    }]);
</script>