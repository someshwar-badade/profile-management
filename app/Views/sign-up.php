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
        <div ng-controller="registerCtrl" class="row ">

            <div class="col-md-10 offset-md-1">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/login.png') ?>" style="width: 100%;">
                            </div>
                            <div class="col-md-6 vertical-center">
                                <div style="width: 100%;">
                                    <h2 class="text-center">Sign Up</h2>
                                    <form name="login" id="login">

                                        <div class="form-row">
                                            <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control" ng-model="fname" type="text" maxlength="50" placeholder="First Name *">
                                                <div class="text-danger" ng-show="errors.fname">{{ errors.fname}}</div>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control" ng-model="lname" type="text" maxlength="50" placeholder="Last Name*">
                                                <div class="text-danger" ng-show="errors.fname">{{ errors.lname}}</div>
                                            </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="form-group">
                                            <!--<label>Email or Mobile</label>-->
                                            <input class="form-control" ng-model="email" type="text" maxlength="50" placeholder="E-mail *">
                                            <div class="text-danger" ng-show="errors.email">{{ errors.email}}</div>
                                        </div>
                                        <div class="form-group">
                                            <!--<label>Password</label>-->
                                            <input class="form-control" ng-model="password" maxlength="20" type="password" placeholder="Password *">
                                            <div class="text-danger" ng-show="errors.password">{{ errors.password}}</div>
                                        </div>
                                        <div class="form-group">
                                            <!--<label>Password</label>-->
                                            <input class="form-control" ng-model="confirm_password" maxlength="20" type="password" placeholder="Confirm password *">
                                            <div class="text-danger" ng-show="errors.confirm_password">{{ errors.confirm_password}}</div>
                                        </div>

                                        <div class="form-row justify-content-center">

                                        <div class="col-md-8 col-sm-12">
                                                <div class="form-group m-0 ">
                                                Have an account? <a href="<?= base_url(route_to('home')) ?>">Log In</a>.
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group m-0">
                                                    <button type="button" ng-disabled="loading" ng-click="submitClick()" class="btn btn-block knowmore">
                                                        <div ng-show="loading" class="css-animated-loader"></div> Sign Up
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

<script src="<?= base_url('assets/js/angular/controllers/registerCtrl.js?v=1.2') ?>"></script>

<?= $this->endSection() ?>