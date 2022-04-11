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
  <section ng-cloak class="content" ng-controller="ServerSideProcessingCtrl">
    <div class="container-fluid">

      <div class="row m-0">
        <div class="col-12">
          <h1>Profile Details <small ng-show="!!profileForm.first_name || !!profileForm.last_name">({{profileForm.first_name +' '+profileForm.last_name | uppercase }})</small></h1>
        </div>
      </div>
      <div class="row">

        <div ng-show="!!profileForm" class="col-md-12">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link <?= $activeTab == 'employeeDetails' ? 'active' : '' ?>" id="employeeDetails-tab" data-toggle="tab" href="#employeeDetails" role="tab" data-iserror="{{errors.employeeDetailsTab}}" aria-controls="employeeDetails" aria-selected="true">Personal Details <span ng-show="errors.employeeDetailsTab" class="fa fa-exclamation-triangle text-danger"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $activeTab == 'educationalQualifications' ? 'active' : '' ?>" id="educationalQualifications-tab" data-toggle="tab" href="#educationalQualifications" role="tab" data-iserror="{{errors.educationalQualificationsTab}}" aria-controls="educationalQualifications" aria-selected="false">Academics <span ng-show="errors.educationalQualificationsTab" class="fa fa-exclamation-triangle text-danger"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $activeTab == 'employmentHistory' ? 'active' : '' ?>" id="employmentHistory-tab" data-toggle="tab" href="#employmentHistory" role="tab" data-iserror="{{errors.employmentHistoryTab}}" aria-controls="employmentHistory" aria-selected="false">Employment <span ng-show="errors.employmentHistoryTab" class="fa fa-exclamation-triangle text-danger"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $activeTab == 'uploadDocuments' ? 'active' : '' ?>" id="uploadDocuments-tab" data-toggle="tab" href="#uploadDocuments" role="tab" data-iserror="{{errors.uploadDocumentsTab}}" aria-controls="uploadDocuments" aria-selected="false">Documents <span ng-show="errors.uploadDocumentsTab" class="fa fa-exclamation-triangle text-danger"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $activeTab == 'jobPositions' ? 'active' : '' ?>" id="jobPositions-tab" data-toggle="tab" href="#jobPositions" role="tab" data-iserror="{{errors.jobPositions}}" aria-controls="jobPositions" aria-selected="false">Jobs <span ng-show="errors.jobPositions" class="fa fa-exclamation-triangle text-danger"></span></a>
            </li>

          </ul>
          <div class="tab-content" id="myTabContent" style="background-color: white;padding:20px;">
            <div class="tab-pane fade <?= $activeTab == 'employeeDetails' ? 'show active' : '' ?>" id="employeeDetails" role="tabpanel" aria-labelledby="employeeDetails-tab">
              <form class="">
                <div class="row">
                  <div class="col-md-3 ml-auto">
                    <div class="row">
                      <label for="" class="col-md-4 text-right col-form-label-sm">Status:</label>
                      <select class="form-control form-control-sm col-md-8 " ng-change="updateStatus()" ng-model="profileForm.status">
                        <option value="0">New</option>
                        <option value="1">In-process</option>
                        <option value="2">Selected</option>
                        <option value="3">Blacklist</option>
                      </select>
                    </div>


                  </div>
                </div>
                <fieldset class="form-group p-3">
                  <legend class="w-auto px-2">Personal details</legend>
                  <div class="row">
                    <div class="col-md-6">
                      <table class="table table-personal-info table-sm">
                        <colgroup>
                          <col style="width: 150px;">
                          <col>
                        </colgroup>
                        <tbody>
                          <tr>
                            <td><label>Name: </label></td>
                            <td>{{profileForm.first_name+' '+profileForm.last_name | uppercase}}</td>
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
                            <td>{{profileForm.marital_status}}</td>
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
                      <table class="table table-personal-info table-sm">
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
                      <h6>
                       
                        <span class="badge badge-info ml-1" ng-repeat="item in profileForm.primary_skills">{{item.text}} [{{item.rating+'/10'}}]</span>
