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
    
    <!-- /.content-header -->
    <section class="content" >
    <?=view('user/employee/joining-form',['id'=>$id,'showTitle'=>true])?>
    </section>

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>