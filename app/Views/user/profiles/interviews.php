<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
  a.remove-description {
    position: absolute;
    right: 15px;
    top: 5px;
  }

  .spinner-border {
    width: 1.5rem;
    height: 1.5rem;
  }

  .table-personal-info td,
  .table-personal-info th {
    padding: 2px;
    border: none;
  }
</style>
<div class="content-wrapper">
  <section class="content" ng-controller="ServerSideProcessingCtrl as showCase">
    <div class="container-fluid">

      <div class="row m-0">

        <div class="col-12">
          <h1>Interviews</h1>

          <div>
            <fieldset class="form-group p-3">
              <small>
                <legend class="w-auto px-2">Profile details</legend>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-personal-info">
                      <colgroup>
                        <col style="width: 150px;">
                        <col>
                      </colgroup>
                      <tbody>
                        <tr>
                          <td><label>Name: </label></td>
                          <td>{{showCase.profileForm.first_name}} {{showCase.profileForm.last_name}}</td>
                        </tr>
                        <tr>
                          <td><label>E-mail: </label></td>
                          <td>{{showCase.profileForm.email_primary}} &nbsp; {{showCase.profileForm.email_alternate}}</td>
                        </tr>
                        <tr>
                          <td><label>Mobile: </label></td>
                          <td>{{showCase.profileForm.mobile_primary}} &nbsp; {{showCase.profileForm.mobile_alternate}}</td>
                        </tr>
                        <tr>
                          <td><label>Gender: </label></td>
                          <td>{{showCase.profileForm.gender}}</td>
                        </tr>
                        <tr>
                          <td><label>Marital Status: </label></td>
                          <td>{{showCase.profileForm.martial_status}}</td>
                        </tr>
                        <tr>
                          <td><label>Date of Birth: </label></td>
                          <td>{{showCase.profileForm.dob}}</td>
                        </tr>
                        <tr>
                          <td><label>PAN Number: </label></td>
                          <td>{{showCase.profileForm.pan_number}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-personal-info">
                      <colgroup>
                        <col style="width: 250px;">
                        <col>
                      </colgroup>
                      <tbody>
                        <tr>
                          <td><label>Current company: </label></td>
                          <td>{{showCase.profileForm.current_company}}</td>
                        </tr>
                        <tr>
                          <td><label>Total Experience: </label></td>
                          <td>{{showCase.profileForm.total_experience}} Months</td>
                        </tr>
                        <tr>
                          <td><label>Relevant Experience: </label></td>
                          <td>{{showCase.profileForm.relevant_experience}} Months</td>
                        </tr>
                        <tr>
                          <td><label>Notice Period: </label></td>
                          <td>{{showCase.profileForm.notice_period}}</td>
                        </tr>
                        <tr>
                          <td><label>Is negotiable notice period?: </label></td>
                          <td>{{showCase.profileForm.is_negotiable_np=='1'?'Yes':'No'}}</td>
                        </tr>
                        <tr>
                          <td><label>Current CTC: </label></td>
                          <td>{{showCase.profileForm.ctc}}</td>
                        </tr>
                        <tr>
                          <td><label>Expected CTC: </label></td>
                          <td>{{showCase.profileForm.expected_ctc}}</td>
                        </tr>
                        <tr>
                          <td><label>Is negotiable expected CTC?: </label></td>
                          <td>{{showCase.profileForm.is_negotiable_ctc=='1'?'Yes':'No'}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>


              </small>
            </fieldset>
          </div>
          <div class="table-action">
            <div class="action text-right">
                            <button type="button" ng-click="showCase.viewInterviewForm();" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Add new</button>
            </div>



            <div class="table-responsive">
              <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="row-border hover"></table>
            </div>

          </div>
        </div>
      </div>


    </div><!-- /.container-fluid -->

    <!-- The Modal -->
    <div class="modal" id="viewProfileModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal header -->
          <div class="modal-header bg-primary">
           
            <h5 class="modal-title">Shedule an Interview</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
                <form>
                  <table class="table table-personal-info">
                    <colgroup>
                      <col style="width: 150px;">
                      <col>
                    </colgroup>
                    <tbody>
                      <tr>
                        <td>Company name<sup class="text-danger">*</sup></td>
                        <td>
                          <input type="text" maxlength="50" class="form-control" ng-model="showCase.interviewForm.company_name">
                        <div class="text-danger" ng-show="showCase.interviewFormErrors.company_name">{{showCase.interviewFormErrors.company_name}}</div>
                      </td>
                      </tr>
                      <tr>
                        <td>Interview taken by<sup class="text-danger">*</sup></td>
                        <td><input type="text" maxlength="50" class="form-control" ng-model="showCase.interviewForm.interview_taken_by">
                        <div class="text-danger" ng-show="showCase.interviewFormErrors.interview_taken_by">{{showCase.interviewFormErrors.interview_taken_by}}</div></td>
                      </tr>
                      <tr>
                        <td>For role<sup class="text-danger">*</sup></td>
                        <td><input type="text" maxlength="20" class="form-control" ng-model="showCase.interviewForm.for_role">
                        <div class="text-danger" ng-show="showCase.interviewFormErrors.for_role">{{showCase.interviewFormErrors.for_role}}</div></td>
                      </tr>
                      <tr>
                        <td>Schedule date<sup class="text-danger">*</sup></td>
                        <td><input type="text" maxlength="20" class="form-control datepicker" ng-init="showCase.initializeDatepicker();" ng-model="showCase.interviewForm.schedule_dt">
                        <div class="text-danger" ng-show="showCase.interviewFormErrors.schedule_dt">{{showCase.interviewFormErrors.schedule_dt}}</div></td>
                      </tr>
                      <tr>
                        <td>Status<sup class="text-danger">*</sup></td>
                        <td>
                          <select class="form-control" ng-model="showCase.interviewForm.status">
                            <option value="">Select</option>
                            <option value="1">Cancled</option>
                            <option value="2">Hold</option>
                            <option value="3">In Process</option>
                            <option value="4">Missed</option>
                            <option value="5">Not Selected</option>
                            <option value="6">Selected</option>
                            <option value="7">Sheduled</option>
                          </select>
                        <div class="text-danger" ng-show="showCase.interviewFormErrors.status">{{showCase.interviewFormErrors.status}}</div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">

            <button type="button" class="btn btn-sm btn-primary" ng-click="showCase.saveInterviewForm()">Save</button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-label="Close">Close</button>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content-header -->


</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
  app.controller('ServerSideProcessingCtrl', ServerSideProcessingCtrl);

  function ServerSideProcessingCtrl($scope, DTOptionsBuilder, DTColumnBuilder, $compile, $http) {
    var vm = this;
    vm.tableFilter = {};
    vm.profileForm = {};
    vm.interviewForm = {};
    vm.interviewFormErrors = {};
    
    vm.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        // Either you specify the AjaxDataProp here
        // dataSrc: 'data',
        url: base_url + '/api/interviews/<?= $id ?>',
        data: {
          filter: $scope.tableFilter
        },
        type: 'GET'
      })
      // or here
      .withDataProp('data')
      .withOption('processing', true)
      .withOption('serverSide', true)
      .withPaginationType('full_numbers')
      .withOption('createdRow', function(row) {
        // Recompiling so we can bind Angular directive to the DT
        $compile(angular.element(row).contents())($scope);
      })
      .withOption('responsive', true);;
    vm.dtColumns = [
      DTColumnBuilder.newColumn("id").withTitle('ID'),
      DTColumnBuilder.newColumn("company_name").withTitle('Company Name'),
      DTColumnBuilder.newColumn("interview_taken_by").withTitle('Interview taken by'),
      DTColumnBuilder.newColumn("for_role").withTitle('For role'),
      DTColumnBuilder.newColumn("schedule_dt").withTitle('Shedule date'),
      DTColumnBuilder.newColumn("status").withTitle('Status').renderWith(function(data,type, full){
        var status_str='';
        switch(data){
          case '1': status_str='Cancled';
            break;
          case '2': status_str='Hold';
            break;
          case '3': status_str='In Process';
            break;
          case '4': status_str='Missed';
            break;
          case '5': status_str='Not Selected';
            break;
          case '6': status_str='Selected';
            break;
          case '7': status_str='Sheduled';
            break;

        }
        
        return status_str;

      }),
      DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {
        // return full.gender + ' ' + full.id;
        //href='" + base_url + "/profile/" + full.id + "/edit'
        var html = '<div class="dropdown">' +
          '<button class="btn" type="button" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>' +
          '<ul class="dropdown-menu">' +
          "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.viewInterviewForm(" + full.id + ")' ><i class='far fa-eye'></i> Edit</a></li>" +
          // "<li> <a role='button' class='mx-2 text-default' href='"+ base_url + "/send-joining-form?profile_id="+full.id+"'><i class='far fa-paper-plane'></i> Send Joining Form</a></li>"+
          "<li> <a role='button' class='mx-2 text-default' ng-click='showCase.deleteClick(" + full.id + ")' ><i class='fas fa-trash-alt'></i> Delete</a></li>" +
          '</ul>'
        '</div>';


        return html;

      }).notSortable(),

    ];

    vm.clearFilter = function() {
      vm.tableFilter.status = '';
      vm.tableFilter.title = '';;
    }

    vm.initializeDatepicker = function() {
            $('.past-datepicker').datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false,
                maxDate: new Date(),
                // validateOnBlur:false,
                // onSelectDate: function() {
                //   $scope.joiningForm.dob = $(el).val()
                // }
            });

            $('.datepicker').datetimepicker({
                format: 'd-M-Y H:i',
                scrollInput: false,
                timepicker: true,
                // validateOnBlur:false,
                // onSelectDate: function(el) {
                //   console.log(el);
                //  $scope.interviewForm.schedule_dt = el;
                // }
            });
        }

    vm.viewInterviewForm = function(id='') {
      vm.interviewForm = {};
      vm.interviewFormErrors = {};
      $('#viewProfileModal').modal('toggle');
      // get profile details
      if(id!=''){

          $http({
            method: 'get',
            url: base_url + '/api/interviews/'+vm.profileForm.id+'/' + id,
          }).then(function(response) {
            console.log(response);
            vm.interviewForm = response.data;
            //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
          }, function(response) {
    
    
          });
      }
    }

    vm.saveInterviewForm = function() {
      
      vm.interviewFormErrors='';
      vm.interviewForm.profile_id =  vm.profileForm.id;
      // get profile details
      $http({
        method: 'post',
        url: base_url + '/api/interviews/' + vm.profileForm.id,
        data:vm.interviewForm
      }).then(function(response) {
        console.log(response);
        $('#viewProfileModal').modal('toggle');
        vm.interviewForm = {};
        //$scope.profileForm = response.data;
       // $scope.profile.editUrl = base_url + "/profile/" + $scope.profile.id + "/edit";
      }, function(response) {

        vm.loading = false;
        vm.interviewFormErrors = response.data.messages;
        if (response.data.status == 403) {
            toastr.error(response.data.messages.errorMessage);
        } else {
            toastr.error("Something went wrong !!");
        }
      });
    }

    vm.deleteClick = function(id) {

      if (!confirm("Do you want to delete this record (ID:" + id + ").")) return false;

      $http({
          method: 'delete',
          url: base_url + '/api/interviews/' + id,

        })
        .then(function(response) {
          vm.editMode = false;
          vm.loading = false;
          window.location = base_url + '/interviews';
        }, function(response) {

          vm.loading = false;
          vm.errors = response.data.messages;
          
        });
    }

    // get profile details
    $http({
      method: 'get',
      url: base_url + '/api/profiles/' + <?= $id ?>,
    }).then(function(response) {
      console.log(response);
      vm.profileForm = response.data;
    }, function(response) {


    });
  }
</script>
<?= $this->endSection() ?>