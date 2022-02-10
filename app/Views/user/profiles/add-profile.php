<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
  a.remove-description {
    position: absolute;
    right: 15px;
    top: 5px;
  }

  .spinner-border {
    width: 1.5rem;
    height: 1.5rem;
  }
</style>
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
  <section ng-cloak class="content" ng-controller="addProfileCtrl">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="card card-primary">
          <nav class="navbar navbar-expand sticky-form-header">
            <div ng-show="loading" class="spinner-border text-primary"></div>
            <div class="text-success">{{successMessage}}</div>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><button class="btn btn-sm btn-success " ng-click="submitClick()">
                  Save</button>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(route_to('profiles')) ?>" class="btn btn-sm btn-secondary ml-2">Cancel</a>

              </li>
            </ul>
          </nav>

          <div class="card-body">
            <div class="form-group row" ng-show="profile.id">
              <div class="col-sm-4"><label for="">Date of creation: </label> {{profile.created_at}}</div>
              <div class="col-sm-4"><label for="">Last modified: </label> {{profile.updated_at | timeAgo}}</div>
              <div class="col-sm-4"><label for="">Updated By: </label> {{profile.updated_by}}</div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Candidate full name <sup class="text-danger">*</sup></label>
              <div class="col-sm-9">
                <input type="text" id="candidateFullName" ng-model="profile.candidate_name" maxlength="100" name="candidate_name" class="form-control">
                <div class="text-danger" ng-show="errors.candidate_name">{{errors.candidate_name}}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Mobile Number (primary) <sup class="text-danger">*</sup></label>
              <div class="col-sm-9">
                <input type="text" id="mobilePrimary" ng-model="profile.mobile_primary" maxlength="15" name="mobile_primary" class="form-control">
                <div class="text-danger" ng-show="errors.mobile_primary">{{errors.mobile_primary}}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Mobile Number (alternate)</label>
              <div class="col-sm-9">
                <input type="text" id="mobileAlternate" ng-model="profile.mobile_alternate" maxlength="15" name="mobile_alternate" class="form-control">

              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Email (primary) <sup class="text-danger">*</sup></label>
              <div class="col-sm-9">
                <input type="email" id="emailPrimary" ng-model="profile.email_primary" maxlength="100" name="email_primary" class="form-control">
                <div class="text-danger" ng-show="errors.email_primary">{{errors.email_primary}}</div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Email (alternate)</label>
              <div class="col-sm-9">
                <input type="email" id="emailAlternate" ng-model="profile.email_alternate" maxlength="100" name="email_alternate" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Resume (pdf)</label>
              <div class="col-sm-9">
                <div ng-show="profile.resume_pdf">
                  <a class='iframe' ng-href="https://docs.google.com/gview?url={{profile.resume_pdf_url}}&embedded=true">{{profile.resume_pdf_name}}</a>
                  <a role='button' class="text-secondary fas" ng-class="{'fa-pencil-alt':resume_pdf_change, 'fa-times':!resume_pdf_change}" ng-click='clickChangeResumePdf()' title='{{changeResumePdfTitle}}'></a>

                </div>

                <div ng-hide="profile.resume_pdf && resume_pdf_change">
                  <input type="file" accept=".pdf" id="resumepdf" file-input="resumepdf" class="form-control" ngf-select>

                </div>
              </div>


            </div>
            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Resume (word)</label>
              <div class="col-sm-9">
                <div ng-show="profile.resume_doc">
                  <a class='iframe' ng-href="https://docs.google.com/gview?url={{profile.resume_doc_url}}&embedded=true">{{profile.resume_doc_name}}</a>
                  <a role='button' class="text-secondary fas" ng-class="{'fa-pencil-alt':resume_doc_change, 'fa-times':!resume_doc_change}" ng-click='clickChangeResumeDoc()' title='{{changeResumeDocTitle}}'></a>
                </div>

                <div ng-hide="profile.resume_doc && resume_doc_change">

                  <input type="file" accept=".doc, .docx" id="resumeword" file-input="resumeword" class="form-control" ngf-select>
                </div>

              </div>

            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Gender <sup class="text-danger">*</sup></label>
              <div class="col-sm-9">
                <div class="icheck-primary d-inline mr-5">
                  <input type="radio" id="genderMale" value="0" ng-model="profile.gender" name="gender">
                  <label for="genderMale"> Male
                  </label>
                </div>
                <div class="icheck-primary d-inline">
                  <input type="radio" id="genderFemale" value="1" ng-model="profile.gender" name="gender">
                  <label for="genderFemale"> Female
                  </label>
                </div>
                <div class="text-danger" ng-show="errors.gender">{{errors.gender}}</div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Current Company</label>
              <div class="col-sm-9">
                <input type="text" id="current_company" ng-model="profile.current_company" maxlength="100" name="current_company" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Total Experience</label>
              <div class="col-sm-9">
                <input type="text" id="total_experience" ng-model="profile.total_experience" maxlength="20" name="total_experience" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Relevant Experience</label>
              <div class="col-sm-9">
                <input type="text" id="relevant_experience" ng-model="profile.relevant_experience" maxlength="20" name="relevant_experience" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Notice Period</label>
              <div class="col-sm-9">
                <input type="text" id="notice_period" ng-model="profile.notice_period" maxlength="20" name="notice_period" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Negotiable Notice Period</label>
              <div class="col-sm-9">
                <input type="text" id="negotiable_np" ng-model="profile.negotiable_np" maxlength="20" name="negotiable_np" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Current CTC</label>
              <div class="col-sm-9">
                <input type="text" id="ctc" ng-model="profile.ctc" maxlength="20" name="ctc" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Expected CTC</label>
              <div class="col-sm-9">
                <input type="text" id="expected_ctc" ng-model="profile.expected_ctc" maxlength="20" name="expected_ctc" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Negotiable CTC</label>
              <div class="col-sm-9">
                <input type="text" id="negotiable_ctc" ng-model="profile.negotiable_ctc" maxlength="20" name="negotiable_ctc" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Preferred work locations </label>
              <div class="col-sm-9">
                <tags-input ng-model="profile.preferred_work_locations" use-strings="true" replace-spaces-with-dashes="false"></tags-input>

              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Categories </label>
              <div class="col-sm-9">
                <tags-input ng-model="profile.categories" use-strings="true" replace-spaces-with-dashes="false"></tags-input>

              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="topSkills">Top Skills</label>
              <div class="col-sm-9">
                <tags-input ng-model="profile.primary_skills" use-strings="true" replace-spaces-with-dashes="false">
                  <auto-complete source="loadTags($query)"></auto-complete>
                </tags-input>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="middleSkills">Middle Skills</label>
              <div class="col-sm-9">
                <tags-input ng-model="profile.secondary_skills" use-strings="true" replace-spaces-with-dashes="false">
                  <auto-complete source="loadTags($query)"></auto-complete>
                </tags-input>

              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3" for="foundationSkills">Foundation Skills</label>
              <div class="col-sm-9">
                <tags-input ng-model="profile.foundation_skills" use-strings="true" replace-spaces-with-dashes="false">
                  <auto-complete source="loadTags($query)"></auto-complete>
                </tags-input>
              </div>
            </div>

            <div class="form-group row">
              <h4>Certifications</h4>
            </div>

            <div class="certifications">
              <div class="form-group row " ng-repeat="certification in profile.certifications">
                <!-- <label class="col-sm-3" for="foundationSkills"></label> -->
                <div class="col-sm-12">
                  <a role="button" class="fa fa-times text-secondary remove-description" ng-click="removeDescription($index)"></a>
                  <input type="text" max-length="200" ng-model="certification.description" class="form-control">
                </div>
              </div>
            </div>
            <!-- <div class="form-group row"> -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a role="button" class="text-primary float-right" ng-click="addNewCertification()"><i class="fa fa-plus"></i> Add new certification</a>
            </div>

            <!-- <div class="form-group row">
              <h4>Work Experience</h4>
            </div> -->

            <!-- <div class="work-experience">

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
                          <input type="text"  ng-model="profile.work_experience[$index].company_name" maxlength="30"  class="form-control">
                          </td>
                          <td>
                          <input type="text"  ng-model="profile.work_experience[$index].from_date" maxlength="30"  class="form-control">
                          </td>
                          <td>
                          <input type="text"  ng-model="profile.work_experience[$index].to_date" maxlength="30"  class="form-control">
                          </td>
                          <td>
                          <input type="text"  ng-model="profile.work_experience[$index].responsibility" maxlength="1000"  class="form-control">
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="5">
                          <a role="button" class="text-primary float-right" ng-click="addNewExperience()"><i class="fa fa-plus"></i> Add new experience</a>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
              </div>
            </div> -->



            <!-- </div> -->


          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<script>
  app.controller('addProfileCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.successMessage = '';
    $scope.profile = {}
    $scope.profile.certifications = [];
    $scope.profile.work_experience = [];
    $scope.resume_pdf_change = false;
    $scope.resume_doc_change = false;
    // $scope.slugify = function() {
    //     $scope.formData.slug = slugifyFilter($scope.formData.lang.en.title);
    // }
    //$scope.formData.slug = urlencodeFilter($scope.formData.en.title);


    $scope.cancelClick = function() {
      window.location = base_url + '/breeds';
    }

    $scope.addNewCertification = function() {
      $scope.profile.certifications.push({
        "description": ""
      });
    }

    $scope.removeDescription = function(index) {
      $scope.profile.certifications.splice(index, 1);
    }


    $scope.addNewExperience = function() {
      $scope.profile.work_experience.push({
        "company_name": "",
        "from_date": "",
        "to_date": "",
        "responsibility": ""
      });
    }

    $scope.removeExperience = function(index) {
      $scope.profile.work_experience.splice(index, 1);
    }



    $scope.clickChangeResumePdf = function() {
      $scope.resume_pdf_change = !$scope.resume_pdf_change;
      $scope.changeResumePdfTitle = $scope.resume_pdf_change ? 'Change Resume' : 'Cancel';
    }
    $scope.clickChangeResumeDoc = function() {
      $scope.resume_doc_change = !$scope.resume_doc_change;
      $scope.changeResumeDocTitle = $scope.resume_doc_change ? 'Change Resume' : 'Cancel';
    }

    $scope.submitClick = function() {

      $scope.errors = '';
      $scope.successMessage = '';
      $scope.otpSuccessMsg = '';
      $scope.loading = true;


      var apiUrl = base_url + '/api/profiles';
      var method = "POST";

      if ($scope.profile.id) {
        apiUrl = base_url + '/api/profiles/' + $scope.profile.id;

      }

      if ($scope.resume_pdf_change) {
        $scope.resumepdf = {}
        $('#resumepdf').val('');
      }
      if ($scope.resume_doc_change) {
        $scope.resumeword = {}
        $('#resumeword').val('');
      }


      $http({
        method: method,
        url: apiUrl,
        headers: {
          'Content-Type': undefined
        },

        transformRequest: function(data) {
          var formData = new FormData();
          formData.append("requestData", angular.toJson(data.model));

          //form file
          // formData.append('resumeword', data.resumeword); //form file

          angular.forEach(data.resumepdf, function(file) {
            formData.append('resumepdf', file);
          });
          angular.forEach(data.resumeword, function(file) {
            formData.append('resumeword', file);
          });
          return formData;
        },
        data: {
          model: $scope.profile,
          resumeword: $scope.resumeword,
          resumepdf: $scope.resumepdf
        }
      }).then(function(response) {
        $scope.editMode = false;
        $scope.loading = false;

        $scope.successMessage = response.data.success;
        $scope.profile = response.data.profile;

        $scope.resumepdf = {}
        $('#resumepdf').val('');

        $scope.resumeword = {}
        $('#resumeword').val('');


        $scope.resume_pdf_change = true;
        $scope.resume_doc_change = true;

        // window.location = base_url + '/profiles';
      }, function(response) {

        $scope.loading = false;
        $scope.errors = response.data.messages;
        console.log($scope.errors);
        console.log($scope.errors['lang.en.title']);
      });
      // $http({
      //         method: 'put',
      //         url: base_url + '/api/breeds/' + $scope.formData.id,
      //         data: {
      //             'animal_type_id': $scope.formData.animal_type_id,
      //             'type': $scope.formData.type
      //         }

      //         // 'password': $scope.password, 'otp': $scope.otp
      //     })
      //     .then(function(response) {
      //         $scope.editMode = false;
      //         $scope.loading = false;
      //         window.location = base_url + '/breeds';
      //     }, function(response) {

      //         $scope.loading = false;
      //         $scope.errors = response.data.messages;
      //         console.log($scope.errors);
      //         console.log($scope.errors['lang.en.title']);
      //     });
    }


    // get profile details
    $http({
      method: 'get',
      url: base_url + '/api/profiles/' + '<?= $id ? $id : '0' ?>',
    }).then(function(response) {
      console.log(response);
      $scope.profile = response.data;
      $scope.resume_pdf_change = !!response.data.resume_pdf;
      $scope.resume_doc_change = !!response.data.resume_doc;
    }, function(response) {


    });


    $scope.loadTags = function(query) {
      return $http.get(base_url + '/api/get-skills-autocomplete?query=' + query);
    };


  }]);
</script>
<?= $this->endSection() ?>