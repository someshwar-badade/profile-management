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
                    <h1>Site Settings</h1>
                </div>
            </div>


            <div class="row">

                <div class="animation col-md-8 offset-md-2">
                    <div class="card card-primary card-outline">

                        <div class="card-body box-profile">
                            <form class="form-horizontal" ng-submit="saveSettings()">
                                <fieldset>
                                    <legend>Site</legend>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Site Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="siteSettings.site_title">
                                            <div class="text-danger" ng-show="siteSettingsErrors.site_title">{{siteSettingsErrors.site_title}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Logo</label>
                                        
                                        <div  class="col-sm-9">
                                            <input type="file" id="document" file-input="document" class="form-control" ngf-select>
                                            <div class="text-danger" ng-show="clientFormErrors.document">{{clientFormErrors.document}}</div>
                                        </div>
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">&nbsp;</label>
                                        <div  class="col-sm-9">
                                            <img src="{{base_url+'/'+siteSettings.site_logo}}" alt="logo" style="width: 100px;height:100px;object-fit:contain;">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">Site Footer</label>


                                        <div class="col-sm-9">

                                            <div id="htmlEditor">

                                                <div text-angular="text-angular" name="htmlcontent" ng-model="siteSettings.site_footer" ta-disabled='disabled'></div>

                                            </div>
                                            <div class="text-danger" ng-show="siteSettingsErrors.site_footer">{{siteSettingsErrors.site_footer}}</div>
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>SMTP</legend>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">SMTP Host</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="200" class="form-control form-control-sm" ng-model="siteSettings.smtp_host">
                                            <div class="text-danger" ng-show="siteSettingsErrors.smtp_host">{{siteSettingsErrors.smtp_host}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">SMTP User</label>
                                        <div class="col-sm-9">
                                            <input type="email" maxlength="200" class="form-control form-control-sm" ng-model="siteSettings.smtp_user">
                                            <div class="text-danger" ng-show="siteSettingsErrors.smtp_user">{{siteSettingsErrors.smtp_user}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">SMTP Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" maxlength="60" class="form-control form-control-sm" ng-model="siteSettings.smtp_pass">
                                            <div class="text-danger" ng-show="siteSettingsErrors.smtp_pass">{{siteSettingsErrors.smtp_pass}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label col-form-label-sm text-right">SMTP Port</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="4" class="form-control form-control-sm only-numbers" ng-model="siteSettings.smtp_port">
                                            <div class="text-danger" ng-show="siteSettingsErrors.smtp_port">{{siteSettingsErrors.smtp_port}}</div>
                                        </div>
                                    </div>

                                </fieldset>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">&nbsp;</label>
                                    <div class="col-sm-9">
                                        <button ng-disabled="loader" class="btn btn-primary" type="submit">
                                            <div ng-show="loader" role="status" class="spinner-border spinner-border-sm">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <i ng-show="!loader" class="fa fa-save"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>

                                
                            </form>
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

        $scope.loader = false
        $scope.documentHtml = '';
        $scope.siteSettings = {};

        $scope.getSiteSettings = function() {

            $scope.loader = true;
            $scope.siteSettings = null;
            $http({
                method: 'get',
                url: base_url + '/api/site-settings',
            }).then(function(response) {

                $scope.loader = false;
                $scope.siteSettings = response.data.data;

            }, function(response) {
                $scope.loader = false;
                $scope.siteSettings = null
            });
        }

        $scope.getSiteSettings();


        $scope.saveSettings = function(index) {

            $scope.siteSettingsErrors = {};
            var apiUrl = base_url + '/api/site-settings';
            var method = "POST";
            $scope.loader = true;
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
                    model: $scope.siteSettings,
                    document: $scope.document
                },
                // data: $scope.joiningForm
            }).then(function(response) {

                $scope.loader = false;
                // $scope.siteSettings = {};
                $scope.siteSettingsErrors = {};
                $('#document').val("");
                toastr.success(response.data.messages.success);


            }, function(response) {

                $scope.loader = false;
                $scope.siteSettingsErrors = response.data.messages;
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    // toastr.error("Please fill all the fileds."); 
                }
                // console.log($scope.errors);
                // console.log($scope.errors['lang.en.title']);
            });

        }
    }])
</script>
<?= $this->endSection() ?>