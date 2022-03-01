
<footer class="footer clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4  col-xs-12">
        <div class="footlogo mb-4"> <img src="<?= base_url('assets/images/Logo-Maruti-Organic.png') ?>" alt="Maruti Organic"> </div>
        <address>


          <h5><?= lang('site.address.heading2') ?></h5>
          <?= lang('site.address.line1') ?><br>
          <?= lang('site.address.line2') ?><br>
          <?= lang('site.address.line3') ?><br>
          <?= lang('site.address.emailTxt') ?>: <?= lang('site.address.email') ?><br>
          <?= lang('site.address.mobileTxt') ?>: <?= lang('site.address.mobile') ?>
        </address>
        <div class="social-link">
          <a href="https://www.facebook.com/MarutiOrganics/" target="_blank"> <i class="fa fa-facebook-official"></i></a>
          <a href="https://www.youtube.com/channel/UC8d4bb93FOpHo5lYQHHUFiQ" target="_blank"> <i class="fa fa-youtube-square"></i></a>
        </div>
      </div>
      <div class="col-md-8  col-sm-8  col-xs-12">
        <div class="ft-right clearfix">
          <ul>
            <li class="<?= $active_nav == 'home' ? ' active ' : '' ?>"> <a class="" href="<?= base_url(route_to('home')) ?>"><?= lang('menu.home') ?></a> </li>
            <li class="<?= $active_nav == 'about-us' ? ' active ' : '' ?>"> <a class="" href="<?= base_url(route_to('about-us')) ?>"><?= lang('menu.about-us') ?></a> </li>
            <li class="<?= $active_nav == 'products' ? ' active ' : '' ?>"> <a class="" href="<?= base_url(route_to('products')) ?>"><?= lang('menu.products') ?></a> </li>
            <!--<li class=""> <a class="" href="products">Products </a> </li>-->
            <li class="<?= $active_nav == 'contact-us' ? ' active ' : '' ?>"> <a class="" href="<?= base_url(route_to('contact-us')) ?>"><?= lang('menu.contact-us') ?></a> </li>
            <!-- <li class=""> <a class="" href="#">Terms and Condition</a> </li>-->
            <li class="<?= $active_nav == 'privacy-policy' ? ' active ' : '' ?>"> <a class="" href="<?= base_url(route_to('privacy-policy')) ?>"><?= lang('menu.privacy-policy') ?></a> </li>
          </ul>
        </div>
      </div>
      <div class="copyright clearfix">© copyright 2020 | site | All Right Reserved.</div>
    </div>
  </div>



</footer>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="<?= base_url('assets/js/jquery-3.2.1.slim.min.js') ?>"></script> -->
<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.bxslider.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js?v=1.2') ?>"></script>
<script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/js/overhang/overhang.js') ?>"></script>
<script src="<?= base_url('assets/js/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/angularjs-dropdown-multiselect.min.js') ?>"></script>
<script src="<?= base_url('assets/js/angular-datatables-0.6.2/angular-datatables.min.js') ?>"></script>


<script src="<?= base_url('assets/js/angular/controllers/headerCtrl.js') ?>"></script>
<?= $this->renderSection('javascript') ?>


<?php if (session()->has('error')) { ?>
  <script>
    $("body").overhang({
      type: "error",
      message: '<?= session()->error ?>',
      closeConfirm: true,
      duration: 7,
      overlay: true
    });
  </script>
<?php } ?>

<?php if (session()->has('success')) { ?>
  <script>
    $("body").overhang({
      type: "success",
      message: '<?= session()->success ?>',
      closeConfirm: true,
      duration: 7,
      overlay: true
    });
  </script>
<?php } ?>


</body>

</html>