<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row m-0">

                <div class="col-12">
                    <h1>Employees</h1>
                    <br><br>


                    <div class="table-action">

                        <!-- <div class="filter">
                            <form class="form-inline">
                                <div class="form-group search-box mb-2 mr-2">
                                    <input id="txtSearch" value="" type="search" class="form-control w-100" placeholder="Search by Name, Mobile No.">
                                </div>
                                <button id="btnSearch" type="button" class="btn btn-primary primary-color search-button mb-2">
                                    <img src="/images/search-white-icon.svg" alt="Search">
                                </button>
                            </form>
                        </div> -->


                        <div class="action text-right">
                            <button type="submit" class="btn btn-primary button mb-2 add-breed" data-toggle="modal" data-target="#addemployeeModal"> Add New Employee</button>
                        </div>

                        <div ng-controller="ServerSideProcessingCtrl as showCase">
                            <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="row-border hover"></table>
                        </div>
                        <br><br><br><br><br><br>
                    </div>
                    <!-- Desktop View Start here -->
                    <!-- <div class="desktop-view">
                        <div class="table-list table-responsive">
                            <table class="table table-sm table-bordered table-width-auto">
                                <thead>
                                    <tr>
                                        <th width="50" class="text-center"></th>
                                        <th width="250">Name</th>
                                        <th width="270">Email ID / Mobile No.</th>

                                        <th width="90">Role</th>
                                        <th width="70" class="text-center">Edit</th>
                                        <th width="70" class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><input type="checkbox"></td>
                                        <td>Aditya &nbsp; Belsare</td>
                                        <td>8793087874</td>

                                        <td>Supervisor</td>
                                        <td class="text-center"><a href="/AddEmployee?EmpId=9105"><img src="images/edit.svg" alt="edit"></a></td>
                                        <td class="text-center"><a href="#" onclick="ConfirmBox(function () { window.location.href='/DeleteEmployee?EmpId=9105'; });"><img src="images/remove.svg" alt="remove"></a></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><input type="checkbox"></td>
                                        <td>Prathamesh &nbsp; Kumbhar</td>
                                        <td>7878787878</td>

                                        <td>Supervisor</td>
                                        <td class="text-center"><a href="/AddEmployee?EmpId=9105"><img src="images/edit.svg" alt="edit"></a></td>
                                        <td class="text-center"><a href="#" onclick="ConfirmBox(function () { window.location.href='/DeleteEmployee?EmpId=9105'; });"><img src="images/remove.svg" alt="remove"></a></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><input type="checkbox"></td>
                                        <td>someshwar &nbsp; Badade</td>
                                        <td>8080808080</td>

                                        <td>Supervisor</td>
                                        <td class="text-center"><a href="/AddEmployee?EmpId=9105"><img src="images/edit.svg" alt="edit"></a></td>
                                        <td class="text-center"><a href="#" onclick="ConfirmBox(function () { window.location.href='/DeleteEmployee?EmpId=9105'; });"><img src="images/remove.svg" alt="remove"></a></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div> -->
                    <!-- Desktop View End here -->

                    <br>
                    <div id="paging" class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <ul class="pagination container">
                                <li id="prev" class="paginate_button page-item previous disabled"><a href="#" class="page-link">Previous</a></li>
                                <li id="1" class="paginate_button page-item active"><a href="#" class="page-link">1</a></li>
                                <li id="next" class="paginate_button page-item next disabled"><a href="#" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<!-- The Add Employee Modal -->
