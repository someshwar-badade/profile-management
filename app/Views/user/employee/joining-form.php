<style>
    .w-auto {
        width: auto;
    }

    fieldset {
        background-color: rgba(37, 0, 173, 0.1);
        border-radius: 10px;
        border: 1px solid rgb(37, 0, 173);
    }

    legend {
        color: rgb(37, 0, 173);
        font-size: 1rem;
    }

    .custom-control-label::before {
        background-color: white;
    }
</style>
<section class="abutsSection clearfix" ng-controller="joiningFormCtrl">
    <div class="container-fluid mt-5">
        <?php if (!$showTitle) { ?>
            <div class="row justify-content-center">
                <h2>Joining Form</h2>
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
                        <a class="nav-link" id="professionalQualifications-tab" data-toggle="tab" href="#professionalQualifications" role="tab" aria-controls="professionalQualifications" aria-selected="false">Professional Qualifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="employmentHistory-tab" data-toggle="tab" href="#employmentHistory" role="tab" aria-controls="employmentHistory" aria-selected="false">Employment History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="backgroundInfo-tab" data-toggle="tab" href="#backgroundInfo" role="tab" aria-controls="backgroundInfo" aria-selected="false">Background Information</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent" style="background-color: white;padding:20px;">
                    <div class="tab-pane fade show active" id="employeeDetails" role="tabpanel" aria-labelledby="employeeDetails-tab">
                        <form class="">
                            <fieldset class="form-group p-3">
                                <legend class="w-auto px-2">Personal details</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">First Name<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="First Name" ng-model="joiningForm.first_name">
                                        <div class="text-danger" ng-show="errors.first_name">{{errors.first_name}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Last Name<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Last Name" ng-model="joiningForm.last_name">
                                        <div class="text-danger" ng-show="errors.last_name">{{errors.last_name}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Father's Name</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Father's Name" ng-model="joiningForm.father_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Mother's Name</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Mother's Name" ng-model="joiningForm.mother_name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Marital Status</label>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="marital_status" value="Yes" ng-model="joiningForm.employee_other_details.marital_status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="marital_status" value="No" ng-model="joiningForm.employee_other_details.marital_status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Spouse's Name</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Spouse's Name" ng-model="joiningForm.spouse_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Kid(s) Name</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Kid(s) Name" ng-model="joiningForm.kids_name">
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">PAN Number<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="10" class="form-control" placeholder="PAN Number" ng-model="joiningForm.pan_number">
                                        <div class="text-danger" ng-show="errors.pan_number">{{errors.pan_number}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Aadhar Number<sup class="text-danger">*</sup></label>
                                        <input type="text" maxlength="12" class="form-control" placeholder="Aadhar Number" ng-model="joiningForm.aadhar_number">
                                        <div class="text-danger" ng-show="errors.aadhar_number">{{errors.aadhar_number}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">UAN Number</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="UAN Number" ng-model="joiningForm.employee_other_details.uan_number">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group p-3">
                                <legend class="w-auto px-2">Contact details</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Email (primary)<sup class="text-danger">*</sup></label>
                                        <input type="email" maxlength="50" class="form-control" placeholder="Email" ng-model="joiningForm.email_primary">
                                        <div class="text-danger" ng-show="errors.email_primary">{{errors.email_primary}}</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Mobile</label>
                                        <input type="text" maxlength="15" class="form-control" placeholder="Mobile" ng-model="joiningForm.mobile_primary">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Emergency Contact Name and Relation</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Emergency Contact Name" ng-model="joiningForm.employee_other_details.emergency_contact_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Emergency Mobile No</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Emergency Mobile No" ng-model="joiningForm.employee_other_details.emergency_contact_mobile">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group p-3">
                                <legend class="w-auto px-2">Bank details</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Bank Name & Branch</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Bank Name & Branch" ng-model="joiningForm.employee_other_details.bank_name_branch">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">Bank A/c No</label>
                                        <input type="text" maxlength="20" class="form-control" placeholder="Bank A/c No" ng-model="joiningForm.employee_other_details.bank_account_number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">IFS Code</label>
                                        <input type="text" maxlength="10" class="form-control" placeholder="IFS Code" ng-model="joiningForm.employee_other_details.bank_ifsc_code">
                                    </div>
                                </div>

                            </fieldset>


                            <button type="button" class="btn btn-primary" ng-click="submitForm('save-employee-details')">
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
                                                <td><b>Course Titlealong with Board / University</b></td>
                                                <td style="width: 25%;"><b>Name and full address of school/Institution </b></td>
                                                <td><b>From (MM/YYYY)</b></td>
                                                <td><b>To (MM/YYYY)</b></td>
                                                <td><b>Full time / Part Time/ off campus / Open Univ.</b></td>
                                                <td><b>%age/ CGPA</b></td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="qualification in joiningForm.education_qualification">
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.education_qualification[$index].degree">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.education_qualification[$index].university">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.education_qualification[$index].institution">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.education_qualification[$index].from_date">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.education_qualification[$index].to_date">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.education_qualification[$index].course_type">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.education_qualification[$index].percentage">
                                                </td>
                                                <td>
                                                    <a role="button" class="fa fa-trash" ng-click="remove_e_qualification($index)"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="8">
                                                    <a role="button" class="text-primary" ng-click="addEducationQualification()"> <i class="fa fa-plus"></i> Add new line</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </fieldset>
                                <button type="button" class="btn btn-primary" ng-click="submitForm('save-education-details')">
                                    <div ng-show="loading" class="css-animated-loader"></div>Save
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="professionalQualifications" role="tabpanel" aria-labelledby="professionalQualifications-tab">
                        <div class="table-responsive">
                            <form class="">
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
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="qualification in joiningForm.professional_qualification">
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.professional_qualification[$index].qualification">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.professional_qualification[$index].category">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.professional_qualification[$index].date">
                                                </td>
                                                <td>
                                                    <a role="button" class="fa fa-trash" ng-click="remove_p_qualification($index)"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <a role="button" class="text-primary" ng-click="addProfetionalQualification()"> <i class="fa fa-plus"></i> Add new line</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </fieldset>

                                <button type="button" class="btn btn-primary" ng-click="submitForm('save-profetional-qualification')">
                                    <div ng-show="loading" class="css-animated-loader"></div>Save
                                </button>
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
                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Employment Summary</legend>

                                    <table class="table table-bordered table-stripped">
                                        <thead>

                                            <tr>
                                                <th colspan="2"><b>Dates (MM/YYYY)</b></th>
                                                <th rowspan="2" style="width: 40%;"><b>Name of Organization</b></th>
                                                <th rowspan="2"><b>Reason for Leaving</b></th>
                                                <th rowspan="2"><b>Explain Employment gap (if Any)</b></th>
                                                <th rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <td><b>From</b></td>
                                                <td><b>To</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="summary in joiningForm.employment_history.employment_summary">
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.employment_history.employment_summary[$index].date_from">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.employment_history.employment_summary[$index].date_to">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.employment_history.employment_summary[$index].company">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.employment_history.employment_summary[$index].reason_for_leaving">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" maxlength="30" ng-model="joiningForm.employment_history.employment_summary[$index].gap">
                                                </td>

                                                <td>
                                                    <a role="button" class="fa fa-trash" ng-click="remove_employment_summary($index)"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <a role="button" class="text-primary" ng-click="addEmploymentSummary()"> <i class="fa fa-plus"></i> Add new line</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Previous Employer</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Position held</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Position held" ng-model="joiningForm.employment_history.previous_employer.position_held">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">From Date</label>
                                            <input type="text" maxlength="20" class="form-control" placeholder="From Date" ng-model="joiningForm.employment_history.previous_employer.from_date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">To Date</label>
                                            <input type="text" maxlength="10" class="form-control" placeholder="To Date" ng-model="joiningForm.employment_history.previous_employer.to_date">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Company</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Company" ng-model="joiningForm.employment_history.previous_employer.company">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Department</label>
                                            <input type="text" maxlength="20" class="form-control" placeholder="Department" ng-model="joiningForm.employment_history.previous_employer.department">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Nature of Job</label>
                                            <input type="text" maxlength="30" class="form-control" placeholder="Nature of Job" ng-model="joiningForm.employment_history.previous_employer.nature_of_job">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Annual CTC (in Lacs)</label>
                                            <input type="text" maxlength="30" class="form-control" placeholder="Annual CTC" ng-model="joiningForm.employment_history.previous_employer.annual_ctc">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Address</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Address" ng-model="joiningForm.employment_history.previous_employer.address">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">City</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="City" ng-model="joiningForm.employment_history.previous_employer.city">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Telephone</label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="Telephone" ng-model="joiningForm.employment_history.previous_employer.telephone">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Main Job Responsibilities</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Job Responsibilities" ng-model="joiningForm.employment_history.previous_employer.job_responsibilities">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Name of Reporting Manager</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Name of Reporting Manager" ng-model="joiningForm.employment_history.previous_employer.reporting_manager">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Contact Number</label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="Contact Number" ng-model="joiningForm.employment_history.previous_employer.contact_number_manager">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" maxlength="50" class="form-control" placeholder="Email" ng-model="joiningForm.employment_history.previous_employer.email_manager">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Reason for Leaving</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Reason for Leaving" ng-model="joiningForm.employment_history.previous_employer.reason_of_leaving">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">HR Name</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="HR Name" ng-model="joiningForm.employment_history.previous_employer.hr_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">HR Contact Number</label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="HR Contact Number" ng-model="joiningForm.employment_history.previous_employer.hr_contact_number">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">HR Email</label>
                                            <input type="email" maxlength="50" class="form-control" placeholder="HR Email" ng-model="joiningForm.employment_history.previous_employer.hr_email">
                                        </div>

                                    </div>

                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Previous to Previous Employer</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Position held</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Position held" ng-model="joiningForm.employment_history.previous_to_previous_employer.position_held">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">From Date</label>
                                            <input type="text" maxlength="20" class="form-control" placeholder="From Date" ng-model="joiningForm.employment_history.previous_to_previous_employer.from_date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">To Date</label>
                                            <input type="text" maxlength="10" class="form-control" placeholder="To Date" ng-model="joiningForm.employment_history.previous_to_previous_employer.to_date">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Company</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Company" ng-model="joiningForm.employment_history.previous_to_previous_employer.company">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Department</label>
                                            <input type="text" maxlength="20" class="form-control" placeholder="Department" ng-model="joiningForm.employment_history.previous_to_previous_employer.department">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Nature of Job</label>
                                            <input type="text" maxlength="30" class="form-control" placeholder="Nature of Job" ng-model="joiningForm.employment_history.previous_to_previous_employer.nature_of_job">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Annual CTC (in Lacs)</label>
                                            <input type="text" maxlength="30" class="form-control" placeholder="Annual CTC" ng-model="joiningForm.employment_history.previous_to_previous_employer.annual_ctc">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Address</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Address" ng-model="joiningForm.employment_history.previous_to_previous_employer.address">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">City</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="City" ng-model="joiningForm.employment_history.previous_to_previous_employer.city">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Telephone</label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="Telephone" ng-model="joiningForm.employment_history.previous_to_previous_employer.telephone">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Main Job Responsibilities</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Job Responsibilities" ng-model="joiningForm.employment_history.previous_to_previous_employer.job_responsibilities">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Name of Reporting Manager</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Name of Reporting Manager" ng-model="joiningForm.employment_history.previous_to_previous_employer.reporting_manager">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Contact Number</label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="Contact Number" ng-model="joiningForm.employment_history.previous_to_previous_employer.contact_number_manager">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" maxlength="50" class="form-control" placeholder="Email" ng-model="joiningForm.employment_history.previous_to_previous_employer.email_manager">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Reason for Leaving</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="Reason for Leaving" ng-model="joiningForm.employment_history.previous_to_previous_employer.reason_of_leaving">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">HR Name</label>
                                            <input type="text" maxlength="50" class="form-control" placeholder="HR Name" ng-model="joiningForm.employment_history.previous_to_previous_employer.hr_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">HR Contact Number</label>
                                            <input type="text" maxlength="15" class="form-control" placeholder="HR Contact Number" ng-model="joiningForm.employment_history.previous_to_previous_employer.hr_contact_number">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">HR Email</label>
                                            <input type="email" maxlength="50" class="form-control" placeholder="HR Email" ng-model="joiningForm.employment_history.previous_to_previous_employer.hr_email">
                                        </div>

                                    </div>

                                </fieldset>


                                <button type="button" class="btn btn-primary" ng-click="submitForm('save-employment-history')">
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
                                                <col style="width: 90%;">
                                                <col>
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C01') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C01" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C01?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C02') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C02" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C02?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C03') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C03" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C03?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C04') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C04" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C04?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C05') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C05" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C05?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C06') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C06" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C06?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C07') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C07" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C07?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('C08') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.criminal_and_civil_record.C08" value="1"> {{joiningForm.background_info.criminal_and_civil_record.C08?"Yes":"No"}}
                                                            </label>
                                                        </div>
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
                                                <col style="width: 90%;">
                                                <col>
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('B01') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.business_interest.B01" value="1"> {{joiningForm.background_info.business_interest.B01?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('B02') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.business_interest.B02" value="1"> {{joiningForm.background_info.business_interest.B02?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('B03') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.business_interest.B03" value="1"> {{joiningForm.background_info.business_interest.B03?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('B04') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.business_interest.B04" value="1"> {{joiningForm.background_info.business_interest.B04?"Yes":"No"}}
                                                            </label>
                                                        </div>
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
                                                <col style="width: 90%;">
                                                <col>
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('O01') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.other_disqualification.O01" value="1"> {{joiningForm.background_info.other_disqualification.O01?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('O02') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.other_disqualification.O02" value="1"> {{joiningForm.background_info.other_disqualification.O02?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('O03') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.other_disqualification.O03" value="1"> {{joiningForm.background_info.other_disqualification.O03?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?= getBackgroundInformationQuestion('O04') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" ng-model="joiningForm.background_info.other_disqualification.O04" value="1"> {{joiningForm.background_info.other_disqualification.O04?"Yes":"No"}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>

                                <fieldset class="form-group p-3">
                                    <legend class="w-auto px-2">Previous Addresses</legend>

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
                                                        <input type="text" class="form-control" maxlength="25" ng-model="joiningForm.background_info.previous_address[$index].dates">
                                                    </td>
                                                    <td>
                                                    <a role="button" class="fa fa-trash" ng-click="remove_p_address($index)"></a>
                                                    </td>
                                                </tr>


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">
                                                    <a role="button" class="text-primary" ng-click="addPreviousAddress()"> <i class="fa fa-plus"></i> Add new line</a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </fieldset>
                                <button type="button" class="btn btn-primary" ng-click="submitForm('save-background-information')">
                                    <div ng-show="loading" class="css-animated-loader"></div>Save
                                </button>
                            </form>
                        </div>
                    </div>

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
        $scope.joiningForm = null;
        $scope.formComlpletion = 0;
        //$scope.joiningForm.education_qualification = new Array();



        $http({
            method: 'get',
            url: base_url + '/api/employee-joining-form/' + '<?= $id ? $id : '0' ?>',
        }).then(function(response) {
            $scope.joiningForm = response.data.joiningFormDetails;
            $scope.formComlpletion = response.data.formComlpletion;
            console.log($scope.joiningForm);
        }, function(response) {
            console.log(response);

        });

        $scope.addEducationQualification = function() {
            $scope.joiningForm.education_qualification.push({
                "degree": "",
                "university": "",
                "institution": "",
                "from_date": "",
                "to_date": "",
                "course_type": "",
                "percentage": ""
            });
        }
        $scope.remove_e_qualification = function(index) {
            $scope.joiningForm.education_qualification.splice(index, 1);
        }

        $scope.addProfetionalQualification = function() {
            $scope.joiningForm.professional_qualification.push({
                "qualification": "",
                "category": "",
                "date": "",
            });
        }
        $scope.remove_p_qualification = function(index) {
            $scope.joiningForm.professional_qualification.splice(index, 1);
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



        $scope.submitForm = function(formType) {

            $scope.errors = '';
            $scope.otpSuccessMsg = '';
            $scope.loading = true;
            $scope.successMessage = '';
            console.log($scope.profile);
            var apiUrl = base_url + '/api/employee-joining-form/' + formType;
            var method = "POST";
            console.log($scope.joiningForm);
            $http({
                method: method,
                url: apiUrl,
                data: $scope.joiningForm
            }).then(function(response) {
                $scope.editMode = false;
                $scope.loading = false;
                $scope.successMessage = response.data.messages.success;
                toastr.success(response.data.messages.success);
                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.errors = response.data.messages;
                toastr.error("Something went wrong !!");
                console.log($scope.errors);
                console.log($scope.errors['lang.en.title']);
            });

        }



    }]);
</script>