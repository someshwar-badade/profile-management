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

    .email-placeholders {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        padding: 2px;
    }

    .email-placeholders p {
        margin: 0;
    }

    .email-placeholders .badge {
        cursor: pointer;
    }
</style>
<div class="clients content-wrapper">
    <section ng-cloak class="content" ng-controller="policyDocumentsCtrl">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-6">
                    <h1>Email Templates</h1>
                </div>
                <div class="col-6 mt-3">
                    <div class="filter text-right">
                        <div class="custom-control custom-radio d-inline mr-3">
                            <input class="custom-control-input custom-control-input-secondary" ng-change="getList()()" type="radio" id="filterAll" value="" ng-true-value="" name="filterStatus" ng-model="filterForm.status">
                            <label for="filterAll" class="custom-control-label text-secondary">All ({{allCount}})</label>
                        </div>
                        <div class="custom-control custom-radio d-inline mr-3">
                            <input class="custom-control-input" type="radio" id="filterActive" ng-change="getList()()" name="filterStatus" value="Enable" ng-true-value="Enable" ng-model="filterForm.status">
                            <label for="filterActive" class="custom-control-label text-primary">Enable ({{activeCount}})</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input class="custom-control-input custom-control-input-danger" type="radio" ng-change="getList()()" id="filterInactive" value="Disable" ng-true-value="Disable" name="filterStatus" ng-model="filterForm.status">
                            <label for="filterInactive" class="custom-control-label text-danger">Disable ({{inactiveCount}})</label>
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

                <div ng-repeat="item in emailTemplates" class="animation col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="dropdown" style="position: absolute;right:0;">
                            <button class="btn" type="button" data-toggle="dropdown"><i class="fas text-secondary fa-ellipsis-v fa-sm"></i></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li> <a role='button' class='mx-2 text-default' ng-click="viewModal(item.id);">Edit</a></li>
                                <!-- <li> <a role='button' class='mx-2 text-default' ng-show="item.type=='File'" target="_blank" href="{{base_url+'/view-policy-document/'+item.id+'/'+ item.document_name}}">View</a></li> -->
                                <!-- <li> <a role='button' class='mx-2 text-default' ng-click="sendTestEmailModal(item.id)">Send Test Mail</a></li> -->

                            </ul>
                        </div>
                        <div class="card-body box-profile">
                            <h6>
                                {{item.subject}}
                            </h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal" id="viewModal">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header p-2 bg-primary">
                        <h5 class="modal-title">Email Template</h5>
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
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">To<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="clientForm.email_to">
                                            <div class="text-danger" ng-show="clientFormErrors.email_to">{{clientFormErrors.email_to}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Cc</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="clientForm.email_cc">
                                            <div class="text-danger" ng-show="clientFormErrors.email_cc">{{clientFormErrors.email_cc}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Bcc</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="clientForm.email_bcc">
                                            <div class="text-danger" ng-show="clientFormErrors.email_bcc">{{clientFormErrors.email_bcc}}</div>
                                        </div>
                                    </div>




                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Body</label>


                                        <div class="col-sm-9">
                                            <div class="email-placeholders">
                                                <p>Placeholders:</p>
                                                <span class="badge badge-secondary" ng-click="insertTextAtCursor('[user_first_name]')">[user_first_name]</span>
                                                <span class="badge badge-secondary" ng-click="insertTextAtCursor('[user_last_name]')">[user_last_name]</span>
                                                <span class="badge badge-secondary" ng-click="insertTextAtCursor('[user_email]')">[user_email]</span>
                                                <span class="badge badge-secondary" ng-click="insertTextAtCursor('[user_mobile]')">[user_mobile]</span>
                                                <span class="badge badge-secondary" ng-click="insertTextAtCursor('[verification_code]')">[verification_code]</span>
                                                <span class="badge badge-secondary" ng-click="insertTextAtCursor('[user_password]')">[user_password]</span>
                                                <span class="badge badge-secondary" ng-click="insertTextAtCursor('[link]')">[link]</span>
                                            </div>
                                            <div id="htmlEditor">

                                                <div text-angular="text-angular" name="htmlcontent" ng-model="clientForm.body" ta-disabled='disabled'></div>

                                            </div>
                                            <div class="text-danger" ng-show="clientFormErrors.text">{{clientFormErrors.body}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Status</label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-radio d-inline mr-3">
                                                <input class="custom-control-input" type="radio" id="documentType1" name="type" value="Enable" ng-true-value='Enable' ng-model="clientForm.status">
                                                <label for="documentType1" class="custom-control-label">Enable</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline">
                                                <input class="custom-control-input" type="radio" id="documentType2" value="Disable" ng-true-value='Disable' name="status" ng-model="clientForm.status">
                                                <label for="documentType2" class="custom-control-label">Disable</label>
                                            </div>
                                            <div class="text-danger" ng-show="clientFormErrors.type">{{clientFormErrors.status}}</div>
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


        <div class="modal" id="sendEmailModal">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header p-2 bg-primary">
                        <h5 class="modal-title">Send test email</h5>
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
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">To<sup class="text-danger">*</sup></label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.email_to">
                                            <div class="text-danger" ng-show="testEmailErrors.email_to">{{testEmailErrors.email_to}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Cc</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.email_cc">
                                            <div class="text-danger" ng-show="testEmailErrors.email_cc">{{testEmailErrors.email_cc}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Bcc</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.email_bcc">
                                            <div class="text-danger" ng-show="testEmailErrors.email_bcc">{{testEmailErrors.email_bcc}}</div>
                                        </div>
                                    </div>

                                    <fieldset>
                                        <legend>Placeholders</legend>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right" title="">[user_first_name]</label>
                                            <div class="col-sm-9">
                                                <input type="text" maxlength="200"  class="form-control form-control-sm" ng-model="testEmail.user_first_name">
                                                <div class="text-danger" ng-show="testEmailErrors.user_first_name">{{testEmailErrors.user_first_name}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right" title="">[user_last_name]</label>
                                            <div class="col-sm-9">
                                                <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.user_last_name">
                                                <div class="text-danger" ng-show="testEmailErrors.user_last_name">{{testEmailErrors.user_last_name}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right" title="">[user_email]</label>
                                            <div class="col-sm-9">
                                                <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.user_email">
                                                <div class="text-danger" ng-show="testEmailErrors.user_email">{{testEmailErrors.user_email}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right" title="">[user_mobile]</label>
                                            <div class="col-sm-9">
                                                <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.user_mobile">
                                                <div class="text-danger" ng-show="testEmailErrors.user_mobile">{{testEmailErrors.user_mobile}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right" title="">[user_password]</label>
                                            <div class="col-sm-9">
                                                <input type="password" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.user_password">
                                                <div class="text-danger" ng-show="testEmailErrors.user_password">{{testEmailErrors.user_password}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right" title="">[verification_code]</label>
                                            <div class="col-sm-9">
                                                <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.verification_code">
                                                <div class="text-danger" ng-show="testEmailErrors.verification_code">{{testEmailErrors.verification_code}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label col-form-label-sm text-right" >[link]</label>
                                            <div class="col-sm-9">
                                                <input type="url" maxlength="200" class="form-control form-control-sm" ng-model="testEmail.link">
                                                <div class="text-danger" ng-show="testEmailErrors.link">{{testEmailErrors.link}}</div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>




                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-primary" ng-click="sendTestMail()">Send</button>
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
    let selection;
    let range

    $(document).on('click', '#htmlEditor .ta-text.ta-editor', function() {
        selection = window.getSelection();
        range = selection.getRangeAt(0);

    });

    $(document).on('input', '#htmlEditor .ta-text.ta-editor', function() {
        selection = window.getSelection();
        range = selection.getRangeAt(0);

    });


    app.controller('policyDocumentsCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {
        $scope.filterForm = {}
        $scope.filterForm.status = 'Enable'
        $scope.activeCount = 0
        $scope.inactiveCount = 0
        $scope.allCount = 0
        $scope.emailTemplates = null
        $scope.plaseholder = false
        $scope.documentHtml = '';
        $scope.clientForm = {};
        $scope.testEmail = {};

        $scope.getList = function() {

            $scope.plaseholder = true;
            $scope.emailTemplates = null;
            $http({
                method: 'get',
                url: base_url + '/api/email-templates?filter[status]=' + $scope.filterForm.status,
            }).then(function(response) {

                $scope.plaseholder = false;
                $scope.emailTemplates = response.data.data;
                $scope.activeCount = response.data.activeCount;
                $scope.inactiveCount = response.data.inactiveCount;
                $scope.allCount = response.data.allCount;

            }, function(response) {
                $scope.plaseholder = false;
                $scope.policyDocuments = null
            });
        }

        $scope.getList();


        $scope.viewModal = function(client = '') {


            $('#viewModal').modal('toggle');
            if (client != '') {

                $http({
                    method: 'get',
                    url: base_url + '/api/email-templates/' + client,
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

        $scope.sendTestEmailModal = function(templateId = '') {


            $('#sendEmailModal').modal('toggle');
            $scope.testEmail.emailTemplateId = templateId;

        }

        $scope.saveClient = function(index) {

            $scope.clientFormErrors = {};
            var apiUrl = base_url + '/api/update-email-templates';
            var method = "POST";
            console.log($scope.document);
            $http({
                method: method,
                url: apiUrl,
                data: $scope.clientForm,
                // data: $scope.joiningForm
            }).then(function(response) {

                $('#viewModal').modal('toggle');
                $scope.clientForm = {};
                $scope.clientFormErrors = {};
                $('#document').val("");
                toastr.success(response.data.messages.success);
                $scope.getList();
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


        $scope.insertTextAtCursor = function(text) {
            range.deleteContents();
            let node = document.createTextNode(text);
            range.insertNode(node);

            for (let position = 0; position != text.length; position++) {
                selection.modify("move", "right", "character");
            };
        }

    }])
</script>
<?= $this->endSection() ?>