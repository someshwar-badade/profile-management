<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<?=view('user/employee/joining-form',['id'=>$id])?>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>