<?= $this->extend('admin/layouts/main') ?>


<?= $this->section('content') ?>
<style>
  table.shareTable tr th {
    padding: 0 10px;
    min-width: 100px;
  }

  table.shareTable tr td {
    padding: 0 10px;
    text-align: right;
  }

  table.shareTable thead {
    background-color: black;
    color: white;
  }

  table.shareTable {
    margin: 5px auto;
    border: 1px solid black;
  }
</style>

<div ng-controller="profileCtrl" class="content-wrapper">
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
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <input type="hidden" ng-init="user.id='<?= $user['id'] ?>'">

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row m-0">
        <div class="col-12">
          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-profile-tab" data-toggle="pill" href="#editProfileTab" role="tab" aria-controls="editProfileTab" aria-selected="true"><?= lang('profile.personal.heading') ?> (Profile ID:<?= $user['id'] ?>)</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-bank-tab" data-toggle="pill" href="#editBankdetailsTab" role="tab" aria-controls="editBankdetailsTab" aria-selected="false"><?= lang('profile.bank.heading') ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-nominee-tab" data-toggle="pill" href="#editNomineeDetailsTab" role="tab" aria-controls="editNomineeDetailsTab" aria-selected="false"><?= lang('profile.nominee.heading') ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-address-tab" data-toggle="pill" href="#editAddressDetailsTab" role="tab" aria-controls="editAddressDetailsTab" aria-selected="false"><?= lang('profile.address.heading') ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-kyc-tab" data-toggle="pill" href="#editKYCDetailsTab" role="tab" aria-controls="editKYCDetailsTab" aria-selected="false"><?= lang('profile.kyc.heading') ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-wallet-tab" data-toggle="pill" href="#walletDetailsTab" role="tab" aria-controls="walletDetailsTab" aria-selected="false">Wallet</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="editProfileTab" role="tabpanel" aria-labelledby="custom-tabs-profile-tab">
                  <form id="personalDetils" name="personalDetails" ng-controller="personalDetailsCtrl">

                    <div class="row">
                      <div class="col-md-3">


                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.firstName.label') ?><sup>*</sup> </label>
                          <input type="text" maxlength="30" class="form-control" ng-model="formData.first_name" ng-init="formData.first_name='<?= $user['first_name'] ?>'" placeholder="">
                          <div class="text-danger" ng-show="errors.first_name">{{errors.first_name}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.middleName.label') ?></label>
                          <input type="text" maxlength="30" class="form-control" placeholder="" ng-model="formData.middle_name" ng-init="formData.middle_name='<?= $user['middle_name'] ?>'">
                          <div class="text-danger" ng-show="errors.middle_name">{{errors.middle_name}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.lastName.label') ?> <sup>*</sup></label>
                          <input type="text" maxlength="30" class="form-control" placeholder="" ng-model="formData.last_name" ng-init="formData.last_name='<?= $user['last_name'] ?>'">
                          <div class="text-danger" ng-show="errors.last_name">{{errors.last_name}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.emailAddress.label') ?></label>
                          <input type="email" maxlength="50" class="form-control" placeholder="" ng-model="formData.email" ng-init="formData.email='<?= $user['email'] ?>'">
                          <div class="text-danger" ng-show="errors.email">{{errors.email}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.mobile.label') ?> <sup>*</sup></label>
                          <input type="text" maxlength="10" class="form-control only-numbers" placeholder="" ng-model="formData.mobile" ng-init="formData.mobile='<?= $user['mobile'] ?>'">
                          <div class="text-danger" ng-show="errors.mobile">{{errors.mobile}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.otherPhoneNumber.label') ?></label>
                          <input type="text" maxlength="10" class="form-control only-numbers" placeholder="" ng-model="formData.other_phone_no" ng-init="formData.other_phone_no='<?= $user['other_phone_no'] ?>'">
                          <div class="text-danger" ng-show="errors.other_phone_no">{{errors.other_phone_no}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.dob.label') ?></label>
                          <input type="text" ng-change="changeDate()" ng-init="initializeDatepicker();formData.dob='<?= printFormatedDate($user['dob']) ?>'" ng-model="formData.dob" class="form-control past-datepicker" placeholder="DD-MM-YYYY">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.joiningDate.label') ?></label>
                          <input type="text" ng-change="changeDate()" ng-init="initializeDatepicker();formData.joining_date='<?= printFormatedDate($user['joining_date']) ?>'" ng-model="formData.joining_date" class="form-control past-datepicker" placeholder="DD-MM-YYYY">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.profilePlan.label') ?></label>
                          <div ng-dropdown-multiselect="" options="profile_plan_list" events="events" selected-model="selcected_profile_plan" ng-init="selcected_profile_plan[0].code='<?= $user['profile_plan'] ?>'" extra-settings="example13settings"></div>
                          <!-- <input type="text" maxlength="10" ng-model="formData.profile_plan" ng-init="formData.profile_plan='<?= $user['profile_plan'] ?>'" class="form-control" placeholder=""> -->
                        </div>
                      </div>


                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.gender.label') ?></label>
                          <div class="form-group">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" ng-model="formData.gender" ng-init="formData.gender='<?= $user['gender'] ?>'" name="gender" id="gender1" value="Male">
                              <label class="form-check-label" for="gender1"><?= lang('profile.personal.gender.male') ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" ng-model="formData.gender" ng-init="formData.gender='<?= $user['gender'] ?>'" name="gender" id="gender2" value="Female">
                              <label class="form-check-label" for="gender2"><?= lang('profile.personal.gender.female') ?></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.personal.maritalStatus.label') ?></label>
                          <select class="form-control" id="marital_status" ng-model="formData.marital_status" ng-init="formData.marital_status='<?= $user['marital_status'] ?>'">
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
                          <select class="form-control" ng-model="formData.status" ng-init="formData.status='<?= $user['status'] ?>'" id="">
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
                <div class="tab-pane fade" id="editBankdetailsTab" role="tabpanel" aria-labelledby="custom-tabs-bank-tab">
                  <form ng-controller="bankdetailsCtrl">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.bank.bankName.label') ?> <sup>*</sup> </label>
                          <input type="text" maxlength="50" class="form-control" placeholder="" ng-model="formData.bank_name" ng-init="formData.bank_name='<?= isset($userBankDetails['bank_name']) ? $userBankDetails['bank_name'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.bank_name">{{errors.bank_name}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.bank.accountName.label') ?> <sup>*</sup></label>
                          <input type="text" maxlength="100" class="form-control" placeholder="" ng-model="formData.account_name" ng-init="formData.account_name='<?= isset($userBankDetails['account_name']) ? $userBankDetails['account_name'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.account_name">{{errors.account_name}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.bank.accountNumber.label') ?> <sup>*</sup></label>
                          <input type="text" maxlength="20" class="form-control" placeholder="" ng-model="formData.account_no" ng-init="formData.account_no='<?= isset($userBankDetails['account_no']) ? $userBankDetails['account_no'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.account_no">{{errors.account_no}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.bank.ifsc.label') ?> <sup>*</sup></label>
                          <input type="text" maxlength="20" class="form-control" placeholder="" ng-model="formData.ifsc_code" ng-init="formData.ifsc_code='<?= isset($userBankDetails['ifsc_code']) ? $userBankDetails['ifsc_code'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.ifsc_code">{{errors.ifsc_code}}</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.bank.photoProof.label') ?><sup>*</sup></label>
                          <p><small class="text-muted"><?= lang('profile.kyc.note') ?></small></p>
                          <input type="file" file-input="files">
                          <div class="text-danger" ng-show="errors.photo_proof">{{errors.photo_proof}}</div>

                        </div>

                      </div>
                      <p ng-init="formData.docUrl='<?= $userBankDetails['photo_proof'] ?>'">
                        <a class="panIdProofDoc" target="_blank" href="{{formData.docUrl}}"><?= lang('profile.buttons.viewDocument') ?></a>
                      </p>
                    </div>

                    <button type="button" class="btn  btn-primary" ng-disabled="loading" ng-click="submitClick()">
                      <div ng-show="loading" class="css-animated-loader"></div><?= lang('profile.buttons.save') ?>
                    </button>
                    <a type="button" class="btn btn-outline-dark" href="<?= base_url(route_to('admin.users')) ?>"><?= lang('profile.buttons.cancel') ?></a>
                  </form>
                </div>
                <div class="tab-pane fade" id="editNomineeDetailsTab" role="tabpanel" aria-labelledby="custom-tabs-nominee-tab">
                  <form ng-controller="nomineeCtrl">

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.nominee.nomineeName.label') ?> <sup>*</sup> </label>
                          <input type="text" maxlength="100" class="form-control" ng-model="formData.nominee_name" placeholder="" ng-init="formData.nominee_name = '<?= $user['nominee_name'] ?>'">
                          <div class="text-danger" ng-show="errors.nominee_name">{{errors.nominee_name}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.nominee.nomineeRelation.label') ?> <sup>*</sup> </label>
                          <input type="text" maxlength="20" class="form-control" placeholder="" ng-model="formData.nominee_relation" ng-init="formData.nominee_relation = '<?= $user['nominee_relation'] ?>'">
                          <div class="text-danger" ng-show="errors.nominee_relation">{{errors.nominee_relation}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.nominee.nomineeMobile.label') ?> <sup>*</sup></label>
                          <input type="text" maxlength="10" class="form-control" placeholder="" ng-model="formData.nominee_mobile" ng-init="formData.nominee_mobile = '<?= $user['nominee_mobile'] ?>'">
                          <div class="text-danger" ng-show="errors.nominee_mobile">{{errors.nominee_mobile}}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.nominee.nomineeAddress.label') ?> <sup>*</sup> </label>
                          <input type="text" maxlength="200" class="form-control" placeholder="" ng-model="formData.nominee_address" ng-init="formData.nominee_address = '<?= $user['nominee_address'] ?>'">
                          <div class="text-danger" ng-show="errors.nominee_address">{{errors.nominee_address}}</div>
                        </div>
                      </div>


                    </div>

                    <button type="button" class="btn  btn-primary" ng-disabled="loading" ng-click="submitClick()">
                      <div ng-show="loading" class="css-animated-loader"></div><?= lang('profile.buttons.save') ?>
                    </button>

                    <a type="button" class="btn btn-outline-dark" href="<?= base_url(route_to('admin.users')) ?>"><?= lang('profile.buttons.cancel') ?></a>
                  </form>
                </div>
                <div class="tab-pane fade" id="editAddressDetailsTab" role="tabpanel" aria-labelledby="custom-tabs-address-tab">
                  <form ng-controller="addressCtrl">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.address.addressLine1.label') ?></label>
                          <input type="text" maxlength="50" class="form-control" placeholder="" ng-model="formData.address1" ng-init="formData.address1 = '<?= isset($user['address1']) ? $user['address1'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.address1">{{errors.address1}}</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.address.addressLine2.label') ?></label>
                          <input type="text" maxlength="50" class="form-control" placeholder="" ng-model="formData.address2" ng-init="formData.address2 = '<?= isset($user['address2']) ? $user['address2'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.address2">{{errors.address2}}</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.address.city.label') ?></label>
                          <input type="text" maxlength="50" class="form-control" placeholder="" ng-model="formData.city" ng-init="formData.city='<?= isset($user['city']) ? $user['city'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.city">{{errors.city}}</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.address.state.label') ?></label>
                          <input type="text" maxlength="50" class="form-control" placeholder="" ng-model="formData.state" ng-init="formData.state='<?= isset($user['state']) ? $user['state'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.state">{{errors.state}}</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.address.country.label') ?></label>
                          <input type="text" maxlength="50" class="form-control" placeholder="" ng-model="formData.country" ng-init="formData.country='<?= isset($user['country']) ? $user['country'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.country">{{errors.country}}</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.address.pincode.label') ?></label>
                          <input type="text" maxlength="10" class="form-control" placeholder="" ng-model="formData.pincode" ng-init="formData.pincode='<?= isset($user['pincode']) ? $user['pincode'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.pincode">{{errors.pincode}}</div>
                        </div>
                      </div>
                    </div>

                    <button type="button" class="btn  btn-primary" ng-disabled="loading" ng-click="submitClick()">
                      <div ng-show="loading" class="css-animated-loader"></div><?= lang('profile.buttons.save') ?>
                    </button>
                    <a type="button" class="btn btn-outline-dark" href="<?= base_url(route_to('admin.users')) ?>"><?= lang('profile.buttons.cancel') ?></a>
                  </form>
                </div>
                <div class="tab-pane fade" id="editKYCDetailsTab" role="tabpanel" aria-labelledby="custom-tabs-kyc-tab">
                  <form ng-controller="panCtrl">
                    <div class="col-lg-12">
                      <div class="proheader subheader">
                        <h5><?= lang('profile.kyc.pan') ?></h5>
                        <a href="" ng-if="!editMode" ng-click="editClick()"> <?= lang('profile.buttons.edit') ?></a>
                      </div>
                    </div>
                    <div class="row" ng-show="!editMode">



                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.kyc.panNumber.label') ?></label>
                          <p>{{formData.pan_no||"- -"}}</p>
                        </div>
                      </div>
                      <div class="col-md-4" ng-show="formData.docUrl" ng-init="formData.docUrl='<?= $user['pan_id_proof'] ?>'">
                        <a class="panIdProofDoc" target="_blank" href="{{formData.docUrl}}"><?= lang('profile.buttons.viewDocument') ?></a>
                      </div>



                    </div>
                    <div class="row" ng-show="editMode">



                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.kyc.panNumber.label') ?></label>
                          <input type="text" maxlength="10" class="form-control" placeholder="" ng-model="formData.pan_no" ng-init="formData.pan_no = '<?= isset($user['pan_no']) ? $user['pan_no'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.pan_no">{{errors.pan_no}}</div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <p><small class="text-muted"><?= lang('profile.kyc.note') ?></small></p>
                          <input type="file" file-input="files">
                          <div class="text-danger" ng-show="errors.pan_id_proof">{{errors.pan_id_proof}}</div>

                        </div>

                      </div>
                      <div class="col-md-4">
                        <button type="button" class="btn  knowmore" ng-disabled="loading" ng-click="uploadPan()">
                          <div ng-show="loading" class="css-animated-loader"></div><?= lang('profile.buttons.save') ?>
                        </button>
                        <a type="button" class="btn btn-outline-dark" href="<?= base_url(route_to('admin.users')) ?>"><?= lang('profile.buttons.cancel') ?></a>

                      </div>

                    </div>
                  </form>
                  <hr>
                  <form ng-controller="aadharCtrl">
                    <div class="col-lg-12">
                      <div class="proheader subheader">
                        <h5><?= lang('profile.kyc.aadhar') ?></h5>
                        <a href="" ng-if="!editMode" ng-click="editClick()"> <?= lang('profile.buttons.edit') ?></a>
                      </div>
                    </div>

                    <div class="row" ng-show="!editMode">



                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.kyc.aadharNumber.label') ?></label>
                          <p>{{formData.aadhar_no||"- -"}}</p>
                        </div>
                      </div>

                      <div class="col-md-4" ng-show="formData.docUrl" ng-init="formData.docUrl='<?= $user['aadhar_id_proof'] ?>'">
                        <a class="aadharIdProofDoc" target="_blank" href="{{formData.docUrl}}"><?= lang('profile.buttons.viewDocument') ?></a>
                      </div>



                    </div>

                    <div class="row" ng-show="editMode">


                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><?= lang('profile.kyc.aadharNumber.label') ?></label>
                          <input type="text" maxlength="12" class="form-control" placeholder="" ng-model="formData.aadhar_no" ng-init="formData.aadhar_no = '<?= isset($user['aadhar_no']) ? $user['aadhar_no'] : '' ?>'">
                          <div class="text-danger" ng-show="errors.aadhar_no">{{errors.aadhar_no}}</div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <p><small class="text-muted"><?= lang('profile.kyc.note') ?></small></p>
                          <input type="file" file-input="files">
                          <div class="text-danger" ng-show="errors.aadhar_id_proof">{{errors.aadhar_id_proof}}</div>

                        </div>

                      </div>
                      <div class="col-md-4">
                        <button type="button" class="btn  knowmore" ng-disabled="loading" ng-click="uploadAadhar()">
                          <div ng-show="loading" class="css-animated-loader"></div><?= lang('profile.buttons.save') ?>
                        </button>
                        <button type="button" class="btn btn-outline-dark" ng-click="cancelClick()"><?= lang('profile.buttons.cancel') ?></button>

                      </div>

                    </div>



                  </form>
                </div>
                <div class="tab-pane fade" id="walletDetailsTab" role="tabpanel" aria-labelledby="custom-tabs-wallet-tab">
                  <div class="row" ng-controller="ServerSideProcessingCtrl as showCase">

                    <div class="col-md-12">
                      <table class="shareTable">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Minimum Share</th>
                            <th>Bonus Share</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>In</th>
                            <td><span class="fa fa-rupee"></span> {{totalShare.in.min}}</td>
                            <td><span class="fa fa-rupee"></span> {{totalShare.in.bonus}}</td>
                          </tr>
                          <tr>
                            <th>Out</th>
                            <td><span class="fa fa-rupee"></span> {{totalShare.out.min}}</td>
                            <td><span class="fa fa-rupee"></span> {{totalShare.out.bonus}}</td>
                          </tr>
                          <tr>
                            <th>Balance</th>
                            <td><span class="fa fa-rupee"></span> {{totalShare.in.min - totalShare.out.min}}</td>
                            <td><span class="fa fa-rupee"></span> {{totalShare.in.bonus - totalShare.out.bonus}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-md-12">

                      <table style="width: 100%;" datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="row-border hover"></table>



                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>



        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h2>Action Log</h2>
              <?= getActionLog('user', $user['id']) ?>
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
  app.controller('profileCtrl', ['$scope', '$http', '$cookies', function($scope, $http, $cookies) {
    $scope.user = {};
    $scope.currentPage = $cookies.get('currentPage') || 'personal';
    $scope.changePage = function(pagename) {
      $scope.currentPage = pagename;
      $cookies.put('currentPage', pagename);
    }
  }]);

  app.controller('personalDetailsCtrl', ['$scope', '$http', '$timeout', '$interval', function($scope, $http, $timeout, $interval) {

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
        url: base_url + '/api/admin/user/' + $scope.user.id + '/personal-details',
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
          'status': $scope.formData.status,
          'referral_id': $scope.formData.referral_id.id,
        }

      }).then(function(response) {
        $scope.editMode = false;
        $scope.loading = false;
        $("body").overhang({
          type: "success",
          message: response.data.success,
          closeConfirm: true,
          duration: 7,
          overlay: true
        });


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
    $scope.formData.referral_id = JSON.parse('<?= json_encode($user['referralDetails']) ?>');



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
        console.log($scope.selcected_profile_plan);
      },
      onItemDeselect: function(item) {
        $scope.formData.profile_plan = '';
        console.log($scope.selcected_profile_plan);
      }
    }


  }]);


  app.controller('bankdetailsCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.formDataCopy = '';
    $scope.formData = {};
    $scope.formData.docUrl = '';

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

      var form_data = new FormData();

      angular.forEach($scope.files, function(file) {
        form_data.append('photo_proof', file); //form file

      });
      form_data.append('bank_name', $scope.formData.bank_name); //form text data 
      form_data.append('account_name', $scope.formData.account_name); //form text data
      form_data.append('account_no', $scope.formData.account_no); //form text data
      form_data.append('ifsc_code', $scope.formData.ifsc_code); //form text data
      $http.post(base_url + '/api/admin/user/' + $scope.user.id + '/bank-details', form_data, {
        //'file_Name':$scope.file_name;
        transformRequest: angular.identity,
        headers: {
          'Content-Type': undefined,
          'Process-Data': false
        }
      }).then(function(response) {
        $scope.editMode = false;
        $scope.loading = false;

        $("body").overhang({
          type: "success",
          message: response.data.success,
          closeConfirm: true,
          duration: 7,
          overlay: true
        });

        $scope.formData.docUrl = response.data.url;
      }, function(response) {

        $scope.errors = response.data.messages;
        $scope.loading = false;

      });
    }


  }]);
  app.controller('nomineeCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.formDataCopy = '';

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
      $scope.loading = true;
      $scope.otpSuccessMsg = '';
      $http({
        method: 'post',
        url: base_url + '/api/admin/user/' + $scope.user.id + '/nominee-details',
        data: {
          'nominee_name': $scope.formData.nominee_name,
          'nominee_relation': $scope.formData.nominee_relation,
          'nominee_mobile': $scope.formData.nominee_mobile,
          'nominee_address': $scope.formData.nominee_address
        }

      }).then(function(response) {
        $scope.editMode = false;
        $scope.loading = false;

        $("body").overhang({
          type: "success",
          message: response.data.success,
          closeConfirm: true,
          duration: 7,
          overlay: true
        });

      }, function(response) {

        $scope.errors = response.data.messages;
        $scope.loading = false;

      });
    }


  }]);

  app.controller('addressCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.formDataCopy = '';

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
      $scope.loading = true;
      $scope.otpSuccessMsg = '';
      $http({
        method: 'post',
        url: base_url + '/api/admin/user/' + $scope.user.id + '/address-details',
        data: {
          'address1': $scope.formData.address1,
          'address2': $scope.formData.address2,
          'city': $scope.formData.city,
          'state': $scope.formData.state,
          'pincode': $scope.formData.pincode,
          'country': $scope.formData.country
        }

      }).then(function(response) {
        $scope.editMode = false;
        $scope.loading = false;
        $("body").overhang({
          type: "success",
          message: response.data.success,
          closeConfirm: true,
          duration: 7,
          overlay: true
        });


      }, function(response) {

        $scope.errors = response.data.messages;
        $scope.loading = false;

      });
    }



  }]);

  app.controller('changePassCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.otpSuccessMsg = '';

    $scope.editClick = function() {
      $scope.editMode = true;
    }
    $scope.cancelClick = function() {
      $scope.editMode = false;
      $scope.errors = '';
      $scope.otpSuccessMsg = '';
    }

    $scope.submitClick = function() {
      $scope.errors = '';
      $scope.loading = true;
      $scope.otpSuccessMsg = '';
      $http({
        method: 'post',
        url: base_url + '/api/user/profile/change-password',
        data: {
          'current_password': $scope.formData.current_password,
          'new_password': $scope.formData.new_password,
          'confirm_password': $scope.formData.confirm_password
        }

      }).then(function(response) {
        $scope.editMode = false;
        $scope.loading = false;
        $("body").overhang({
          type: "success",
          message: response.data.success,
          closeConfirm: true,
          duration: 7,
          overlay: true
        });

      }, function(response) {

        $scope.errors = response.data.messages;
        $scope.loading = false;

      });
    }

  }]);

  app.directive("fileInput", function($parse) {
    return {
      link: function($scope, element, attrs) {
        element.on("change", function(event) {
          var files = event.target.files;
          $parse(attrs.fileInput).assign($scope, element[0].files);
          $scope.$apply();
        });
      }
    }
  });

  app.controller("profilePicCtrl", function($scope, $http) {

    $scope.loading = false;

    $scope.editMode = false;
    $scope.errors = '';
    $scope.otpSuccessMsg = '';

    $scope.editClick = function() {
      $scope.editMode = true;
    }
    $scope.cancelClick = function() {
      $scope.editMode = false;
      $scope.errors = '';
      $scope.otpSuccessMsg = '';
    }

    $scope.uploadFile = function() {

      $scope.loading = true;
      var form_data = new FormData();

      angular.forEach($scope.files, function(file) {
        form_data.append('profile_photo', file); //form file
        form_data.append('file_Name', $scope.fileName); //form text data
      });
      $http.post(base_url + '/api/user/profile/upload-profile-pic', form_data, {
        //'file_Name':$scope.file_name;
        transformRequest: angular.identity,
        headers: {
          'Content-Type': undefined,
          'Process-Data': false
        }
      }).then(function(response) {
        $scope.editMode = false;
        $('#profile_photo').attr('src', response.data.photo);
        $("body").overhang({
          type: "success",
          message: response.data.success,
          closeConfirm: true,
          duration: 7,
          overlay: true
        });

        $scope.loading = false;

      }, function(response) {

        $scope.errors = response.data.messages;
        $scope.loading = false;

      });
    }

  });


  app.controller("panCtrl", function($scope, $http) {
    $scope.errors = '';

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.formData = {};
    $scope.formData.docUrl = '';

    $scope.editClick = function() {
      $scope.editMode = true;
    }
    $scope.cancelClick = function() {
      $scope.editMode = false;
      $scope.errors = '';
      $scope.otpSuccessMsg = '';
    }

    $scope.uploadPan = function() {

      $scope.loading = true;
      var form_data = new FormData();

      angular.forEach($scope.files, function(file) {
        form_data.append('pan_id_proof', file); //form file

      });
      form_data.append('pan_no', $scope.formData.pan_no); //form text data 
      form_data.append('kyc_name', 'pan'); //form text data
      $http.post(base_url + '/api/admin/user/' + $scope.user.id + '/upload-kyc', form_data, {
        //'file_Name':$scope.file_name;
        transformRequest: angular.identity,
        headers: {
          'Content-Type': undefined,
          'Process-Data': false
        }
      }).then(function(response) {
        $scope.errors = '';
        $scope.editMode = false;
        $scope.loading = false;
        $("body").overhang({
          type: "success",
          message: response.data.success,
          closeConfirm: true,
          duration: 7,
          overlay: true
        });


        $scope.formData.docUrl = response.data.url;

      }, function(response) {

        $scope.errors = response.data.messages;
        $scope.loading = false;

      });
    }


  });
  app.controller("aadharCtrl", function($scope, $http) {

    $scope.errors = '';
    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.otpSuccessMsg = '';
    $scope.formData = {};
    $scope.formData.docUrl = '';
    $scope.editClick = function() {
      $scope.editMode = true;
    }
    $scope.cancelClick = function() {
      $scope.editMode = false;
      $scope.errors = '';
      $scope.otpSuccessMsg = '';
    }

    $scope.uploadAadhar = function() {

      $scope.loading = true;
      var form_data = new FormData();

      angular.forEach($scope.files, function(file) {
        form_data.append('aadhar_id_proof', file); //form file
      });
      form_data.append('aadhar_no', $scope.formData.aadhar_no); //form text data
      form_data.append('kyc_name', 'aadhar'); //form text data
      $http.post(base_url + '/api/admin/user/' + $scope.user.id + '/upload-kyc', form_data, {
        //'file_Name':$scope.file_name;
        transformRequest: angular.identity,
        headers: {
          'Content-Type': undefined,
          'Process-Data': false
        }
      }).then(function(response) {
        $scope.errors = '';
        $scope.editMode = false;
        $scope.loading = false;
        $("body").overhang({
          type: "success",
          message: response.data.success,
          closeConfirm: true,
          duration: 7,
          overlay: true
        });

        $scope.formData.docUrl = response.data.url

      }, function(response) {

        $scope.errors = response.data.messages;
        $scope.loading = false;

      });
    }

  });
