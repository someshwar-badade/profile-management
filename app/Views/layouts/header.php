<div class="wrapper">
  <header class="clearfix" ng-controller="headerCtrl">
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-light ">
      <a class="navbar-brand" href="<?= base_url() ?>">
        <img src="<?= base_url('assets/images/bitstring-logo.png') ?>" width="200" class="d-inline-block align-top" alt="">
      </a>
      <?php
      $session = session();

      ?>
        <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url() ?>">Home</a>
                </li>

               
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Career
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url(route_to('createMyProfile')) ?>">Build Profile</a>
                    <a class="dropdown-item" href="<?= base_url(route_to('joiningFormVerification2')) ?>">Joining Form</a>
                  </div>
                </li>
                 

              </ul>
        </div>

      <?php if ($session->get('employee_joining_form_id')) { ?>
        <div class="btn-group">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
            <?php echo ucwords(strtolower("WELCOME " . $session->get('employee_name'))); ?>
          </button>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu2">
          
                    <a class="dropdown-item" href="<?= base_url(route_to('joiningFormVerification2')) ?>">Joining Form</a>
            <a class="dropdown-item" href="<?= base_url(route_to('logout')) ?>">Logout</a>
          </div>
        </div>
      <?php } else if ($session->get('profile_id')) { ?>
        <div class="btn-group">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
            <?php echo ucwords(strtolower("WELCOME " . $session->get('profile_first_name'))); ?>
          </button>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item" href="<?= base_url(route_to('createMyProfile')) ?>">Build Profile</a>
            <a class="dropdown-item" href="<?= base_url(route_to('logout')) ?>">Logout</a>
          </div>
        </div>
      <?php } else { ?>
       
      <?php } ?>

    </nav>
    <script>
      var base_url = '<?= base_url(route_to('home')) ?>';
      var SITE_CODE = '<?= SITE_CODE ?>';
    </script>
  </header>