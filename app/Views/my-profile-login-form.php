<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="abutsSection clearfix">
    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-md-8 p-0">
                <div class="justify-content-center">

                    <?php $validation =  \Config\Services::validation(); ?>

                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h2>Create My Profile</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?= $error_message ?>
                            </div>
                            <form method="POST" action="" class="not-hide-submit-btn1">

                            <?php if ($messageSuccess) { ?>
                                    <div class="form-group row">
                                        <label class="col-sm-4"></label>
                                        <div class="col-sm-8">
                                            <div class="col-md-12 alert alert-success alert-dismissible fade show" role="alert">
                                            <?= $messageSuccess ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php if ($messageError) { ?>
                                    <div class="form-group row">
                                        <label class="col-sm-4"></label>
                                        <div class="col-sm-8">
                                            <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $messageError ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if (empty($profileDetails)) { ?>

                                    <div class="form-group row">
                                        <label class="col-sm-4" for="email">E-mail <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8">
                                            <input type="text" id="email" placeholder="E-mail" maxlength="60" name="email" value="<?php echo set_value('email', $email); ?>" class="form-control">
                                            <?php if ($validation->getError('email')) { ?>
                                                <div class="text-danger"><?= $validation->getError('email') ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } else { ?>

                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4" for="email">E-mail</label>
                                        <div class="col-sm-8"><?= $profileDetails['email_primary'] ?></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4" for="verification_code">Verification Code <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="email" value="<?= $profileDetails['email_primary'] ?>">
                                            <input type="hidden" name="verify" value="true">
                                            <input type="text" id="verification_code" placeholder="8 digit verification code" maxlength="8" name="verification_code" value="<?php echo set_value('verification_code'); ?>" class="form-control">
                                            <?php if ($validation->getError('verification_code')) { ?>
                                                <div class="text-danger"><?= $validation->getError('verification_code') ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                <?php } ?>

                                <div class="form-group row">
                                    <label class="col-sm-4"></label>
                                    <div class="col-sm-8">
                                        <button class="btn btn-primary btn-sm" type="submit">
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
</section>


<?= $this->endSection() ?>


<?= $this->section('javascript') ?>

<?= $this->endSection() ?>