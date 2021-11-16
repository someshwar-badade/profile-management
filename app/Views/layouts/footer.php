

</div>

<footer>



</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="<?= base_url('assets/js/jquery-3.2.1.slim.min.js') ?>"></script> -->
<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.bxslider.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js?v=1.2') ?>"></script>
<script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/js/toastr/toastr.min.js') ?>"></script>
<script src="<?= base_url('assets/js/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/angularjs-dropdown-multiselect.min.js') ?>"></script>
<script src="<?= base_url('assets/js/angular-datatables-0.6.2/angular-datatables.min.js') ?>"></script>

<link rel="stylesheet" href="<?= base_url('assets/js/jquery-datetime-picker/jquery.datetimepicker.min.css') ?>">
<script src="<?= base_url('assets/js/jquery-datetime-picker/jquery.datetimepicker.full.min.js') ?>"></script>

<script src="<?= base_url('assets/js/angular/controllers/headerCtrl.js?v=1.0') ?>"></script>
<?= $this->renderSection('javascript') ?>

<script>

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>

<?php if (session()->has('error')) { ?>
  <script>
    Command: toastr["error"]("<?= session()->error ?>");
  </script>
<?php } ?>

<?php if (session()->has('success')) { ?>
  <script>
     Command: toastr["success"]("<?= session()->success ?>");
    // $("body").overhang({
    //   type: "success",
    //   message: '<?= session()->success ?>',
    //   closeConfirm: true,
    //   duration: 7,
    //   overlay: true
    // });
  </script>
<?php } ?>

</body>

</html>