</script>


<script>
  app.controller('ServerSideProcessingCtrl', ServerSideProcessingCtrl);

  function ServerSideProcessingCtrl($scope, DTOptionsBuilder, DTColumnBuilder) {
    $scope.tableFilter = {};
    $scope.totalShare = {};
    var vm = this;
    vm.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        // Either you specify the AjaxDataProp here
        // dataSrc: 'data',
        url: base_url + '/api/admin/user/' + $scope.user.id + '/wallet',
        data: {
          filter: $scope.tableFilter
        },
        type: 'POST',
      })
      // or here
      .withDataProp('data')
      .withOption('processing', true)
      .withOption('serverSide', true)
      .withPaginationType('full_numbers')
      .withOption('responsive', true)
      .withOption('drawCallback', function(data) {
        console.log($scope.totalShare = data.json.totalShare)
      });
    vm.dtColumns = [
      //DTColumnBuilder.newColumn("id").withTitle('ID'), 
      DTColumnBuilder.newColumn('order_id').withTitle('Order ID'),
      DTColumnBuilder.newColumn('minimum_share').withTitle('Minimum Share').renderWith(function(data, type, full) {
        // return full.gender + ' ' + full.id;
        return '<span class="fa fa-rupee"></span> ' + data;

      }),
      DTColumnBuilder.newColumn('bonus_share').withTitle('Bonus Share').renderWith(function(data, type, full) {
        // return full.gender + ' ' + full.id;
        return '<span class="fa fa-rupee"></span> ' + data;

      }), ,
      DTColumnBuilder.newColumn('status').withTitle('Status'),
      DTColumnBuilder.newColumn('on_date').withTitle('Date'),
    ];
    console.log(vm);


    $scope.clearFilter = function() {
      $scope.tableFilter.status = '';
      $scope.tableFilter.title = '';;
    }
  }
</script>

<link rel="stylesheet" href="<?= base_url('assets/js/jquery-datetime-picker/jquery.datetimepicker.min.css') ?>">
<script src="<?= base_url('assets/js/jquery-datetime-picker/jquery.datetimepicker.full.min.js') ?>"></script>



<?= $this->endSection() ?>