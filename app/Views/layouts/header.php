<div class="wrapper">
  <header class="clearfix" ng-controller="headerCtrl">
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="<?= base_url('assets/images/bitstring-logo.png') ?>" width="200" class="d-inline-block align-top" alt="">
      </a>
      <?php
      $session = session();
     
      ?>

<?php if($session->get('employee_joining_form_id')){?>
      <div class="btn-group">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
          <?php echo ucwords(strtolower("WELCOME ".$session->get('employee_name')));?>
        </button>
        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item" href="<?= base_url(route_to('logout')) ?>">Logout</a>
        </div>
      </div>
<?php } else if($session->get('profile_id')){?>
    <div class="btn-group">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
            <?php echo ucwords(strtolower("WELCOME ".$session->get('profile_first_name')));?>
          </button>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu2">
            <a class="dropdown-item" href="<?= base_url(route_to('logout')) ?>">Logout</a>
          </div>
        </div>
  <?php } else {?>
    <a class="nav-item" href="<?= base_url(route_to('createMyProfile')) ?>">Create Profile</a>
  <?php }?>

    </nav>
    <script>
      var base_url = '<?= base_url(route_to('home')) ?>';
      var SITE_CODE = '<?= SITE_CODE ?>';
    </script>
  </header>