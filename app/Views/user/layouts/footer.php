<footer class="main-footer">
  <center>
  <?= getSiteSetting('site_footer') ?>
  </center>

</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- The Modal -->
<div class="modal" id="documentViewerModal">
  <div class="modal-dialog modal-lg mw-100 ">
    <div class="modal-content ">
      <!-- Modal header -->
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" style="height:90vh">

        <iframe src="" frameborder="0" width="100%" height="100%"></iframe>

      </div>
    </div>
  </div>
</div>



</div>
<!-- ./wrapper -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="<?= base_url('assets/js/jquery-3.2.1.slim.min.js') ?>"></script> -->
<!-- <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.bxslider.min.js') ?>"></script>

<script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/js/overhang/overhang.js') ?>"></script> -->

<!-- <script src="<?= base_url('assets/js/jquery-3.2.1.slim.min.js') ?>"></script> -->
<!-- <script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script> -->
<!-- jQuery -->
<!-- <script src="<?= base_url('assets/admin/plugins/jquery/jquery.min.js') ?>"></script> -->
<!-- jQuery UI 1.11.4 -->
<!-- <script src="<?= base_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js') ?>"></script> -->


<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/admin/plugins/chart.js/Chart.min.js') ?>"></script>
<!-- Sparkline -->
<!-- <script src="<?= base_url('assets/admin/plugins/sparklines/sparkline.js') ?>"></script> -->
<!-- JQVMap -->
<!-- <script src="<?= base_url('assets/admin/plugins/jqvmap/jquery.vmap.min.js') ?>"></script> -->
<!-- <script src="<?= base_url('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="<?= base_url('assets/admin/plugins/jquery-knob/jquery.knob.min.js') ?>"></script> -->
<!-- daterangepicker -->
<!-- <script src="<?= base_url('assets/admin/plugins/moment/moment.min.js') ?>"></script> -->
<!-- <script src="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.js') ?>"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="<?= base_url('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script> -->

<!-- Select2 -->
<script src="<?= base_url('assets/admin/plugins/select2/js/select2.full.min.js')?>"></script>

<!-- Summernote -->
<script src="<?= base_url('assets/admin/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<!-- <script src="<?= base_url('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script> -->
<!-- AdminLTE App -->
<script src="<?= base_url('assets/admin/dist/js/adminlte.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url('assets/admin/dist/js/demo.js') ?>"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/admin/dist/js/pages/dashboard.js') ?>"></script> -->

<script src="<?= base_url('assets/js/angular/controllers/headerCtrl.js') ?>"></script>
<script src="<?= base_url('assets/js/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/angularjs-dropdown-multiselect.min.js') ?>"></script>
<script src="<?= base_url('assets/js/angular-datatables-0.6.2/angular-datatables.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/js/jquery-datetime-picker/jquery.datetimepicker.min.css') ?>">
<script src="<?= base_url('assets/js/jquery-datetime-picker/jquery.datetimepicker.full.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js?v=1.4') ?>"></script>

<script src="<?= base_url('assets/js/toastr/toastr.min.js') ?>"></script>


<script>
  $(document).ready(function() {

    $(document).on('click', "a.iframe", function(e) {
      e.preventDefault();
      console.log(e.target.href);
      $('#documentViewerModal iframe').attr('src', '');
      $('#documentViewerModal').modal('toggle');
      $('#documentViewerModal iframe').attr('src', e.target.href);
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    
  });


  // $(document).ready(function() {
  //   $('.summernote').summernote();
  // });
</script>

<?= $this->renderSection('javascript') ?>


<?php if (session()->has('error')) { ?>
  <script>
    // $("body").overhang({
    //   type: "error",
    //   message: '<?= session()->error ?>',
    //   closeConfirm: true,
    //   duration: 7,
    //   overlay: true
    // });
  </script>
<?php } ?>

<?php if (session()->has('success')) { ?>
  <script>
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