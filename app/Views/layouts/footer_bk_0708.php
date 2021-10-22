
<footer class="footer clearfix">
  <div class="container">
    <div class="row">

      <div class="col-md-3 col-sm-3  col-xs-12">
        <div class="footlogo mb-4"> <img src="<?= base_url('assets/images/Logo-Maruti-Organic.png') ?>" alt="Maruti Organic"> </div>
        <address>


          <h5><?= lang('marutiorganic.address.heading2') ?></h5>
          <?= lang('marutiorganic.address.line1') ?><br>
          <?= lang('marutiorganic.address.line2') ?><br>
          <?= lang('marutiorganic.address.line3') ?><br>
          <?= lang('marutiorganic.address.emailTxt') ?>: <?= lang('marutiorganic.address.email') ?><br>
          <?= lang('marutiorganic.address.mobileTxt') ?>: <?= lang('marutiorganic.address.mobile') ?>
        </address>
        
        <div class="social-link">  
        	<a href="https://www.facebook.com/MarutiOrganics/"> <i class="fa fa-facebook-official"></i></a>
            <a href="https://www.youtube.com/channel/UC8d4bb93FOpHo5lYQHHUFiQ"> <i class="fa fa-youtube-square"></i></a>
        </div>
        
      </div>
      <div class="col-md-9  col-sm-9  col-xs-12">
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

      <div class="copyright clearfix">© copyright 2020 | marutiorganic | All Right Reserved.</div>
    </div>
  </div>

  <div class="loginSlider" id="RightPanel">
        <h2><?=lang('forms.login.formHeading')?></h2>
        <a href="javascript:void(0)" class="menuBtnClose">&#10005;</a>
        <!-- ------ loginform start here ---------->
        <div class="loginform">
          <form>
            <div class="form-group">
              <!--<label>Mobile Number</label>-->
              <input class="form-control" type="text" maxlength="10" placeholder="<?=lang('forms.login.mobile.placeholder')?>*">
            </div>
            <div class="form-group">
              <!--<label>Password</label>-->
              <input class="form-control" maxlength="20" type="password" placeholder="<?=lang('forms.login.password.placeholder')?>*">
            </div>
            <div class="form-group">
              <div class="d-flex justify-content-between mb-3 i "><span><?=lang('forms.login.or')?></span>
                <span> <a class="btn  btn-sm  btn-primary" href="#"><?=lang('forms.login.requestOTPBtn.label')?> </a></span></div>
              <input class="form-control" maxlength="6" type="text" placeholder="<?=lang('forms.login.otp.placeholder')?>">
            </div>

            <div class="form-group">
              <p> <a href="#"> <?=lang('forms.login.forgotPassword')?> </a></p>
            </div>

            <div class="form-group">
              <button type="button" class="btn btn-block knowmore"><?=lang('forms.login.submitBtn.label')?></button>
            </div>

          </form>
          <div class="register"><?=lang('forms.login.footerText_1')?> <a href="<?=base_url(route_to('register'))?>" class="registerNow"><?=lang('forms.login.footerText_2')?></a></div>
        </div>
        <!-- ------ loginform end here ---------->

        <!-- <div class="ref_img d-flex justify-content-center">
          <div class="rimg"><img src="images/pr05.png" alt="logo" height="100"></div>
          <div class="rimg"><img src="images/pr07.png" alt="logo" height="100"></div>
        </div> -->
      </div>

</footer>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url('assets/js/jquery-3.2.1.slim.min.js') ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.bxslider.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/js/overhang/overhang.js') ?>"></script>

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