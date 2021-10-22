<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(route_to('home')) ?>" class="brand-link">
      <img src="<?= base_url('assets/images/Logo-Maruti-Organic.png') ?>" alt="<?= lang('marutiorganic.site_title') ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= lang('marutiorganic.site_title') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{user.photo}}" onerror="this.src = '<?= base_url('assets/images/placeholder-employee.jpg') ?>'" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?=base_url(route_to('profile'))?>" class="d-block" ng-init="user.first_name='<?= ucfirst($_COOKIE['first_name']) ?>'">{{user.first_name}}</a>
        </div>
      </div>

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
            <a href="<?= base_url(route_to('dashboard')) ?>" class="nav-link <?=$active_nav=='dashboard'?' active ':'';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item <?=$active_nav_parent=='product-management'?' menu-is-opening menu-open ':'';?>">
            <a href="#" class="nav-link <?=$active_nav_parent=='product-management'?' active ':'';?>">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(route_to('admin.product.create')) ?>" class="nav-link <?=$active_nav=='product-create'?' active ':'';?>">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(route_to('admin.products')) ?>" class="nav-link <?=$active_nav=='product-management'?' active ':'';?>">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url(route_to('admin.profileplans')) ?>" class="nav-link <?=$active_nav_parent=='profileplan-management'?' active ':'';?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Profile Plans
              </p>
            </a>
          </li>

          <li class="nav-item <?=$active_nav_parent=='user-management'?' menu-is-opening menu-open ':'';?>">
            <a href="#" class="nav-link <?=$active_nav_parent=='user-management'?' active ':'';?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(route_to('admin.create_user')) ?>" class="nav-link <?=$active_nav=='user-create'?' active ':'';?>">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(route_to('admin.users')) ?>" class="nav-link <?=$active_nav=='user-management'?' active ':'';?>">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(route_to('admin.membersShareDistribution')); ?>" class="nav-link <?=$active_nav=='user-distribution'?' active ':'';?>">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>View Distribution</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?=$active_nav_parent=='category-management'?' menu-is-opening menu-open ':'';?>">
            <a href="#" class="nav-link <?=$active_nav_parent=='category-management'?' active ':'';?>">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(route_to('admin.category.create')); ?>" class="nav-link <?=$active_nav=='category-create'?' active ':'';?>">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(route_to('admin.categories')) ?>" class="nav-link <?=$active_nav=='category-management'?' active ':'';?>">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?=$active_nav_parent=='kyc-approval'?' menu-is-opening menu-open ':'';?>">
            <a href="<?= base_url(route_to('admin.kycApproval')) ?>" class="nav-link <?=$active_nav_parent=='kyc-approval'?' active ':'';?>">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                KYC Approval
              </p>
            </a>
          </li>

          <li class="nav-item <?=$active_nav_parent=='order-management'?' menu-is-opening menu-open ':'';?>">
            <a href="<?= base_url(route_to('admin.orders')) ?>" class="nav-link <?=$active_nav_parent=='order-management'?' active ':'';?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Orders
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>