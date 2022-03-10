<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    <?php
    $user = checkUserToken();
    if (isset($_COOKIE['fname'])) { ?>
            <li class="nav-item"> <a class="nav-link" href="<?= base_url(route_to('user-dashboard')) ?>">
                <i class="flaticon-users"></i> Howdy, <?= ucfirst($_COOKIE['fname']) ?> <small>[<?=isset($user['roles'][0])?$user['roles'][0]['display_name']:'Guest User'?>]</small></a>
            </li>
          <?php } ?>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(route_to('home')) ?>" class="brand-link text-center">
    <img src="<?=base_url('assets/images/logo-small.png')?>" width="40" class="d-inline-block align-top" alt="">
      <!-- <img src="<?= base_url('assets/images/goat-logo-white.png') ?>" alt="<?= lang('site.site_title') ?>" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light"><?= lang('site.site_title') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{user.photo}}" onerror="this.src = '<?= base_url('assets/images/placeholder-employee.jpg') ?>'" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?=base_url(route_to('profile'))?>" class="d-block" ng-init="user.fname='<?= ucfirst($_COOKIE['fname']) ?>'">{{user.fname}}</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="<?= base_url(route_to('user-dashboard')) ?>" class="nav-link <?=$active_nav=='dashboard'?' active ':'';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              <?= lang('menu.sidebar.dashboard') ?>
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="<?= base_url(route_to('createMyProfile')) ?>" class="nav-link <?=$active_nav=='my-profile'?' active ':'';?>">
              <i class="nav-icon fa fa-id-card"></i>
              <p>
              My Profile
              </p>
            </a>
          </li> -->
          
          <?php if (hasCapability('profiles/view')) { ?>
          <li class="nav-item">
            <a href="<?= base_url(route_to('profiles')) ?>" class="nav-link <?=$active_nav=='profiles'?' active ':'';?>">
              <i class="nav-icon fa fa-id-card"></i>
              <p>
              Profiles
              </p>
            </a>
          </li>
          <?php }?>

          <?php if (hasCapability('joining_form/view')) { ?>
          <li class="nav-item">
            <a href="<?= base_url(route_to('sendJoiningForm')) ?>" class="nav-link <?=$active_nav=='send-joining-form'?' active ':'';?>">
              <i class="nav-icon fa fa-id-card"></i>
              <p>
              Joining Details
              </p>
            </a>
          </li>
          <?php }?>

          <?php if (hasCapability('job_positions/view')) { ?>
          <li class="nav-item">
            <a href="<?= base_url(route_to('JobPositions')) ?>" class="nav-link <?=$active_nav=='job-positions'?' active ':'';?>">
              <!-- <i class="nav-icon fa fa-id-card"></i> -->
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
              Job Positions
              </p>
            </a>
          </li>
          <?php }?>

          <?php if (hasCapability('users/view')) { ?>
          <li class="nav-item">
            <a href="<?= base_url(route_to('users')) ?>" class="nav-link <?=$active_nav=='users'?' active ':'';?>">
            <i class="nav-icon fa fa-users"></i>
              <p>
              Users
              </p>
            </a>
          </li>
        <?php }?>

        <?php if (hasCapability('clients/view')) { ?>
          <li class="nav-item">
            <a href="<?= base_url(route_to('clients')) ?>" class="nav-link <?=$active_nav=='clients'?' active ':'';?>">
            <i class="nav-icon fa fa-user"></i>
              <p>
              Clients
              </p>
            </a>
          </li>
        <?php }?>

          <?php if (hasCapability('roles/view')) { ?>
          <li class="nav-item">
            <a href="<?= base_url(route_to('roles')) ?>" class="nav-link <?=$active_nav=='roles'?' active ':'';?>">
            <i class="nav-icon fa fa-user-cog"></i>
              <p>
              Roles
              </p>
            </a>
          </li>
        <?php }?>

          <?php if (hasCapability('logs/view')) { ?>
          <li class="nav-item">
            <a href="<?= base_url(route_to('logs')) ?>" class="nav-link <?=$active_nav=='logs'?' active ':'';?>">
            <i class="nav-icon fa fa-clock"></i>
              <p>
              Logs
              </p>
            </a>
          </li>
        <?php }?>

          <li class="nav-item">
            <a href="<?=base_url(route_to('user-settings'))?>" class="nav-link <?=$active_nav_parent=='settings'?' active ':'';?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>
              <?= lang('menu.sidebar.settings') ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
          <a href="<?= base_url(route_to('logout')) ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              <?= lang('menu.logout') ?>
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  