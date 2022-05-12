<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
  .spinner-border {
    width: 1.5rem;
    height: 1.5rem;
  }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">

      <div class="row mb-2">
        <div>
          <h1>Change password</h1>
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->
  <section ng-cloak class="content" ng-controller="addProfileCtrl">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="card card-primary">
          <nav class="navbar navbar-expand sticky-form-header">
            <div ng-show="loading" class="spinner-border text-primary"></div>
            <div class="text-success">{{successMessage}}</div>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><button class="btn btn-sm btn-success " ng-click="submitClick()">
                  Save</button>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(route_to('user-dashboard')) ?>" class="btn btn-sm btn-secondary ml-2">Cancel</a>

              </li>
            </ul>
          </nav>

          <div class="card-body">

            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Current Password <sup class="text-danger">*</sup></label>
              <div class="col-sm-9">
                <input type="password" id="current_password" ng-model="current_password" maxlength="30" name="current_password" class="form-control">
                <div class="text-danger" ng-show="errors.current_password">{{errors.current_password}}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3" for="inputName">New Password <sup class="text-danger">*</sup></label>
              <div class="col-sm-9">
                <input type="password" id="new_password" ng-model="new_password" maxlength="30" name="new_password" class="form-control">
                <div class="text-danger" ng-show="errors.new_password">{{errors.new_password}}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3" for="inputName">Confirm Password <sup class="text-danger">*</sup></label>
              <div class="col-sm-9">
                <input type="password" id="confirm_password" ng-model="confirm_password" maxlength="30" name="confirm_password" class="form-control">
                <div class="text-danger" ng-show="errors.confirm_password">{{errors.confirm_password}}</div>
              </div>
            </div>



            <!-- </div> -->


          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
  app.controller('addProfileCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {

    $scope.editMode = false;
    $scope.loading = false;
    $scope.errors = '';
    $scope.successMessage = '';

    // $scope.slugify = function() {
    //     $scope.formData.slug = slugifyFilter($scope.formData.lang.en.title);
    // }
    //$scope.formData.slug = urlencodeFilter($scope.formData.en.title);


    $scope.submitClick = function() {

      $scope.errors = '';
      $scope.otpSuccessMsg = '';
      $scope.loading = true;
      $scope.successMessage = '';
      console.log($scope.profile);
      var apiUrl = base_url + '/api/user/profile/change-password';
      var method = "POST";

      $http({
        method: method,
        url: apiUrl,
        data: {
          'current_password': $scope.current_password,
          'new_password': $scope.new_password,
          'confirm_password': $scope.confirm_password
        }
      }).then(function(response) {
        $scope.editMode = false;
        $scope.loading = false;
        $scope.successMessage = response.data.success;
        $scope.current_password = '';
        $scope.new_password = '';
        $scope.confirm_password = '';
        // window.location = base_url + '/profiles';
      }, function(response) {

        $scope.loading = false;
        $scope.errors = response.data.messages;
        console.log($scope.errors);
        console.log($scope.errors['lang.en.title']);
      });

    }



  }]);
</script>
<?= $this->endSection() ?>