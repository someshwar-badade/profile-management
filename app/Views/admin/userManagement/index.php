<?= $this->extend('admin/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
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
          <!-- <li class="breadcrumb-item"><a href="#">Library</a></li> -->
          <li class="breadcrumb-item active" aria-current="page">User Management</li>
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
      
      <div ng-controller="ServerSideProcessingCtrl as showCase">
        <div class="card">
          <div class="card-body">
            <small>
            <form action="<?= base_url(route_to('admin.user.excelReport')) ?>" method="post">
            <input type="hidden" name="filter"  value="{{tableFilter|json}}">
            <div class="card-heading">
              <h6>Filter:</h6>
            </div>
            <div class="row ">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Profile Plan:</label>
                  <div ng-dropdown-multiselect="" options="profile_plan_list" events="events" selected-model="selcected_profile_plan" extra-settings="example13settings"></div>
                  <!-- <select ng-model="tableFilter.profile_plan" multiple class="form-control">
                    <option value="P1">P1</option>
                    <option value="P2">P2</option>
                    <option value="P3">P3</option>
                    <option value="P4">P4</option>
                  </select> -->
                </div>


              </div>
              <div class="col-md-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Referral ID</label>
                    <input type="text" maxlength="6" placeholder="Referral ID" ng-model="tableFilter.referral_id"  class="form-control">
                  </div>
                </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Joining Date from:</label>
                  <input type="text" ng-change="changeDate()" ng-init="initializeDatepicker();" ng-model="tableFilter.date1" id="date1" class="form-control" placeholder="DD-MM-YYYY">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Joining Date to:</label>
                  <input type="text" ng-change="changeDate()" ng-init="initializeDatepicker();" ng-model="tableFilter.date2" id="date2" class="form-control" placeholder="DD-MM-YYYY">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Profile Status:</label>
                  <select ng-model="tableFilter.status" class="form-control">
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>

              <div class="col-md-2 align-self-center">
                <button type="button" class="btn btn-block btn-success btn-sm" onclick="$('form').submit()">Download Excel</button>
                <button type="button" class="btn btn-block btn-default btn-sm" ng-click="clearFilter()" >Clear Filter</button>
              </div>
              
            </div>
            </form>
            </small>
          </div>
        </div>
        <div class="card">
        <div class="card-header">
        <div class="card-tools">
            <a class="btn text-primary btn-tool" href="<?= base_url(route_to('admin.create_user')); ?>"> <i class="fa fa-plus"></i> Add User</a>
            <a class="btn text-primary btn-tool" href="<?= base_url(route_to('admin.upgradeMembersProfilePlan')); ?>"> Upgrade Profile Plans</a>
            <a class="btn text-primary btn-tool" href="<?= base_url(route_to('admin.membersShareDistribution')); ?>">View Distribution</a>
          <!-- <a class="btn text-primary btn-tool" href="<?= base_url(route_to('admin.category.create')); ?>"> <i class="fa fa-plus"></i> Add Category</a> -->
        </div>
        </div>
          <div class="card-body">
          <div class="table-responsive">
            <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="row-border hover table "></table>
          </div>
          </div>
        </div>
      </div>


    </div>
  </div>
  </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<script>
  app.controller('ServerSideProcessingCtrl', ServerSideProcessingCtrl);

  function ServerSideProcessingCtrl($scope,$http, DTOptionsBuilder, DTColumnBuilder) {
    $scope.tableFilter = {}
    var vm = this;
    vm.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        // Either you specify the AjaxDataProp here
        //  dataSrc: 'data',
        url: base_url + '/api/admin/users',
        type: 'POST',
        data: {
          filter: $scope.tableFilter
        }
      })
      // or here
      .withDataProp('data')
      .withOption('processing', true)
      .withOption('serverSide', true)
      .withPaginationType('full_numbers')
      .withOption('responsive', true);
    vm.dtColumns = [
      DTColumnBuilder.newColumn('id').withTitle('ID'),
      DTColumnBuilder.newColumn('first_name').withTitle('First name'),
      DTColumnBuilder.newColumn('last_name').withTitle('Last name'),
      DTColumnBuilder.newColumn('mobile').withTitle('Mobile'),
      // DTColumnBuilder.newColumn('email').withTitle('Email'),
      DTColumnBuilder.newColumn('joining_date').withTitle('Joining Date'),
      DTColumnBuilder.newColumn('profile_plan').withTitle('Profile Plan'),
      DTColumnBuilder.newColumn('referral_id').withTitle('Referral ID'),
      DTColumnBuilder.newColumn('status').withTitle('Profile Status').renderWith(function(data, type, full) {
        // return full.gender + ' ' + full.id;
        return full.status == '1' ? "<span class='text-success'>Active</span>" : "<span class='text-danger'>Inactive</span>";
      }).withClass('none'),
      DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {
        // return full.gender + ' ' + full.id;
        return "<a class='  btn-tool text-primary' href='" + base_url + "/admin/user/" + full.id + "'>Edit</a>" +
          "<a class='  btn-tool text-primary' href='" + base_url + "/admin/user/" + full.id + "/downline'>Downline</a>"+
          "<a class='  btn-tool text-primary' href='" + base_url + "/admin/user/" + full.id + "/viewDistribution'>Distribution</a>"
      })
    ];


    $scope.initializeDatepicker = function() {
      $('#date1').datetimepicker({
        format: 'd-M-Y',
        scrollInput: false,
        timepicker: false,
        maxDate: new Date(),
        onSelectDate: function() {
          $scope.tableFilter.date1 = $('#date1').val()
        }
      });
      $('#date2').datetimepicker({
        format: 'd-M-Y',
        scrollInput: false,
        timepicker: false,
        maxDate: new Date(),
        onSelectDate: function() {
          $scope.tableFilter.date2 = $('#date2').val()
        }
      });
    }

    $scope.tableFilter.profile_plan = [];
    $scope.selcected_profile_plan = [];
    $scope.profile_plan_list = JSON.parse('<?=json_encode($profilePlanList['data'])?>');;
    $scope.example13settings = {
      smartButtonMaxItems: 3,
      template: '{{option.code}}',
      buttonClasses: "btn btn-primary btn-sm",
      idProperty:'code',
      checkBoxes: true,
      showCheckAll:false,
      showUncheckAll:false,
      smartButtonTextConverter: function(skip, option) {
        return option.code;
      },
      
    };
    $scope.events = {
      onItemSelect:function(item){
        $scope.tableFilter.profile_plan.push(item.code);
        console.log($scope.tableFilter.profile_plan);
      },
      onItemDeselect:function(item){
        $scope.tableFilter.profile_plan = $scope.tableFilter.profile_plan.filter(function(e) { return e !== item.code });
        console.log($scope.tableFilter.profile_plan);
      }
    }

    $scope.clearFilter = function(){
      $scope.tableFilter.status='';
      $scope.tableFilter.date1='';
      $scope.tableFilter.date2='';
      $scope.tableFilter.referral_id='';
      $scope.tableFilter.profile_plan=[];
      ;}

    
  }
</script>

<?= $this->endSection() ?>