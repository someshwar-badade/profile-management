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
                        <h2>Verification</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <?=$error_message?>
                            </div>
                            <form method="POST" action="" class="not-hide-submit-btn1">
                                
                                <div class="form-group row">
                                    <label class="col-sm-4" for="aadhar_pan_number">Aadhar/PAN Number <sup class="text-danger">*</sup></label>
                                    <div class="col-sm-8">
                                        <input type="text" id="aadhar_pan_number" placeholder="Aadhar or PAN number"  maxlength="12" name="aadhar_pan_number" value="<?php echo set_value('aadhar_pan_number'); ?>" class="form-control">
                                       <?php if($validation->getError('aadhar_pan_number')){?>
                                        <div class="text-danger"><?=$validation->getError('aadhar_pan_number')?></div>
                                        <?php }?>
                                    </div>
                                    
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-4" for="verification_code">Verification Code <sup class="text-danger">*</sup></label>
                                    <div class="col-sm-8">
                                        <input type="text" id="verification_code" placeholder="8 digit verification code" maxlength="8" name="verification_code" value="<?php echo set_value('verification_code'); ?>" class="form-control">
                                        <?php if($validation->getError('verification_code')){?>
                                        <div class="text-danger"><?=$validation->getError('verification_code')?></div>
                                        <?php }?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4" ></label>
                                    <div class="col-sm-8">
                                        <button class="btn btn-primary btn-sm" type="submit"><div></div>Verify </button>
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