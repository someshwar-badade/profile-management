<?= $this->extend('admin/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= lang('profile.heading') ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url(route_to('dashboard')) ?>">Dashboard</a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Library</a></li> -->
            <li class="breadcrumb-item"> <a href="<?= base_url(route_to('admin.users')) ?>">User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row m-0">

        <div class="col-12">




          <div ng-controller="personalDetailsCtrl">
            <div class="row">
              <div class="col-md-12">
                <!-------------Edit Pofile Form Start Here----------->
                <div class="card">
                  <div class="card-header">
                    <h4><?= lang('profile.personal.heading') ?></h4>
                  </div>
                  <div class="card-body">
                    <form id="personalDetils" name="personalDetails">

                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.firstName.label') ?><sup>*</sup> </label>
                            <input type="text" maxlength="30" class="form-control" ng-model="formData.first_name" placeholder="">
                            <div class="text-danger" ng-show="errors.first_name">{{errors.first_name}}</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.middleName.label') ?></label>
                            <input type="text" maxlength="30" class="form-control" placeholder="" ng-model="formData.middle_name">
                            <div class="text-danger" ng-show="errors.middle_name">{{errors.middle_name}}</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.lastName.label') ?> <sup>*</sup></label>
                            <input type="text" maxlength="30" class="form-control" placeholder="" ng-model="formData.last_name">
                            <div class="text-danger" ng-show="errors.last_name">{{errors.last_name}}</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.emailAddress.label') ?></label>
                            <input type="email" maxlength="50" class="form-control" placeholder="" ng-model="formData.email">
                            <div class="text-danger" ng-show="errors.email">{{errors.email}}</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.mobile.label') ?> <sup>*</sup></label>
                            <input type="text" maxlength="10" class="form-control only-numbers" placeholder="" ng-model="formData.mobile">
                            <div class="text-danger" ng-show="errors.mobile">{{errors.mobile}}</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.otherPhoneNumber.label') ?></label>
                            <input type="text" maxlength="10" class="form-control only-numbers" placeholder="" ng-model="formData.other_phone_no">
                            <div class="text-danger" ng-show="errors.other_phone_no">{{errors.other_phone_no}}</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.dob.label') ?></label>
                            <input type="text" ng-change="changeDate()" ng-init="initializeDatepicker();" ng-model="formData.dob" class="form-control past-datepicker" placeholder="DD-MM-YYYY">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.joiningDate.label') ?></label>
                            <input type="text" ng-change="changeDate()" ng-init="initializeDatepicker();" ng-model="formData.joining_date" class="form-control past-datepicker" placeholder="DD-MM-YYYY">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.profilePlan.label') ?></label>
                            <div ng-dropdown-multiselect="" options="profile_plan_list" events="events" selected-model="selcected_profile_plan" extra-settings="example13settings"></div>
                            <!-- <input type="text" maxlength="10" ng-model="formData.profile_plan" class="form-control" placeholder=""> -->
                          </div>
                        </div>


                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.gender.label') ?></label>
                            <div class="form-group">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" ng-model="formData.gender" name="gender" id="gender1" value="Male">
                                <label class="form-check-label" for="gender1"><?= lang('profile.personal.gender.male') ?></label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" ng-model="formData.gender" name="gender" id="gender2" value="Female">
                                <label class="form-check-label" for="gender2"><?= lang('profile.personal.gender.female') ?></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.maritalStatus.label') ?></label>
                            <select class="form-control" id="marital_status" ng-model="formData.marital_status">
                              <option value="">Select</option>
                              <option value="Single"><?= lang('profile.personal.maritalStatus.options.Single') ?></option>
                              <option value="Married"><?= lang('profile.personal.maritalStatus.options.Married') ?></option>
                              <option value="Widowed"><?= lang('profile.personal.maritalStatus.options.Widowed') ?></option>
                              <option value="Divorced"><?= lang('profile.personal.maritalStatus.options.Divorced') ?></option>
                            </select>

                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.referralId.label') ?></label>
                            <input type="text" placeholder="<?= lang('profile.personal.referralId.placeholder') ?>" ng-model="formData.referral_id" ng-model-options="modelOptions" typeahead-editable="false" uib-typeahead="referral as referral.referral_name for referral in referralList | filter:$viewValue | limitTo:8" class="form-control">

                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?= lang('profile.personal.profileStatus.label') ?></label>
                            <select class="form-control" ng-model="formData.status" ng-init="formData.status='1'" id="">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>

                          </div>
                        </div>

                      </div>
                      <button type="button" ng-disabled="loading" class="btn btn-primary" ng-click="submitClick()">
                        <div ng-show="loading" class="css-animated-loader"></div><?= lang('profile.buttons.save') ?>
                      </button>

                      <a type="button" class="btn btn-outline-dark" href="<?= base_url(route_to('admin.users')) ?>"><?= lang('profile.buttons.cancel') ?></a>
                    </form>
                  </div>
                </div>





              </div>
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
<!-- <script src="<?= base_url('assets/js/angular/controllers/profileCtrl.js?v1.4') ?>"></script> -->
<script>
  app.controller('personalDetailsCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.formDataCopy = '';
    $scope.formData = {}
    $scope.initializeDatepicker = function() {
      $('.past-datepicker').datetimepicker({
        format: 'd-M-Y',
        scrollInput: false,
        timepicker: false,
        maxDate: new Date(),
        onSelectDate: function() {
          $scope.formData.dob = $('.past-datepicker').val()
        }
      });
    }



    $scope.editClick = function() {
      $scope.editMode = true;
      $scope.formDataCopy = Object.assign($scope.formDataCopy, $scope.formData);

    }
    $scope.cancelClick = function() {
      $scope.editMode = false;
      $scope.formData = Object.assign($scope.formData, $scope.formDataCopy);
      $scope.errors = '';
      $scope.otpSuccessMsg = '';
    }


    $scope.submitClick = function() {

      $scope.errors = '';
      $scope.otpSuccessMsg = '';
      $scope.loading = true;
      $http({
        method: 'post',
        url: base_url + '/api/admin/user/create',
        data: {
          'first_name': $scope.formData.first_name,
          'middle_name': $scope.formData.middle_name,
          'last_name': $scope.formData.last_name,
          'mobile': $scope.formData.mobile,
          'email': $scope.formData.email,
          'dob': $scope.formData.dob,
          'gender': $scope.formData.gender,
          'marital_status': $scope.formData.marital_status,
          'other_phone_no': $scope.formData.other_phone_no,
          'joining_date': $scope.formData.joining_date,
          'profile_plan': $scope.formData.profile_plan,
          'referral_id': $scope.formData.referral_id.id,
          'status': $scope.formData.status,
        }

      }).then(function(response) {
        $scope.editMode = false;
        $scope.loading = false;
        //  $("body").overhang({
        //    type: "success",
        //    message: response.data.success,
        //    closeConfirm: true,
        //    duration: 7,
        //    overlay: true
        //  });
        $scope.formData = {};
        window.location = base_url + '/admin/user/' + response.data.user_id;
      }, function(response) {

        $scope.loading = false;
        $scope.errors = response.data.messages;

      });
    }

    $scope.requestOtpClick = function() {


      $scope.errors = '';
      $scope.otpSuccessMsg = '';
      $http({
        method: 'post',
        url: base_url + '/api/request-otp',
        data: {
          'mobile': $scope.mobile
        }

      }).then(function(response) {
        console.log('ok');
        console.log(response.data);
        $scope.otpSuccessMsg = response.data.success;
      }, function(response) {
        console.log('error');
        $scope.errors = response.data.messages;
        console.log(response.data);
      });
    }

    $scope.referralList = JSON.parse('<?= json_encode($referralList) ?>');



    $scope.modelOptions = {
      debounce: {
        default: 500,
        blur: 250
      },
      getterSetter: true
    };

    $scope.selcected_profile_plan = [];
    $scope.profile_plan_list = JSON.parse('<?= json_encode($profilePlanList['data']) ?>');
    $scope.example13settings = {
      smartButtonMaxItems: 1,
      selectionLimit: 1,
      template: '{{option.code}}',
      buttonClasses: "btn btn-primary btn-sm",
      idProperty: 'code',
      checkBoxes: true,
      showCheckAll: false,
      showUncheckAll: false,
      smartButtonTextConverter: function(skip, option) {
        return option.code;
      },

    };
    $scope.events = {
      onItemSelect: function(item) {
        $scope.formData.profile_plan = item.code;
        console.log($scope.formData);
      },
      onItemDeselect: function(item) {
        $scope.formData.profile_plan = '';
        console.log($scope.formData);
      }
    }

  }]);
</script>

<link rel="stylesheet" href="<?= base_url('assets/js/jquery-datetime-picker/jquery.datetimepicker.min.css') ?>">
<script src="<?= base_url('assets/js/jquery-datetime-picker/jquery.datetimepicker.full.min.js') ?>"></script>

<?= $this->endSection() ?>