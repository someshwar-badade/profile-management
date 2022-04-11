<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section ng-cloak class="content">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-12">
                    <h1>Dashboard</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?= base_url(route_to('createMyProfile')) ?>" style="color: inherit;">
                        <div class="info-box shadow-sm">
                            <span class="info-box-icon bg-info"><i class="fas fa-id-card"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">My Profile</span>
                                <span class="info-box-number"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>

                <?php if($isJoiningFormExist){?>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?= base_url(route_to('myJoiningForm')) ?>" style="color: inherit;">
                        <div class="info-box shadow-sm">
                            <span class="info-box-icon bg-warning"><i class="fas fa-id-card"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">My Joining Form</span>
                                <span class="info-box-number"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <?php }?>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?= base_url(route_to('user-settings')) ?>" style="color: inherit;">
                        <div class="info-box shadow-sm">
                            <span class="info-box-icon bg-secondary"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Settings</span>
                                <span class="info-box-number"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
            </div>

        </div>
    </section>
</div><!-- /.container-fluid -->
<!-- /.content -->

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>