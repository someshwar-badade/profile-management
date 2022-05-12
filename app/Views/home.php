<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .login-container {
        position: absolute;
        top: 20%;
        right: 0;
    }

    .login-container h2 {
        font-size: 1.3rem;
    }
</style>

<section class="abutsSection clearfix">
    <div class="container mt-5">
        <div ng-controller="loginCtrl" class="row ">

            <div class="col-md-10 offset-md-1">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/login.png') ?>" style="width: 100%;">
                            </div>
                            <div class="col-md-6 vertical-center">
                                <div style="width: 100%;">
                                    <h2 class="text-center">Sign In</h2>
                                    <form name="login" id="login" ng-submit="submitClick()">


                                        <div class="form-group">

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="choicePassword" name="loginChoice" value="password" ng-true-value="password" ng-model="loginChoice" class="custom-control-input">
                                                <label class="custom-control-label" for="choicePassword">Password</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="choiceVerificationCode" name="loginChoice" value="verificationCode" ng-true-value="verificationCode" ng-model="loginChoice" class="custom-control-input">
                                                <label class="custom-control-label" for="choiceVerificationCode">Verification Code</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!--<label>Email or Mobile</label>-->
                                            <div class="input-group">
                                                <input class="form-control" ng-model="email" type="text" maxlength="50" placeholder="E-mail*">
                                                <div ng-show="loginChoice=='verificationCode'" class="input-group-append">
                                                    <button type="button" ng-disabled="sendVerificationCodeLoading" ng-click="sendVerificationCode()" class="input-group-text text-primary">
                                                    <div ng-show="sendVerificationCodeLoading" role="status" class="spinner-border spinner-border-sm">
                                                        <span class="sr-only">Loading...</span>
                                                    </div> Send Verification Code</button>
                                                </div>
                                            </div>
                                            <div class="text-danger" ng-show="errors.email">{{ errors.email}}</div>
                                            <div class="text-success" ng-show="sendVerificationCodeSuccess">{{ sendVerificationCodeSuccess}}</div>
                                        </div>
                                        <div ng-show="loginChoice=='password'" class="form-group">
                                            <!--<label>Password</label>-->
                                            <input class="form-control" ng-model="password" maxlength="20" type="password" placeholder="<?= lang('forms.login.password.placeholder') ?>*">
                                            <div class="text-danger" ng-show="errors.password">{{ errors.password}}</div>
                                        </div>
                                        <div ng-show="loginChoice=='verificationCode'" class="form-group">
                                            <!--<label>Password</label>-->
                                            <input class="form-control" ng-model="verificationCodeText" maxlength="8" type="text" placeholder="Verification Code*">
                                            <div class="text-danger" ng-show="errors.verificationCodeText">{{ errors.verificationCodeText}}</div>
                                        </div>

                                        <div class="form-row">

                                        <div class="col-md-8 col-sm-12">
                                                <div class="form-group m-0 ">
                                                    <a href="<?= base_url(route_to('forgot-password')) ?>">Forgot Password?</a>.
                                                </div>
                                                <div class="form-group m-0">
                                                Don't have an account? <a href="<?= base_url(route_to('signUp')) ?>">Sign Up</a>.
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group ">
                                                    <button type="submit" ng-disabled="loading"  class="btn btn-block knowmore">
                                                        <div ng-show="loading" class="css-animated-loader"></div><?= lang('forms.login.submitBtn.label') ?>
                                                    </button>
                                                </div>
                                            </div>

                                            

                                            <!-- <div class="col-md-12 ">
                                    <div class="form-group text-center ">
                                        Click <a href="<?= base_url(route_to('joiningFormVerification2')) ?>">here</a> to update joining form.
                                    </div>
                                </div> -->
                                            
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
</section>


<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script src="<?= base_url('assets/js/angular/controllers/loginCtrl.js?v1.3') ?>"></script>

<?= $this->endSection() ?>