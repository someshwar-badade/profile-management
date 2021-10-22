<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav ml-auto">
    <?php if (isset($_COOKIE['fname'])) { ?>
            <li class="nav-item"> <a class="nav-link" href="<?= base_url(route_to('user-dashboard')) ?>">
                <i class="flaticon-users"></i> Howdy, <?= ucfirst($_COOKIE['fname']) ?></a>
            </li>
          <?php } ?>
      
     
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(route_to('home')) ?>" class="brand-link">
      <!-- <img src="<?= base_url('assets/images/goat-logo-white.png') ?>" alt="<?= lang('marutiorganic.site_title') ?>" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light"><?= lang('marutiorganic.site_title') ?></span>
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

          <li class="nav-item">
            <a href="<?= base_url(route_to('profiles')) ?>" class="nav-link <?=$active_nav=='profiles'?' active ':'';?>">
              <i class="nav-icon fa fa-id-card"></i>
              <p>
              Profiles
              </p>
            </a>
          </li>


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