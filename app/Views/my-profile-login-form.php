<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="abutsSection clearfix">
    <div class="container mt-5">
        <div class="row ">

            <div class="col-md-10 offset-md-1">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/profile.jpg') ?>" style="width: 100%;">
                            </div>
                            <div class="col-md-6 vertical-center">
                                <div style="width: 100%;">
                                    <h2 class="text-center">Create My Profile</h2>
                                    <?php if (isset($error_message)) { ?>
                                        <div class="row">
                                            <?= $error_message ?>
                                        </div>
                                    <?php } ?>
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

                                        <?php if (isset($profileDetails) && empty($profileDetails)) { ?>

                                            <div class="form-group row">
                                                <!-- <label class="col-sm-4" for="email">E-mail <sup class="text-danger">*</sup></label> -->
                                                <div class="col-sm-12">
                                                    <input type="text" id="email" placeholder="E-mail" maxlength="60" name="email" value="<?php echo set_value('email', $email); ?>" class="form-control">
                                                    <?php if ($validation->getError('email')) { ?>
                                                        <div class="text-danger"><?= $validation->getError('email') ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } else { ?>


                                            <div class="form-group row">
                                                <!-- <label class="col-sm-4" for="email">E-mail</label> -->
                                                <div class="col-sm-12"><?= isset($profileDetails['email_primary']) ? $profileDetails['email_primary'] : '' ?></div>
                                            </div>

                                            <div class="form-group row">
                                                <!-- <label class="col-sm-4" for="verification_code">Verification Code <sup class="text-danger">*</sup></label> -->
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="email" value="<?= isset($profileDetails['email_primary']) ? $profileDetails['email_primary'] : '' ?>">
                                                    <input type="hidden" name="verify" value="true">
                                                    <input type="text" id="verification_code" placeholder="8 digit verification code" maxlength="8" name="verification_code" value="<?php echo set_value('verification_code'); ?>" class="form-control">
                                                    <?php if ($validation->getError('verification_code')) { ?>
                                                        <div class="text-danger"><?= $validation->getError('verification_code') ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        <?php } ?>

                                        <div class="form-group row">
                                            <!-- <label class="col-sm-4"></label> -->
                                            <div class="col-sm-12 text-center">
                                                <button class="btn btn-primary" type="submit">
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
    </div>
</section>


<?= $this->endSection() ?>


<?= $this->section('javascript') ?>

<?= $this->endSection() ?>