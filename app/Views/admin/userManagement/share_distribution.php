<?= $this->extend('admin/layouts/main') ?>


<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/js/gijgo-combined-1.9.13/css/gijgo.min.css') ?>">

<div class="content-wrapper" ng-controller="distributionListCtrl">
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
            <li class="breadcrumb-item active" aria-current="page">View Distribution</li>
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

        <div class="col-12">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <form id="searchForm" action="" method="get">
                    <!-- <input type="hidden" name="filter"  value="{{tableFilter|json}}"> -->
                    <div class="card-heading">
                      <h6>Filter:</h6>
                    </div>
                    <div class="row ">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Distribution Status:</label>
                          <!-- <div ng-dropdown-multiselect="" options="profile_plan_list" events="events" selected-model="selcected_profile_plan" extra-settings="example13settings"></div> -->
                          <select name="sr_status" id="sr_status" class="form-control ">
                            <option value="">All</Alloption>
                            <option value="pending" <?= $filter['status'] == 'pending' ? ' selected ' : '' ?>>Pending</opion>
                            <option value="distributed" <?= $filter['status'] == 'distributed' ? ' selected ' : '' ?>>Distributed</option>
                          </select>
                        </div>
                      </div>


                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">From:</label>
                          <input type="text" name="sr_date1" id="date1" value="<?= $filter['from_dt'] ? printFormatedDate($filter['from_dt']) : '' ?>" class="form-control datepicker" placeholder="DD-MM-YYYY">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">To:</label>
                          <input type="text" name="sr_date2" id="date2" value="<?= $filter['from_dt'] ? printFormatedDate($filter['to_dt']) : '' ?>" class="form-control datepicker" placeholder="DD-MM-YYYY">
                        </div>
                      </div>


                      <div class="col-md-2 align-self-center">
                        <input type="submit" id="searchBtn" name="submit-type" class="btn btn-block btn-success btn-sm" value="Search">
                        <input type="submit" id="downloadReportBtn" name="submit-type" class="btn btn-block btn-success btn-sm" value="Download Report">
                        <a href="<?= base_url(route_to('admin.membersShareDistribution')) ?>" class="btn btn-block btn-default btn-sm">Clear Filter</a>
                      </div>

                    </div>
                  </form>
                </div>
              </div>

              <div class="card">
                <div class="card-body ">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Profile ID</th>
                          <th>Order ID</th>
                          <th>Name</th>
                          <th>Product Name</th>
                          <th>Net Price</th>
                          <th>Distributed Amount</th>
                          <th>Distribution Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($list as $key => $item) { ?>
                          <tr>
                            <td><?= $key + 1; ?></td>
                            <td><a href="<?= base_url(route_to('admin.user', $item['user_id'])); ?>"><?= $item['user_id'] ?></a></td>
                            <td><a href="<?= base_url(route_to('admin.order.details', $item['order_id'])); ?>"><?= $item['order_id'] ?></a></td>

                            <td>
                              <b>Name: </b><?= $item['first_name'] ?> <?= $item['middle_name'] ?> <?= $item['last_name'] ?><br>
                              <b>Current Profile Plan: </b><?= $item['profile_plan'] ?><br>
                              <b>Joining Date: </b><?= date('d/M/Y', strtotime($item['joining_date'])) ?><br>
                            </td>
                            <td><?= $item['product_name'] ?></td>
                            <td><?= $item['product_netprice'] ?></td>
                            <td><?= $item['distribution_total_amount'] ? $item['distribution_total_amount'] : '- -' ?></td>
                            <td><?= $item['distribution_datetime'] ? printFormatedDate($item['distribution_datetime']) : '- -' ?></td>
                            <td>
                              <a href="javascript:void(0);" ng-click="nodeSelect(<?= $item['user_id'] ?>)">View</a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


            </div>

          </div>





        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Distribution </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <div class="row bg-secondary text-center" ng-show="loading">
            <div class="col-md-12">
              <div class="css-animated-loader" style="float: none;"></div>
            </div>
          </div>

          <div class="row" ng-show="!loading">

            <!-- <div class="col-md-12">
                  <table class="table table-bordered">
                    <tr>
                      
                      <td><b><?= lang('profile.profileId') ?>:</b> <span>{{selectedUser.id}}</span></td>
                      <td><b><?= lang('profile.personal.firstName.label') ?>:</b> <span>{{selectedUser.first_name}}</span></td>
                      <td><b><?= lang('profile.personal.middleName.label') ?>:</b> <span>{{selectedUser.middle_name}}</span></td>
                      <td><b><?= lang('profile.personal.lastName.label') ?>:</b> <span>{{selectedUser.last_name}}</span></td>
                    </tr>
                    <tr>
                      <td><b><?= lang('profile.profilePlan') ?>:</b> <span>{{selectedUser.profile_plan}}</span></td>
                      <td><b><?= lang('profile.personal.emailAddress.label') ?>:</b> <span>{{selectedUser.email}}</span></td>
                      <td><b><?= lang('profile.personal.mobile.label') ?>:</b> <span>{{selectedUser.mobile}}</span></td>
                      <td><b></b> <span></span></td>
                    </tr>
                  </table>
                
                </div> -->
            <div class="col-md-12">

              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <td><b>Product Name:</b> <span>{{selectedUser.membershipProduct.product_name}}</span></td>
                    <td><b>Net Price:</b> <span>{{selectedUser.membershipProduct.product_netprice}}</span></td>
                    <td><b>Distribution Time</b> <span>{{selectedUser.membershipProduct.distribution_datetime || "- -"}}</span></td>
                  </tr>

                </table>


                <table class="table table-stripped table-bordered">
                  <thead>
                    <tr>
                      <th>Level</th>
                      <th>Profile ID</th>
                      <th>Name</th>
                      <th>Profile Plan</th>
                      <th>Share %</th>
                      <th>Bonus %</th>
                      <th>Share Amount</th>
                      <th>Bonus Amount</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="member in uplineMembers">
                      <td>{{member.level}}</td>
                      <td>{{member.id}}</td>
                      <td>{{member.first_name}} {{member.middle_name}} {{member.last_name}}</td>
                      <td>{{member.profile_plan}}</td>
                      <td>{{member.minimum_share_percent}}</td>
                      <td>{{member.bonus_share_percent}}</td>
                      <td>{{member.minimum_share_amount}}</td>
                      <td>{{member.bonus_share_amount}}</td>
                      <td>{{member.total_amount}}</td>
                    </tr>
                    <tr>
                      <th colspan="4">Total:</th>
                      <td>{{sum.minimum_share_percent}}</td>
                      <td>{{sum.bonus_share_percent}}</td>
                      <td>{{sum.minimum_share_amount}}</td>
                      <td>{{sum.bonus_share_amount}}</td>
                      <td>{{sum.total_amount}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>

          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" ng-hide="selectedUser.membershipProduct.distribution_datetime" ng-click="processDistribution()">
            <div ng-show="loading" class="css-animated-loader"></div>Process
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  app.controller('distributionListCtrl', ['$scope', '$http', function($scope, $http) {
    $scope.selectedId = '';
    $scope.selectedUser = {};
    $scope.loading = false;
    $scope.nodeSelect = function(id) {
      $('#myModal').modal();
      $scope.selectedUser = {};
      $scope.membershipProduct = {};
      $scope.uplineMembers = {};
      $scope.sum = {};
      $scope.selectedId = id;

      $scope.errors = '';
      $scope.otpSuccessMsg = '';
      $scope.loading = true;
      $http({
        method: 'get',
        url: base_url + '/api/admin/user/' + $scope.selectedId + '/upline',


      }).then(function(response) {

        $scope.loading = false;
        $scope.selectedUser = response.data.member;
        $scope.membershipProduct = response.data.membershipProduct;
        $scope.uplineMembers = response.data.uplineMembers;
        $scope.sum = response.data.sum;
        $('#myModal img.user-photo').attr('src', $scope.selectedUser.photo);

        // $scope.$apply();
      }, function(response) {

        $scope.loading = false;
        $scope.errors = response.data.messages;

      });





    }

    $scope.processDistribution = function() {
      $scope.loading = true;
      $http({
        method: 'post',
        url: base_url + '/api/admin/user/' + $scope.selectedId + '/process-distribution',
        data: {
          'membership_product_id': $scope.selectedId
        }

      }).then(function(response) {

        $scope.loading = false;

        $('#myModal').modal('hide');
        window.location.reload();
        // $scope.selectedUser = response.data.member;
        // $scope.membershipProduct = response.data.membershipProduct;
        // $scope.uplineMembers = response.data.uplineMembers;
        // $('#myModal img.user-photo').attr('src',$scope.selectedUser.photo);

        // $scope.$apply();
      }, function(response) {

        $scope.loading = false;
        $scope.errors = response.data.messages;
        $('#myModal').modal('hide');
      });
    }

  }]);
</script>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<script>
  $('.datepicker').datetimepicker({
    format: 'd-M-Y',
    scrollInput: false,
    timepicker: false,
  });
</script>
<?= $this->endSection() ?>