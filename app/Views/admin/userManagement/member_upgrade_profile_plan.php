<?= $this->extend('admin/layouts/main') ?>


<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/js/gijgo-combined-1.9.13/css/gijgo.min.css') ?>">

<div class="content-wrapper" ng-controller="downlineCtrl">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url(route_to('dashboard')) ?>">Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="<?= base_url(route_to('admin.users')) ?>">User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Upgrade Profile Plan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row m-0">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body ">
              <div class="table-responsive">



                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Profile ID</th>
                      <th>Name</th>
                      <!-- <th>Current Profile Plan</th>
                  <th>Joining Date</th> -->
                      <th>P2<p><small>3 Members Within 30 days</small></p>
                      </th>
                      <th>P3<p><small>6 Members Within 60 days</small></p>
                      </th>
                      <th>P4<p><small>9 Members Within 90 days</small></p>
                      </th>
                      <th>P5<p><small>4 Members With P4 Plan</small></p>
                      </th>
                      <th>Remark</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($list as $item) { ?>
                      <tr>
                        <td><?= $item['referral_id'] ?></td>
                        <td>
                          <b>Name: </b><?= $item['first_name'] ?> <?= $item['middle_name'] ?> <?= $item['last_name'] ?><br>
                          <b>Current Profile Plan: </b><?= $item['profile_plan'] ?><br>
                          <b>Joining Date: </b><?= date('d/M/Y', strtotime($item['joining_date'])) ?><br>
                          <a href="<?= base_url(route_to('admin.downline', $item['referral_id'])) ?>" target="_blank"><b>Direct Members: </b><?= $item['directMemberCount'] ?></a><br>
                        </td>
                        <!-- <td><?= $item['profile_plan'] ?></td>
                    <td><?= $item['joining_date'] ?></td> -->
                        <td><b>Members: <?= $item['member_count_for_upgrade_to_p2'] ?></b>
                          <?= $item['upgrade_to'] == 'P2' ? '<h5 class="text-success">Eligibal</h5>' : '' ?>
                          <!-- <p>Eligibal:<?= $item['upgrade_to'] == 'P2' ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' ?></p> -->
                        </td>
                        <td> <b>Members: <?= $item['member_count_for_upgrade_to_p3'] ?></b>
                          <?= $item['upgrade_to'] == 'P3' ? '<h5 class="text-success">Eligibal</h5>' : '' ?>
                          <!-- <p>Eligibal:<?= $item['upgrade_to'] == 'P3' ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' ?></p> -->
                        </td>
                        <td><b>Members: <?= $item['member_count_for_upgrade_to_p4'] ?></b>
                          <?= $item['upgrade_to'] == 'P4' ? '<h5 class="text-success">Eligibal</h5>' : '' ?>
                          <!-- <p>Eligibal:<?= $item['upgrade_to'] == 'P4' ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' ?></p> -->
                        </td>
                        <td><b>Members: <?= $item['member_count_for_upgrade_to_p5'] ?></b>
                          <?= $item['upgrade_to'] == 'P5' ? '<h5 class="text-success">Eligibal</h5>' : '' ?>
                        </td>
                        <td><?= $item['remark']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<?= $this->endSection() ?>