<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
    .profile-user-img {
        height: 100px;
        object-fit: contain;
    }
    .edit-contact{
        background-color: rgba(0, 255, 0,.2);
    }
</style>
<div class="clients content-wrapper">
    <section ng-cloak class="content" ng-controller="clientsCtrl">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-6">
                    <h1>Clients</h1>
                </div>
                <div class="col-6 mt-3">

                    <div class="filter text-right">
                        <div class="custom-control custom-radio d-inline mr-3">
                            <input class="custom-control-input custom-control-input-secondary" ng-change="getClientsList()" type="radio" id="filterAll" value="" ng-true-value="" name="filterStatus" ng-model="filterForm.status">
                            <label for="filterAll" class="custom-control-label text-secondary">All ({{allCount}})</label>
                        </div>
                        <div class="custom-control custom-radio d-inline mr-3">
                            <input class="custom-control-input" type="radio" id="filterActive" ng-change="getClientsList()" name="filterStatus" value="1" ng-true-value="1" ng-model="filterForm.status">
                            <label for="filterActive" class="custom-control-label text-primary">Active ({{activeCount}})</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input class="custom-control-input custom-control-input-danger" type="radio" ng-change="getClientsList()" id="filterInactive" value="0" ng-true-value="0" name="filterStatus" ng-model="filterForm.status">
                            <label for="filterInactive" class="custom-control-label text-danger">Inactive ({{inactiveCount}})</label>
                        </div>
                    </div>

                </div>
            </div>



            <div class="row">

                <?php for ($i = 0; $i < 6; $i++) { ?>
                    <div ng-show="clientsPlaseholder" class="col-md-2 animation">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="image-placeholder placeholder">
                                </div>
                                <h3>
                                    <div class="text-placeholder placeholder"></div>
                                </h3>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div ng-repeat="client in clientsList" class="animation col-md-2">
                    <div class="card  card-outline" ng-class="{'card-primary':client.status=='1','card-danger':client.status=='0'}">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- <img class="profile-user-img img-fluid img-circle" ng-src="{{base_url+'/assets/images/placeholder-employee.jpg'}}" alt="User profile picture"> -->
                                <img class="profile-user-img img-fluid img-circle" ng-src="{{base_url+'/'+client.logo}}" onError="this.src= base_url+'/assets/images/placeholder-employee.jpg'" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{client.client_name}}</h3>

                            <!-- <p class="text-muted text-center">Status:{{client.status=='1'}}</p> -->

                            <!-- <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                            </ul> -->

                            <button class="btn btn-sm client-contacts-btn" ng-click="viewClientContacts(client);" title="Contacts ({{client.clientContacts.length}})">
                                <i class="fas fa-user-plus text-secondary"></i>
                                <span class="badge badge-secondary ">{{client.clientContacts.length}}</span>
                            </button>
                            <button ng-click="viewClient(client.id);" class="btn btn-primary btn-block"><b>Edit</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>



                <div class="animation col-md-2">
                    <div class="card" style="background: grey;border: dashed;">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- <img class="profile-user-img img-fluid img-circle" ng-src="{{base_url+'/assets/images/placeholder-employee.jpg'}}" alt="User profile picture"> -->
                                <img class="profile-user-img img-fluid img-circle" src="" onError="this.src= base_url+'/assets/images/placeholder-employee.jpg'" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">&nbsp;</h3>

                            <!-- <p class="text-muted text-center">Status:{{client.status=='1'}}</p> -->

                            <!-- <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                            </ul> -->

                            <!-- <button class="btn btn-sm client-remove-btn" title="Remove"><i class="fa fa-times text-secondary"></i></button> -->
                            <button ng-click="viewClient();" class="btn btn-warning btn-block"><b><i class="fa fa-plus"></i> Add client</b></button>


                            <!-- <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{base_url+'/assets/images/placeholder-employee.jpg'}}" alt="User profile picture">
                            </div> -->

                            <!-- <h3 class="profile-username text-center">Client Name</h3> -->

                            <!-- <p class="text-muted text-center">Software Engineer</p> -->

                            <!-- <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                            </ul> -->

                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Add New</b></a> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>


            </div>
        </div>
        <!-- The Modal -->
        <div class="modal" id="viewClientModal">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header p-2 bg-primary">
                        <h5 class="modal-title">Client Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Client Name<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="50" class="form-control form-control-sm" ng-model="clientForm.client_name">
                                            <div class="text-danger" ng-show="clientFormErrors.client_name">{{clientFormErrors.client_name}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Logo</label>

                                        <div class="col-sm-9">
                                            <img ng-show="client.logo" ng-src="{{base_url+'/'+clientForm.logo}}" style="width: 80px;height:80px;object-fit:content;">
                                            <input type="file" id="logo" file-input="logo" class="form-control" ngf-select>
                                            <div class="text-danger" ng-show="clientFormErrors.logo">{{clientFormErrors.logo}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Status<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-radio d-inline mr-3">
                                                <input class="custom-control-input" type="radio" id="customRadio1" name="status" value="1" ng-true-value='1' ng-model="clientForm.status">
                                                <label for="customRadio1" class="custom-control-label text-primary">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline">
                                                <input class="custom-control-input custom-control-input-danger" type="radio" id="customRadio2" value="0" ng-true-value='0' name="status" ng-model="clientForm.status">
                                                <label for="customRadio2" class="custom-control-label text-danger">Inactive</label>
                                            </div>
                                            <div class="text-danger" ng-show="clientFormErrors.status">{{clientFormErrors.status}}</div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-primary" ng-click="saveClient()">Save</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="viewClientContactsModal" style="padding: 10px;">
            <div class="modal-dialog modal-lg mw-100">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header p-2 " ng-class="{'bg-primary':clientDetails.status=='1','bg-danger':clientDetails.status=='0'}">
                        <h5 class="modal-title">Client Contact Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- {{clientDetails|json}} -->
                                <h3>
                                    <img class="profile-user-img img-fluid img-circle" ng-src="{{base_url+'/'+clientDetails.logo}}" onError="this.src= base_url+'/assets/images/placeholder-employee.jpg'" style="height: 50px;width: 50px;" alt="User profile picture">
                                    {{clientDetails.client_name}}
                                </h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <span ng-show="clientDetails.status=='1'" class="text-primary"><i class="fa fa-circle fa-xs"></i> Active</span> <span ng-show="clientDetails.status=='0'" class="text-danger"><i class="fa fa-circle fa-xs"></i> Inactive</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Contacts</h5>
                                <table class="table table-sm">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Person Name</th>
                                            <th>Mobile</th>
                                            <th>E-mail</th>
                                            <th>Department</th>
                                            <th>Aditional Info</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="contact in clientDetails.clientContacts">
                                            <td>{{$index+1}}</td>
                                            <td>{{contact.person_name}}</td>
                                            <td>{{contact.mobile}}</td>
                                            <td>{{contact.email}}</td>
                                            <td>{{contact.department}}</td>
                                            <td>{{contact.additional_info}}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" ng-click="editClientContact(contact);"><i class="fa fa-edit"></i> Edit</button>
                                                <button ng-disabled="contact.isDisabledDeleteBtn" class="btn btn-sm btn-outline-danger" ng-click="deleteClientContact(contact);">
                                                    <i ng-show="!contact.isDisabledDeleteBtn" class="fas fa-trash"></i> 
                                                    <div ng-show="contact.isDisabledDeleteBtn" role="status" class="spinner-border spinner-border-sm">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr ng-class="{'edit-contact':clientContactForm.id}">
                                            <td>{{clientContactForm.id?'Edit':'Add New'}}</td>
                                            <td>
                                                <input type="text" maxlength="50" placeholder="Person name*" class="form-control form-control-sm" ng-model="clientContactForm.person_name">
                                                <div class="text-danger" ng-show="clientContactFormErrors.person_name">{{clientContactFormErrors.person_name}}</div>
                                            </td>
                                            <td>
                                                <input type="text" maxlength="20" placeholder="Mobile*" class="form-control form-control-sm" ng-model="clientContactForm.mobile">
                                                <div class="text-danger" ng-show="clientContactFormErrors.mobile">{{clientContactFormErrors.mobile}}</div>
                                            </td>
                                            <td>
                                                <input type="text" maxlength="50" placeholder="E-mail*" class="form-control form-control-sm" ng-model="clientContactForm.email">
                                                <div class="text-danger" ng-show="clientContactFormErrors.email">{{clientContactFormErrors.email}}</div>
                                            </td>
                                            <td>
                                                <input type="text" maxlength="50" placeholder="Department" class="form-control form-control-sm" ng-model="clientContactForm.department">
                                                <div class="text-danger" ng-show="clientContactFormErrors.department">{{clientContactFormErrors.department}}</div>
                                            </td>
                                            <td>
                                                <input type="text" maxlength="200" placeholder="Additional Information" class="form-control form-control-sm" ng-model="clientContactForm.additional_info">
                                                <div class="text-danger" ng-show="clientContactFormErrors.additional_info">{{clientContactFormErrors.additional_info}}</div>
                                            </td>
                                            <td>
                                                <button ng-disabled="isDisabledClientContactSaveBtn" class="btn btn-sm btn-outline-success" ng-click="saveClientContact();">
                                                    <i ng-show="!isDisabledClientContactSaveBtn" class="fa fa-save"></i>
                                                    <div ng-show="isDisabledClientContactSaveBtn" role="status" class="spinner-border spinner-border-sm">
                                                        <span class="sr-only">Loading...</span>
                                                    </div> Save
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary" ng-click="clearClientContactForm()"><i class="fa fa-times"></i> Cancel</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-sm btn-outline-primary" ng-click="saveClient()">Save</button> -->
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
</div><!-- /.container-fluid -->



</section>
<!-- /.content -->

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    app.controller('clientsCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {
        $scope.clientsList = null;
        $scope.clientsPlaseholder = false;
        $scope.clientForm = {};
        $scope.clientDetails = {};
        $scope.clientFormErrors = {};
        $scope.filterForm = {
            "status": "1"
        };
        $scope.activeCount = 0;
        $scope.inactiveCount = 0;
        $scope.allCount = 0;
        $scope.clientContactForm = {};
        $scope.clientContactFormErrors = {};
        $scope.isDisabledClientContactSaveBtn = false;

        // $scope.filterForm. = '1',
        $scope.getClientsList = function() {

            $scope.clientsPlaseholder = true;
            $scope.clientsList = null;
            $http({
                method: 'get',
                url: base_url + '/api/clients?filter[status]=' + $scope.filterForm.status,
            }).then(function(response) {

                $scope.clientsPlaseholder = false;
                $scope.clientsList = response.data.data;
                $scope.activeCount = response.data.activeCount;
                $scope.inactiveCount = response.data.inactiveCount;
                $scope.allCount = response.data.allCount;
            }, function(response) {
                $scope.clientsPlaseholder = false;
                $scope.clientsList = null
            });
        }

        $scope.getClientsList();

        $scope.viewClient = function(client = '') {


            $('#viewClientModal').modal('toggle');
            if (client != '') {

                $http({
                    method: 'get',
                    url: base_url + '/api/clients/' + client,
                }).then(function(response) {

                    $scope.clientForm = response.data.data;
                    console.log($scope.clientForm);
                    //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
                }, function(response) {


                });
            } else {
                $scope.clientForm = {};
                $('#logo').val("");
            }

        }



        $scope.saveClient = function(index) {

            $scope.clientFormErrors = {};
            var apiUrl = base_url + '/api/clients';
            var method = "POST";
            // console.log($scope.joiningForm);
            $http({
                method: method,
                url: apiUrl,
                headers: {
                    'Content-Type': undefined
                },

                transformRequest: function(data) {
                    var formData = new FormData();

                    formData.append("requestData", angular.toJson(data.model));
                    // for (var i = 0; i < data.files.length; i++) {
                    //     formData.append("photo" + i, data.files[i]);
                    // }
                    angular.forEach(data.document, function(file) {
                        formData.append('logo', file);
                    });
                    return formData;
                },
                data: {
                    model: $scope.clientForm,
                    document: $scope.logo
                },
                // data: $scope.joiningForm
            }).then(function(response) {

                $('#viewClientModal').modal('toggle');
                $scope.clientForm = {};
                $scope.clientFormErrors = {};
                $('#logo').val("");
                toastr.success(response.data.messages.success);
                $scope.getClientsList();
                // window.location = base_url + '/profiles';
            }, function(response) {

                $scope.loading = false;
                $scope.clientFormErrors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    // toastr.error("Please fill all the fileds."); 
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });


        }

        $scope.viewClientContacts = function(client) {
            $('#viewClientContactsModal').modal('toggle');
            $scope.clientDetails = {};
            $scope.clientDetails = client;
            $scope.clearClientContactForm();
        }

        $scope.editClientContact = function(clientContact) {
            $scope.clientContactForm = angular.copy(clientContact);
        }

        $scope.clearClientContactForm = function() {
            $scope.clientContactForm = {
                client_id: $scope.clientDetails.id,
            }
            $scope.clientContactFormErrors = {};
            $scope.isDisabledClientContactSaveBtn = false;
        }
        $scope.saveClientContact = function() {
            // $scope.clientContactForm = {};
            $scope.clientContactFormErrors = {};
            $scope.clientContactForm.client_id = $scope.clientDetails.id;
            $scope.isDisabledClientContactSaveBtn = true;
            $http({
                method: 'post',
                url: base_url + '/api/clients/contacts',
                data: $scope.clientContactForm,
            }).then(function(response) {

                //$scope.clientForm = response.data.data;
                console.log(response);
                $scope.clientContactForm = {};
                $scope.clientContactFormErrors = {};
                $scope.clientDetails.clientContacts = response.data.list;
                toastr.success(response.data.messages.success);
                $scope.isDisabledClientContactSaveBtn = false;
                //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
            }, function(response) {
                $scope.clientContactFormErrors = response.data.messages;
                $scope.isDisabledClientContactSaveBtn = false;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    // toastr.error("Please fill all the fileds."); 
                }

            });

        }

        $scope.deleteClientContact = function(clientContact) {

            
            if(!confirm("Are you sure delete this record?")) return;

            clientContact.isDisabledDeleteBtn = true;
            $http({
                method: 'delete',
                url: base_url + '/api/clients/contacts',
                data: clientContact,
            }).then(function(response) {

                //$scope.clientForm = response.data.data;
                console.log(response);
                $scope.clientContactForm = {};
                $scope.clientContactFormErrors = {};
                $scope.clientDetails.clientContacts = response.data.list;
                toastr.success(response.data.messages.success);
                //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
            }, function(response) {
                clientContact.isDisabledDeleteBtn = false;
                $scope.clientContactFormErrors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    // toastr.error("Please fill all the fileds."); 
                }

            });
        }

    }]);
</script>
<?= $this->endSection() ?>