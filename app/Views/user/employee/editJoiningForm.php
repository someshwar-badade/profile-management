<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
    a.remove-description {
        position: absolute;
        right: 15px;
        top: 5px;
    }

    .spinner-border {
        width: 1.5rem;
        height: 1.5rem;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div>
                    <h1><?= $pageHeading ?></h1>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content-header -->
    <section class="content" >
    <?=view('user/employee/joining-form',['id'=>$id,'showTitle'=>true])?>
    </section>

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>