<div class="modal" id="addemployeeModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">

                <section class="abutsSection  align-items-center d-flex ">

                    <div class="container mt-10">

                        <div class="row justify-content-center align-items-center">

                            <h2><?= lang('forms.addemployee.formHeading') ?></h2>
                            <div class="col-md-12 p-3">
                                <br>
                            </div>

                            <div ng-controller="addEmployeeCtrl" class="col-md-12 p-0">

                                <div class="RegitserForm">


                                    <div class="add-employee-form">
                                        <div class="form">
                                            <form ng-cloak name="addemployeeForm" id="addemployeeForm" action="<?php echo base_url('User/addemployee'); ?>" method="POST">

                                                <!-- <input name="__RequestVerificationToken" type="hidden" value="9KSR6gYe11NTT9acglcBLcGhaHJmTmlYJAtaAFYfUnvwxTxic-2erp2pdejcf-RBJ44dr0nNGVP089Hsx_tT7c8LXDxVHd1U3VeNA_w2EiELQZ1R0"> -->

                                                <input data-val="true" data-val-number="The field UserId must be a number." data-val-required="The UserId field is required." id="UserId" name="UserId" type="hidden" value="0">
                                                <div class="row">
                                                    <div class="form-group col-lg-5 col-sm-6 col-6">
                                                        <label>First Name<span class="text-danger">*</span></label>
                                                        <input class="form-control char-only" ng-model="fname" data-val="true" data-val-maxlength="Maximum 150 characters allowed." data-val-maxlength-max="150" data-val-regex="Please enter first name" data-val-regex-pattern=".*\S+.*" data-val-required="Please enter first name" id="fname" maxlength="150" name="fname" placeholder="First Name" type="text" value="">
                                                        <span class="field-validation-valid text-danger" data-valmsg-for="FirstName" data-valmsg-replace="true"></span>
                                                    </div>
                                                    <div class="form-group col-lg-5  col-sm-6 col-6">
                                                        <label>Last Name</label>
                                                        <input class="form-control char-only" ng-model="lname" data-val="true" data-val-maxlength="Maximum 150 characters allowed." data-val-maxlength-max="150" data-val-regex="Please enter last name" data-val-regex-pattern=".*\S+.*" data-val-required="Please enter last name" id="lname" maxlength="150" name="lname" placeholder="Last Name" type="text" value="">
                                                        <span class="field-validation-valid text-danger" data-valmsg-for="LastName" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-5 col-sm-6 col-6">
                                                        <label>Login Id (Email id)<span class="text-danger">*</span></label>
                                                        <input autocomplete="false" ng-model="email" class="form-control text-box single-line" data-val="true" data-val-maxlength="Maximum 150 characters allowed." data-val-maxlength-max="150" data-val-regex="Please enter valid email or phone" data-val-regex-pattern="^[a-zA-Z0-9.!#$%&amp;'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$|^[0-9]{10}$" data-val-required="Please enter email or phone" id="LoginId" maxlength="150" name="LoginId" placeholder="Email" type="text" value="">
                                                        <span class="field-validation-valid text-danger" data-valmsg-for="LoginId" data-valmsg-replace="true"></span>
                                                    </div>
                                                    <div class="form-group col-lg-5  col-sm-6 col-6">
                                                        <label>Role<span class="text-danger">*</span></label>
                                                        <select ng-model="user_role" class="form-control" data-val="true" data-val-number="The field Employee Role must be a number." data-val-required="Please select employee role." id="user_role" name="user_role">
                                                            <option value="">Please Select</option>
                                                            <option value="worker">Worker</option>
                                                            <option value="supervisor">Supervisor</option>
                                                        </select>
                                                        <span class="field-validation-valid text-danger" data-valmsg-for="EmpTypeId" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-5 col-sm-6 col-6">
                                                        <label>Password<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input autocomplete="new-password" ng-model="password" class="form-control text-box single-line password" data-val="true" data-val-maxlength="Maximum 35 characters allowed." data-val-maxlength-max="35" data-val-minlength="Password must have at least 8 characters." data-val-minlength-min="8" data-val-required="Please enter password" id="password" name="password" placeholder="Password" type="password" value="">
                                                            <!-- <div class="input-group-append password-view">
                                                                    <span class="input-group-text" id="inputGroupPrepend"><img src="images/password-view-icon.png"></span>
                                                                </div> -->
                                                        </div>
                                                        <span class="field-validation-valid text-danger" data-valmsg-for="password" data-valmsg-replace="true"></span>
                                                        <!-- <input type="password" class="form-control" placeholder="Password"> -->
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="form-button col-lg-8 offset-lg-2 col-sm-12 col-12 text-right">
                                                        <br><br>
                                                        <!-- <button type="button" class="btn btn-success"> Create</button> -->
                                                        <button type="button" ng-disabled="loading" ng-click="submitClick()" class="btn btn-success knowmore">
                                                            <div ng-show="loading" class="css-animated-loader"></div><?= lang('forms.addemployee.submitBtn.label') ?>
                                                        </button>
                                                        &nbsp;&nbsp;
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
</div>




<!-- Confirm Modal start here-->
<!-- <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
            </div>
            <div class="modal-body">
                Are you sure to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" id="btnConfirmYes" class="btn green-button">Yes</button>
                <button type="button" class="btn red-button" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div> -->
<!-- Confirm Modal end here-->

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url('assets/js/angular/controllers/addEmployeeCtrl.js?v=1.1') ?>"></script>
<script src="<?= base_url('assets/js/angular/controllers/editEmployeeCtrl.js?v=1.1') ?>"></script>

<script>
    app.controller('ServerSideProcessingCtrl', ServerSideProcessingCtrl);

    function ServerSideProcessingCtrl($scope, DTOptionsBuilder, DTColumnBuilder) {
        $scope.tableFilter = {};
        var vm = this;
        vm.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                // dataSrc: 'data',
                url: base_url + '/api/employees',
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
            .withOption('responsive', true);;
        vm.dtColumns = [
            DTColumnBuilder.newColumn("id").withTitle('ID'),
            DTColumnBuilder.newColumn("fname").withTitle('Name'),
            DTColumnBuilder.newColumn("email").withTitle('Login Id'),
            DTColumnBuilder.newColumn("user_role").withTitle('Role'),
            DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {
                // return full.gender + ' ' + full.id;
                return "<a class='btn mx-1 btn-sm btn-primary' href='" + base_url + "/employees/" + full.id + "/edit'>Edit</a>"
                        + "<a class='btn mx-1 btn-sm btn-danger' ng-click='showCase.deleteClick("+full.id+")' >Delete</a>";
                
            }).notSortable(),

        ];

        $scope.clearFilter = function() {
            $scope.tableFilter.status = '';
            $scope.tableFilter.title = '';;
        }

        vm.deleteClick = function(id) {
           
           if(!confirm("Do you want to delete this record.")) return false;

           $http({
                   method: 'delete',
                   url: base_url + '/api/employees/' + id,

               })
               .then(function(response) {
                   $scope.editMode = false;
                   $scope.loading = false;
                   window.location = base_url + '/employees';
               }, function(response) {

                   $scope.loading = false;
                   $scope.errors = response.data.messages;
                   console.log($scope.errors);
                   console.log($scope.errors['lang.en.title']);
               });
       }
    }
</script>

<?= $this->endSection() ?>