</h6>
                    </div>
                    <div class="form-group col-md-12">

                      <label>Secondary Skills: </label>
                      <h6>
                      
                      <span class="badge badge-info ml-1" ng-repeat="item in profileForm.secondary_skills">{{item.text}} [{{item.rating+'/10'}}]</span>
                      </h6>

                    </div>
                    <div class="form-group col-md-12">

                      <label>Foundation Skills: </label>
                      <h6>
                      <span class="badge badge-info ml-1" ng-repeat="item in profileForm.foundation_skills">{{item.text}} [{{item.rating+'/10'}}]</span>
                      </h6>

                    </div>

                  </div>

                </fieldset>

              </form>

            </div>
            <div class="tab-pane fade <?= $activeTab == 'educationalQualifications' ? 'show active' : '' ?>" id="educationalQualifications" role="tabpanel" aria-labelledby="educationalQualifications-tab">
              <div class="table-responsive">
                <form class="">
                  <fieldset class="form-group p-3 table-responsive">
                    <table class="table table-bordered table-sm">
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
                    <table class="table table-bordered table-sm">
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

            <div class="tab-pane fade <?= $activeTab == 'employmentHistory' ? 'show active' : '' ?>" id="employmentHistory" role="tabpanel" aria-labelledby="employmentHistory-tab">
              <div>
                <p> Starting with your <b>most recent employer</b> please give details of your complete employment history since you left full time education. Include any periods of self-employment, unemployment, maternity leave or <b>military service.</b> Include all part time and temporary employment and provide details of both the agencies and placements. Under ‘position held’ state clearly if you were a partner or had an ownership interest in any of the employing companies, or if the position was part time. If you are aware that one of your employers has changed its trading name, please provide the former name first, followed by the new name.</p>
              </div>
              <div class="table-responsive">
                <form class="">


                  <fieldset class="form-group p-3 animation">
                    <table class="table table-bordered table-sm">
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

            <div class="tab-pane fade <?= $activeTab == 'uploadDocuments' ? 'show active' : '' ?>" id="uploadDocuments" role="tabpanel" aria-labelledby="uploadDocuments-tab">
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

            <div class="tab-pane fade <?= $activeTab == 'jobPositions' ? 'show active' : '' ?>" id="jobPositions" role="tabpanel" aria-labelledby="jobPositions-tab">

              <div ng-show="profileForm.jobPositions.length!=0" ng-repeat="position in profileForm.jobPositions" class="card collapsed-card" ng-class="{'card-primary':!!position.applied_dt,'card-danger':!position.applied_dt}">
                <div class="card-header">
                  <h3 class="card-title">
                    {{position.title}} <small>({{position.job_code}}, {{position.client_name}})</small> - <small class="text-warning"> {{dateFormat(position.shortlisted_dt)}}</small>

                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <small><label for="">Job Description:</label> {{position.desc}}</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <small><label for="">Primary Skills ({{(position.match_primary_skills != "0") ?'Match '+ position.match_primary_skills +' skill(s)':'Match all skills'}}):</label> {{getSkills(position.primary_skills)}}</small>
                    </div>
                    <div class="col-md-6">
                      <small><label for="">Secondary Skills ({{(position.match_secondary_skills != "0") ?'Match '+ position.match_secondary_skills +' skill(s)':'Match all skills'}}):</label> {{getSkills(position.secondary_skills)}}</small>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <small><label for="">Applied Date:</label> {{!!position.applied_dt?dateFormat(position.applied_dt):'- -'}}</small>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <h5>Interviews <button type="button" ng-disabled="!position.applied_dt" ng-click="viewInterview('',position)" class="btn btn-sm btn-outline-primary mb-2" style="float:right;"><i class="fa fa-plus"></i> Schedule New Interview</button></h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-bordered table-sm table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Company Name</th>
                            <th>Interviewer Name</th>
                            <th>For Role</th>
                            <th>Schedule Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="interview in position.interviews">
                            <td>{{$index+1}}</td>
                            <td>{{interview.company_name}}</td>
                            <td>{{interview.interview_taken_by}}</td>
                            <td>{{interview.for_role}}</td>
                            <td>{{dateTimeFormat(interview.schedule_dt)}}</td>
                            <td>{{getInterviewStatus(interview.status)}}</td>
                            <td>
                              <button type="button" class="btn btn-sm text-primary" ng-click="viewInterview(interview.id);" title="Edit"><i class="fa fa-edit"></i></button>
                              <button type="button" class="btn btn-sm text-danger" ng-click="deleteInterview(interview.id);" title="Delete"><i class="fas fa-trash"></i></button>
                            </td>
                          </tr>
                          <tr ng-show="!position.interviews">
                            <td colspan="7">No data available</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>


                </div>
              </div>

              <div ng-show="profileForm.jobPositions.length==0" class="alert alert-danger" role="alert">
                Data not available!
              </div>

            </div>

          </div>
        </div>

        <div ng-hide="!!profileForm" class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="alert alert-danger" role="alert">
                Data not available!
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal" id="viewInterviewModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header bg-primary">

              <h5 class="modal-title">Schedule an Interview</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <form>
                    
                      <form class="form-horizontal">
                        <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Company name<sup class="text-danger">*</sup></label>
                          <div class="col-sm-8">
                            <label for="" class="col-sm-8 col-form-label form-check-label">

                              {{interviewForm.company_name}}
                            </label>
                          <!-- <input type="text" maxlength="50" class="form-control" ng-model="interviewForm.company_name"> -->
                            <!-- <div class="text-danger" ng-show="interviewFormErrors.company_name">{{interviewFormErrors.company_name}}</div> -->
                          
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">For role<sup class="text-danger">*</sup></label>
                          <div class="col-sm-8">
                          <label for="" class="col-sm-8 col-form-label form-check-label">

                            {{interviewForm.for_role}}
                          </label>
                          <!-- <input type="text" maxlength="20" class="form-control" ng-model="interviewForm.for_role"> -->
                            <!-- <div class="text-danger" ng-show="interviewFormErrors.for_role">{{interviewFormErrors.for_role}}</div> -->
                         
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Interviewer Name<sup class="text-danger">*</sup></label>
                          <div class="col-sm-8">
                          <input type="text" maxlength="50" class="form-control" ng-model="interviewForm.interview_taken_by">
                            <div class="text-danger" ng-show="interviewFormErrors.interview_taken_by">{{interviewFormErrors.interview_taken_by}}</div>
                         
                          </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Schedule date<sup class="text-danger">*</sup></label>
                          <div class="col-sm-8">
                          <input type="text" maxlength="20" class="form-control datepicker" ng-init="initializeDatepicker();" ng-model="interviewForm.schedule_dt">
                            <div class="text-danger" ng-show="interviewFormErrors.schedule_dt">{{interviewFormErrors.schedule_dt}}</div>
                          
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Status<sup class="text-danger">*</sup></label>
                          <div class="col-sm-8">
                          <select class="form-control" ng-model="interviewForm.status">
                              <option value="">Select</option>
                              <option value="1">Cancelled</option>
                              <option value="2">On Hold</option>
                              <option value="3">In Process</option>
                              <option value="4">No Show</option>
                              <option value="5">Not Selected</option>
                              <option value="6">Selected</option>
                              <option value="7">Scheduled</option>
                            </select>
                            <div class="text-danger" ng-show="interviewFormErrors.status">{{interviewFormErrors.status}}</div>
                          
                          </div>
                        </div>
                        
                      </form>
                      
                  </form>
                </div>
              </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">

              <button type="button" class="btn btn-sm btn-outline-primary" ng-click="saveInterviewForm()">Save</button>
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

  function ServerSideProcessingCtrl($scope, DTOptionsBuilder, DTColumnBuilder, $compile, $http, $filter) {

    $scope.profileForm = null;
    $scope.statusWiseCount = {};
    $scope.interviewForm = {};
    $scope.id = '<?= $id ?>';
    $scope.documentNameList = {
      cv: "Curriculum vitae",
      aadhar_card: "Aadhar Card",
      pan_card: "PAN Card",
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
        // validateOnBlur:false,
        // onSelectDate: function() {
        //   $scope.joiningForm.dob = $(el).val()
        // }
      });

      $('.datepicker').datetimepicker({
        format: 'd-M-Y H:i',
        scrollInput: false,
        timepicker: true,
        // validateOnBlur:false,
        // onSelectDate: function(el) {
        //   console.log(el);
        //  $scope.interviewForm.schedule_dt = el;
        // }
      });
    }

    $scope.getInterviewStatus = function(data) {
      var status_str = '';
      switch (data) {
        case '1':
          status_str = 'Cancelled';
          break;
        case '2':
          status_str = 'On Hold';
          break;
        case '3':
          status_str = 'In Process';
          break;
        case '4':
          status_str = 'No Show';
          break;
        case '5':
          status_str = 'Not Selected';
          break;
        case '6':
          status_str = 'Selected';
          break;
        case '7':
          status_str = 'Scheduled';
          break;

      }

      return status_str;
    }

    $scope.viewProfile = function() {
      $scope.profile = {};
      // $('#viewProfileModal').modal('toggle');
      // get profile details

      $http({
        method: 'get',
        url: base_url + '/api/profiles/' + $scope.id,
      }).then(function(response) {
        console.log(response);
        $scope.profileForm = response.data;
      }, function(response) {


      });
    }
    $scope.viewProfile();
    $scope.viewInterview = function(interviewId = '', position = '') {
      $scope.interviewForm = {};
      $scope.interviewFormErrors='';
      $('#viewInterviewModal').modal('toggle');
      // get profile details
      console.log(interviewId,position);
      if (interviewId != '') {

        $http({
          method: 'get',
          url: base_url + '/api/interviews/' + $scope.profileForm.id + '/' + interviewId,
        }).then(function(response) {
          console.log(response);
          $scope.interviewForm = response.data;
          //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
        }, function(response) {


        });
      }else{
        $scope.interviewForm.job_position_id = position.id;
        $scope.interviewForm.company_name = position.client_name;
        $scope.interviewForm.for_role = position.title;
      }
    }


    $scope.saveInterviewForm = function() {
      
      $scope.interviewFormErrors='';
      $scope.interviewForm.profile_id =  $scope.profileForm.id;
      // get profile details
      $http({
        method: 'post',
        url: base_url + '/api/interviews/' + $scope.profileForm.id,
        data:$scope.interviewForm
      }).then(function(response) {
        
        $('#viewInterviewModal').modal('toggle');
        $scope.interviewForm = {};
        $scope.viewProfile();
        toastr.success(response.data.messages.success);
        //$scope.profileForm = response.data;
       // $scope.profile.editUrl = base_url + "/profile/" + $scope.profile.id + "/edit";
      }, function(response) {

        $scope.loading = false;
        $scope.interviewFormErrors = response.data.messages;
        if (response.data.status == 403) {
            toastr.error(response.data.messages.errorMessage);
        } else {
            toastr.error("Something went wrong !!");
        }
      });
    }



    $scope.deleteInterview = function(id){

      if(!confirm("Do you want to delete this record?")) return ;

      $http({
        method: 'delete',
        url: base_url + '/api/interviews/' + id,
      }).then(function(response) {
        $scope.viewProfile();
        toastr.success(response.data.messages.success);
      }, function(response) {

        $scope.loading = false;
        $scope.interviewFormErrors = response.data.messages;
        if (response.data.status == 403) {
            toastr.error(response.data.messages.errorMessage);
        } else {
            toastr.error("Something went wrong !!");
        }
      });
    }

    $scope.updateStatus = function() {
      $http({
        method: 'put',
        url: base_url + '/api/profiles/' + $scope.id,
        data: {
          status: $scope.profileForm.status
        }
      }).then(function(response) {
        console.log(response);
        $scope.profileForm = response.data.profile;
        toastr.success(response.data.success);

      }, function(response) {


      });
    }

    $scope.getSkills = function(skills) {
      return skills.replace(/\|\|/g, ', ');
    }

  }
</script>
<?= $this->endSection() ?>