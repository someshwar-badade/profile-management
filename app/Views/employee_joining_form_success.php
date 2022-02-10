<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .thanku-box {
	box-shadow: 2px 2px 10px rgb(37, 0, 173,.5);
	border-color: rgb(37,0,173);
	color: rgb(37,0,173);
}
</style>
<section class="abutsSection clearfix mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card thanku-box">
                    <div class="card-body">
                        <h2 class="text-center">Thank you for submitting Joining Form</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>


<?= $this->endSection() ?>


<?= $this->section('javascript') ?>

<?= $this->endSection() ?>