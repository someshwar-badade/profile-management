<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>

<section class="abutsSection  align-items-center d-flex ">
  <div class="container mt-5">
    <div class="row justify-content-center align-items-center">

      <div class="col-md-5 p-0">
        <div class="regiterLeft">

          <img src="<?= base_url('assets/images/pr07.png') ?>" alt="logo" height="200">

          <p><?= lang('forms.register.sideText') ?></p>

        </div>
      </div>
      <div ng-controller="loginCtrl" class="col-md-4 p-0">
        <div class=" justify-content-center">

        <div class="card">
        <div class="card-header text-center">
        <h2><?=lang('forms.login.formHeading')?></h2>
                        </div>
          <div class="card-body">
          <form>
            <div class="form-group">
              <!--<label>Mobile Number</label>-->
              <input class="form-control" ng-model="mobile" type="text" maxlength="10" placeholder="<?=lang('forms.login.mobile.placeholder')?>*">
              <div class="text-danger" ng-show="errors.mobile">{{ errors.mobile}}</div>
            </div>
            <div class="form-group">
              <!--<label>Password</label>-->
              <input class="form-control" ng-model="password" maxlength="20" type="password" placeholder="<?=lang('forms.login.password.placeholder')?>*">
              <div  class="text-danger" ng-show="errors.password">{{ errors.password}}</div>
            </div>
            <div class="form-group">
              <div class="d-flex justify-content-between mb-3 i "><span><?=lang('forms.login.or')?></span>
                <span> <button type="button" class="btn  btn-sm  btn-primary" ng-disabled="otpLoading" ng-click="requestOtpClick()" href="javascript:void(0)">
                <div ng-show="otpLoading" class="css-animated-loader"></div><?=lang('forms.login.requestOTPBtn.label')?> </button></span>
              </div>
                <div class="text-info" ng-show="otpSuccessMsg">
                  {{otpSuccessMsg}}
                </div>
              <input class="form-control" ng-model="otp" maxlength="6" type="text" placeholder="<?=lang('forms.login.otp.placeholder')?>">
              <div  class="text-danger" ng-show="errors.otp">{{ errors.otp}}</div>
            </div>

            <div class="form-group">
              <p> <a href="<?=base_url(route_to('forgot-password'))?>"> <?=lang('forms.login.forgotPassword')?> </a></p>
            </div>

            <div class="form-row justify-content-center">

              <div class="col-5">
              <div class="form-group ">
                  <button type="button" ng-disabled="loading" ng-click="submitClick()" class="btn btn-block knowmore">
                  <div ng-show="loading" class="css-animated-loader"></div><?=lang('forms.login.submitBtn.label')?></button>
                </div>
              </div>
            </div>

          </form>
          </div>
          <div class="register"><?=lang('forms.login.footerText_1')?> <a href="<?=base_url(route_to('register'))?>" class="registerNow"><?=lang('forms.login.footerText_2')?></a></div>
        </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('javascript');?>
<script src="<?= base_url('assets/js/angular/controllers/loginCtrl.js?v1.3') ?>"></script>
<?= $this->endsection();?>