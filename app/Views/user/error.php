<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row m-0">

                <div class="col-12">

                <div class="alert alert-danger" role="alert">
                   <?=$errorMessage?>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>