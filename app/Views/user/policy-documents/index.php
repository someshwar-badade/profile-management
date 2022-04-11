<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
    .profile-user-img {
        height: 100px;
        object-fit: contain;
    }

    .edit-contact {
        background-color: rgba(0, 255, 0, .2);
    }

    .text-placeholder {
        aspect-ratio: auto;
        width: 100%;
    }
</style>
<div class="clients content-wrapper">
    <section ng-cloak class="content" ng-controller="policyDocumentsCtrl">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-6">
                    <h1>Policy Documents</h1>
                </div>
                <div class="col-6 mt-3">
                    <div class="filter text-right">
                        <div class="custom-control custom-radio d-inline mr-3">
                            <input class="custom-control-input custom-control-input-secondary" ng-change="getPolicyDocumentsList()" type="radio" id="filterAll" value="" ng-true-value="" name="filterStatus" ng-model="filterForm.status">
                            <label for="filterAll" class="custom-control-label text-secondary">All ({{allCount}})</label>
                        </div>
                        <div class="custom-control custom-radio d-inline mr-3">
                            <input class="custom-control-input" type="radio" id="filterActive" ng-change="getPolicyDocumentsList()" name="filterStatus" value="Active" ng-true-value="Active" ng-model="filterForm.status">
                            <label for="filterActive" class="custom-control-label text-primary">Active ({{activeCount}})</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input class="custom-control-input custom-control-input-danger" type="radio" ng-change="getPolicyDocumentsList()" id="filterInactive" value="Inactive" ng-true-value="Inactive" name="filterStatus" ng-model="filterForm.status">
                            <label for="filterInactive" class="custom-control-label text-danger">Inactive ({{inactiveCount}})</label>
                        </div>
                    </div>

                </div>
            </div>



            <div class="row">

                <?php for ($i = 0; $i < 6; $i++) { ?>
                    <div ng-show="plaseholder" class="col-md-3 animation">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h6>
                                    <div class="text-placeholder placeholder mt-0">&nbsp;</div>
                                </h6>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div ng-repeat="doc in policyDocuments" class="animation col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="dropdown" style="position: absolute;right:0;">
                            <button class="btn" type="button" data-toggle="dropdown"><i class="fas text-secondary fa-ellipsis-v fa-sm"></i></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li> <a role='button' class='mx-2 text-default' ng-click="viewClient(doc.id);">Edit</a></li>
                                <li> <a role='button' class='mx-2 text-default' ng-show="doc.type=='File'" target="_blank" href="{{base_url+'/view-policy-document/'+doc.id+'/'+ doc.document_name}}">View</a></li>
                                <li> <a role='button' class='mx-2 text-default' ng-show="doc.type=='Text'" ng-click="viewDocument(doc.id)">View</a></li>
                                <li> <a role='button' class='mx-2 text-default' ng-click="deleteDocument(doc.id)">Delete</a></li>
                            </ul>
                        </div>
                        <div class="card-body box-profile">
                            <h6>
                                <a ng-show="doc.type=='File'" target="_blank" href="{{base_url+'/view-policy-document/'+doc.id+'/'+ doc.document_name}}">
                                    {{doc.document_name}}
                                </a>
                                <a ng-show="doc.type=='Text'" ng-click="viewDocument(doc.id)" role="button">
                                    {{doc.document_name}}
                                </a>

                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="background: grey;border: dashed;">

                        <div class="card-body box-profile">
                            <button ng-click="viewClient();" class="btn btn-sm btn-warning btn-block"><b><i class="fa fa-plus"></i> Add New</b></button>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="modal" id="viewClientModal">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header p-2 bg-primary">
                        <h5 class="modal-title">Policy Document Details</h5>
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
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Document Name<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="clientForm.document_name">
                                            <div class="text-danger" ng-show="clientFormErrors.document_name">{{clientFormErrors.document_name}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Type<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-radio d-inline mr-3">
                                                <input class="custom-control-input" type="radio" id="documentType1" name="type" value="File" ng-true-value='File' ng-model="clientForm.type">
                                                <label for="documentType1" class="custom-control-label">File</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline">
                                                <input class="custom-control-input" type="radio" id="documentType2" value="Text" ng-true-value='Text' name="type" ng-model="clientForm.type">
                                                <label for="documentType2" class="custom-control-label">Text</label>
                                            </div>
                                            <div class="text-danger" ng-show="clientFormErrors.type">{{clientFormErrors.type}}</div>
                                        </div>
                                    </div>

                                    <div ng-show="clientForm.type=='File'" class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Document</label>

                                        <div ng-show="clientForm.isDocumentExist" class="col-sm-9">
                                            <a target="_blank" href="{{base_url+'/'+clientForm.file}}">{{clientForm.file_name_original || 'Document'}}</a>
                                            <a role="button" class="text-warning ml-4" ng-click="clientForm.isDocumentExist = !clientForm.isDocumentExist">Change Document</a>
                                        </div>
                                        <div ng-hide="clientForm.isDocumentExist" class="col-sm-9">
                                            <input type="file" id="document" file-input="document" class="form-control" ngf-select>
                                            <div class="text-danger" ng-show="clientFormErrors.document">{{clientFormErrors.document}}</div>
                                        </div>
                                    </div>

                                    <div ng-show="clientForm.type=='Text'" class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Text</label>

                                        <div class="col-sm-9">
                                            <div text-angular="text-angular" name="htmlcontent" ng-model="clientForm.text" ta-disabled='disabled'></div>

                                            <div class="text-danger" ng-show="clientFormErrors.text">{{clientFormErrors.text}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Status<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-radio d-inline mr-3">
                                                <input class="custom-control-input" type="radio" id="customRadio1" name="status" value="Active" ng-true-value='Active' ng-model="clientForm.status">
                                                <label for="customRadio1" class="custom-control-label text-primary">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline">
                                                <input class="custom-control-input custom-control-input-danger" type="radio" id="customRadio2" value="Inactive" ng-true-value='Inactive' name="status" ng-model="clientForm.status">
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

        <div class="modal" id="viewDocumentModal">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header p-2 bg-primary">
                        <h5 class="modal-title">Policy Document Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="documentHtml"></div>
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
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    app.controller('policyDocumentsCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {
        $scope.filterForm = {}
        $scope.filterForm.status = 'Active'
        $scope.activeCount = 0
        $scope.inactiveCount = 0
        $scope.allCount = 0
        $scope.policyDocuments = null
        $scope.plaseholder = false
        $scope.documentHtml = '';
        $scope.clientForm = {};

        $scope.getPolicyDocumentsList = function() {

            $scope.plaseholder = true;
            $scope.policyDocuments = null;
            $http({
                method: 'get',
                url: base_url + '/api/policy-documents?filter[status]=' + $scope.filterForm.status,
            }).then(function(response) {

                $scope.plaseholder = false;
                $scope.policyDocuments = response.data.data;
                $scope.activeCount = response.data.activeCount;
                $scope.inactiveCount = response.data.inactiveCount;
                $scope.allCount = response.data.allCount;

            }, function(response) {
                $scope.plaseholder = false;
                $scope.policyDocuments = null
            });
        }

        $scope.getPolicyDocumentsList();


        $scope.viewClient = function(client = '') {


            $('#viewClientModal').modal('toggle');
            if (client != '') {

                $http({
                    method: 'get',
                    url: base_url + '/api/policy-documents/' + client,
                }).then(function(response) {

                    $scope.clientForm = response.data.data;
                    //vm.profile.editUrl = base_url + "/profile/" + vm.profileForm.id + "/edit";
                }, function(response) {


                });
            } else {
                $scope.clientForm = {};
                $('#document').val("");
            }

        }

        $scope.saveClient = function(index) {

            $scope.clientFormErrors = {};
            var apiUrl = base_url + '/api/policy-documents';
            var method = "POST";
            console.log($scope.document);
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
                        formData.append('document', file);
                    });
                    return formData;
                },
                data: {
                    model: $scope.clientForm,
                    document: $scope.document
                },
                // data: $scope.joiningForm
            }).then(function(response) {

                $('#viewClientModal').modal('toggle');
                $scope.clientForm = {};
                $scope.clientFormErrors = {};
                $('#document').val("");
                toastr.success(response.data.messages.success);
                $scope.getPolicyDocumentsList();
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

        $scope.viewDocument = function(documentId) {
            $('#viewDocumentModal').modal('toggle');
            $scope.documentHtml = '';
            if (documentId != '') {

                $http({
                    method: 'get',
                    url: base_url + '/view-policy-document/' + documentId,
                }).then(function(response) {
                    $('#documentHtml').html(response.data.data.text)
                }, function(response) {


                });
            }
        }

        $scope.deleteDocument = function(documentId) {

            if(!confirm("Are you sure you want to delete this document?")) return
            if (documentId != '') {

                $http({
                    method: 'delete',
                    url: base_url + '/api/policy-documents/' + documentId,
                }).then(function(response) {
                    $scope.getPolicyDocumentsList();
                }, function(response) {


                });
            }
        }

    }])
</script>
<?= $this->endSection() ?>