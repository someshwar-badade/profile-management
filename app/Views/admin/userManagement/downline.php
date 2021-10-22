<?= $this->extend('admin/layouts/main') ?>


<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/js/gijgo-combined-1.9.13/css/gijgo.min.css') ?>">
<style>
  #tree .list-group-item.active ul li{
	background-color: #c8c8c8;
}
  #tree li.list-group-item div[data-role="wrapper"]:only-child>span.gj-tree-material-icons-expander:before{
	content: "\f111";
	font-family: "Font Awesome 5 Free";
  font-weight:900;
}
</style>
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
          <li class="breadcrumb-item active" aria-current="page">Downline</li>
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
        <div class="card-header downline-for">
        Downline for <?= $user['first_name'] ?> <?= $user['last_name'] ?> (<?= $user['id'] ?>) <span class="child-count"></span>
        </div>
        <div class="card-body">
        <div id="tree" style="text-transform: capitalize;"></div>
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
          <h4 class="modal-title">Member Details </h4>
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

            <div class="col-md-2">
              <img class="img-thumbnail user-photo" src="{{selectedUser.photo}}" onerror="this.src = '<?= base_url('assets/images/placeholder-employee.jpg') ?>'">
            </div>
            <div class="col-md-4">
              <dl class="row">
                <dt class="col-md-6"><?= lang('profile.profileId') ?>:</dt>
                <dd class="col-md-6">{{selectedUser.id}}</dd>


                <dt class="col-md-6"><?= lang('profile.personal.firstName.label') ?>:</dt>
                <dd class="col-md-6">{{selectedUser.first_name}}</dd>

                <dt class="col-md-6"><?= lang('profile.personal.middleName.label') ?>:</dt>
                <dd class="col-md-6">{{selectedUser.middle_name}}</dd>

                <dt class="col-md-6"><?= lang('profile.personal.lastName.label') ?>:</dt>
                <dd class="col-md-6">{{selectedUser.last_name}}</dd>

              </dl>
            </div>
            <div class="col-md-4">
              <dl class="row">

                <dt class="col-md-6"><?= lang('profile.profilePlan') ?>:</dt>
                <dd class="col-md-6">{{selectedUser.profile_plan}}</dd>

                <dt class="col-md-6"><?= lang('profile.personal.emailAddress.label') ?>:</dt>
                <dd class="col-md-6">{{selectedUser.email}}</dd>

                <dt class="col-md-6"><?= lang('profile.personal.mobile.label') ?>:</dt>
                <dd class="col-md-6">{{selectedUser.mobile}}</dd>

                <dt class="col-md-6"><?= lang('profile.personal.joiningDate.label') ?>:</dt>
                <dd class="col-md-6">{{selectedUser.joining_date}}</dd>
              </dl>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
</div>


<script src="<?= base_url('assets/js/gijgo-combined-1.9.13/js/gijgo.min.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>

<script>
  app.controller('downlineCtrl', ['$scope', '$http', function($scope, $http) {
    $scope.selectedId = '';
    $scope.selectedUser = {};
    $scope.loading = false;
    $scope.nodeSelect = function(id) {
      $scope.selectedUser = {};
      $scope.selectedId = id;

      $scope.errors = '';
      $scope.otpSuccessMsg = '';
      $scope.loading = true;
      $http({
        method: 'get',
        url: base_url + '/api/admin/user/' + $scope.selectedId,


      }).then(function(response) {

        $scope.loading = false;
        $scope.selectedUser = response.data;
        $('#myModal img.user-photo').attr('src', $scope.selectedUser.photo);
        $scope.$apply();
      }, function(response) {

        $scope.loading = false;
        $scope.errors = response.data.messages;

      });
    }
  }]);
  var scope = angular.element('body').scope();
  $(document).ready(function() {

    //scope.$apply(function () {scope.YourAngularJSFunction()});  
    var tree, onSuccessFunc;
    onSuccessFunc = function(response) {
      //you can modify the response here if needed

      if (response.length > 0) {
        tree.render(response);
      } else {
        $('#tree').html('Downline is empty.');
      }

      $('.downline-for span.child-count').html('[Direct Members: ' + response.length + ']');
    };

    tree = $('#tree').tree({
      primaryKey: 'id',
      uiLibrary: 'bootstrap4',
      dataSource: {
        url: base_url + '/api/admin/user/' + <?= $user['id'] ?> + '/downline',
        success: onSuccessFunc
      },
      dragAndDrop: false
    });

    tree.on('nodeDrop', function(e, id, parentId, orderNumber) {

      $.ajax({
          url: base_url + '/api/admin/user/' + id + '/personal-details',
          data: JSON.stringify({
            "referral_id": parentId
          }),
          method: 'POST',
          dataType: 'JSON',
          ContentType: 'application/json; charset=UTF-8'
        })

        .fail(function() {
          alert('Failed to save.');
        });
    });

    tree.on('select', function(e, node, id) {
      //alert('select is fired for node with id=' + id);
      angular.element($('div[ng-controller="downlineCtrl"]')).scope().nodeSelect(id);
      $('#myModal').modal();
    });
  });
</script>
<?= $this->endSection() ?>