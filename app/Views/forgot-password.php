<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="abutsSection clearfix">
  <div class="container mt-5">
    <div class="row">

      <div class="col-md-10 offset-md-1">
        <div class="card">

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <img src="<?= base_url('assets/images/forgot-password.jpg') ?>" style="width: 100%;">
              </div>
              <div class="col-md-6 vertical-center">

              <div style="width: 100%;">
                <h2 class="text-center">Forgot Password</h2>
                <form class="mt-3" action="" method="POST">
                  <?php $validation =  \Config\Services::validation(); ?>
                  <?php if (isset($messageSuccess)) { ?>
                    <div class="form-group row">
                      <!-- <label class="col-sm-4"></label> -->
                      <div class="col-sm-12">
                        <div class="col-md-12 alert alert-success alert-dismissible fade show" role="alert">
                          <?= $messageSuccess ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                      </div>
                    </div>
                  <?php } ?>
                  <?php if (isset($messageError)) { ?>
                    <div class="form-group row">
                      <!-- <label class="col-sm-4"></label> -->
                      <div class="col-sm-12">
                        <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
                          <?= $messageError ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                      </div>
                    </div>
                  <?php } ?>

                  <?php if ($email == '') { ?>
                    <div class="form-group row">
                      <!-- <label class="col-sm-4" for="email">E-mail <sup class="text-danger">*</sup></label> -->
                      <div class="col-sm-12">
                        <input class="form-control" name="email" type="text" maxlength="50" placeholder="E-mail*" value="<?php echo set_value('email', $email); ?>">
                        <?php if ($validation->getError('email')) { ?>
                          <div class="text-danger"><?= $validation->getError('email') ?></div>
                        <?php } ?>

                      </div>
                    </div>
                  <?php } else { ?>
                    <input type="hidden" name="verify" value="true">
                    <div class="form-group row">
                      <!-- <label class="col-sm-4" for="email">E-mail <sup class="text-danger">*</sup></label> -->
                      <div class="col-sm-12">
                        <?= $email ?>
                      </div>
                      <input class="form-control" name="email" type="hidden" maxlength="50" value="<?= $email ?>">
                    </div>
                    <div class="form-group row">
                      <!-- <label class="col-sm-4" for="verificationCode">Verification Code<sup class="text-danger">*</sup></label> -->
                      <div class="col-sm-12">
                        <input class="form-control" type="text" name="verification_code" maxlength="8" placeholder="Verification code" value="<?php echo set_value('verification_code'); ?>">
                        <?php if ($validation->getError('verification_code')) { ?>
                          <div class="text-danger"><?= $validation->getError('verification_code') ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <!-- <label class="col-sm-4" for="password">Password <sup class="text-danger">*</sup></label> -->
                      <div class="col-sm-12">
                        <input class="form-control" type="password" name="password" maxlength="20" placeholder="Password" value="<?php echo set_value('password'); ?>">
                        <?php if ($validation->getError('password')) { ?>
                          <div class="text-danger"><?= $validation->getError('password') ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <!-- <label class="col-sm-4" for="cpassword">Confirm Password <sup class="text-danger">*</sup></label> -->
                      <div class="col-sm-12">
                        <input class="form-control" type="password" name="cpassword" maxlength="20" placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>">
                        <?php if ($validation->getError('cpassword')) { ?>
                          <div class="text-danger"><?= $validation->getError('cpassword') ?></div>
                        <?php } ?>

                      </div>
                    </div>

                  <?php } ?>

                  <div class="form-group row">
                    <!-- <label class="col-sm-4"></label> -->
                    <div class="col-md-8 col-sm-12">
                      <div class="form-group m-0 ">
                      Have an account? <a href="<?= base_url(route_to('home')) ?>">Log In</a>.
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12 ">
                      <button class="btn btn-block btn-primary" type="submit">
                        <div></div>Submit
                      </button>
                    </div>
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

<?= $this->endSection() ?>