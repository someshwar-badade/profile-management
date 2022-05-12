<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
    img.active {
        border-bottom: 2px solid;
    }

    ol.sortable-section {
        padding: 0;
        list-style: none;
        margin: 0;
    }

    ol.sortable-section li {
        background-color: gray;
        padding: 3px;
        margin: 2px;
        cursor: move;
        color: white;
    }
</style>

<script>
    function applyFont(font) {
        console.log('You selected font: ' + font);

        // Replace + signs with spaces for css
        font = font.replace(/\+/g, ' ');

        // Split font into family and weight
        font = font.split(':');

        var fontFamily = font[0];
        var fontWeight = font[1] || 400;
    }
</script>
<div class="content-wrapper">
    <section class="content-header" ng-controller="resumeCtrl">
        <div class="container-fluid">

            <div class="row mb-2">
                <div>
                    <h1>Resume Preview</h1>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-3 border  border-primary" style="height:80vh;max-height: 80vh;overflow:auto;">
                    <div class="row ">
                        <div class="col-md-12 p-2 bg-primary">
                            <h6 class="m-0"><i class="fa fa-cog"></i> Configuration</h6>
                        </div>
                    </div>

                    <small>
                        <table class="table table-bordered table-sm">
                           
                            <tbody>

                                <tr>
                                    <td>Template</td>
                                    <td><select class="form-control form-control-sm" ng-change="changeTemplate(template.template_config)" ng-model="template" >
                                    <optgroup label="Pre-defined">
                                            <option  ng-value="t" ng-click="config=t.template_config;console.log(t.template_config)" ng-repeat="t in templates.predefined">{{t.name}}</option>
                                    </optgroup>
                                    <optgroup ng-hide="!templates.custom" label="Custom">
                                            <option  ng-value="t" ng-click="config=t.template_config;console.log(t.template_config)" ng-repeat="t in templates.custom">{{t.name}}</option>
                                    </optgroup>
                                        </select>
                                       
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        Font 
                                    </td>
                                    <td>
                                        <input id="font1" autocomplete="off" value="{{ selectedFont }}" ng-model="config.fontFamily" type="text">
                                        <script>
                                            $('#font1')
                                                .fontselect();
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Font size
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Heading</span>
                                            </div>
                                            <select ng-model="config.ts1" class="form-control">
                                                <option value="{{fontSize}}" ng-repeat="fontSize in fontSizes">{{fontSize}}</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Sub-heading</span>
                                            </div>
                                            <select ng-model="config.ts2" class="form-control">
                                                <option value="{{fontSize}}" ng-repeat="fontSize in fontSizes">{{fontSize}}</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Text</span>
                                            </div>
                                            <select ng-model="config.ts3" class="form-control">
                                                <option value="{{fontSize}}" ng-repeat="fontSize in fontSizes">{{fontSize}}</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Color 1</td>
                                    <td>

                                        <input class="form-control form-control-sm p-0" type="color" ng-model="config.colorPrimary">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Color 2</td>
                                    <td>

                                        <input class="form-control form-control-sm p-0" type="color" ng-model="config.colorSecondary">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Skills Style</td>
                                    <td>
                                        <div >
                                            <label class="btn btn-sm btn-secondary">
                                                <input type="radio" ng-model="config.skillsStyle" autocomplete="off" value="bar" ng-true-value="bar"> Bar
                                            </label>
                                            <label class="btn btn-sm btn-secondary">
                                                <input type="radio" ng-model="config.skillsStyle" autocomplete="off" value="star" ng-true-value="star"> Star
                                            </label>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Section Order
                                    </td>
                                    <td>
                                        <ol class="sortable-section" psi-sortable="" ng-model="sections">
                                            <li ng-repeat="item in config.sections track by $index"> {{item.name}}
                                                <a role="button" ng-click="item.isVisible = !item.isVisible" ng-class="{'fa-eye':item.isVisible,'fa-eye-slash':!item.isVisible}" class="far  fa-lg text-light float-right m-1"></a>
                                            </li>
                                        </ol>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button ng-disabled="!template" type="button" class="btn btn-sm btn-primary" ng-click="changeQuery()">Apply</button>
                                        <button ng-disabled="!template" type="button" class="btn btn-sm btn-primary" ng-click="saveTemplate()">Save Template</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </small>

                </div>
                <div class="col-md-9" >
                    <div ng-show="showPreview" style="height:80vh;max-height: 80vh;overflow:auto;">
                        <div ng-show="pdfLoader" role="status" class="spinner-border spinner-border-sm">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <iframe id="pdfViewer" ng-src={{query}} frameborder="1" width="100%" height="100%"></iframe>

                    </div>
                    <div ng-show="!showPreview" style="height:80vh;max-height: 80vh;overflow:auto;display: flex;justify-content: center;align-items: center;">
                    <div class="text-info">Please select Template and click Apply button.</div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    
    app.controller('resumeCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {
        $scope.query = base_url + "/download-my-resume?";
        $scope.showPreview = false;
        $scope.pdfLoader = false;
        $scope.saveTemplateLoading = false;
        $scope.templates = [];
        $scope.templates.custom = [];
        $scope.templates.predefined = [];
        $scope.replaceString = '\/+\/g';
        $scope.fontSizes = [];
        $scope.selectedFont = '';
        (function() {
            var step = 2;
            var maxSize = 40;
            for (var startSize = 8; startSize <= maxSize; startSize += step) {
                $scope.fontSizes.push(startSize + "px");
            }

        })();

       
        $scope.config = {}

        $scope.changeTemplate = function(c){
            $scope.config = c;
            $scope.selectedFont = c.fontFamily.toString().replaceAll('+',' ')
           console.log(c);
        }
        $scope.changeQuery = function() {
            let currentTime = new Date();
            $scope.pdfLoader = true;
            $scope.query = base_url + "/download-my-resume?";
            $scope.query += "template=" + $scope.config.template_file;
            $scope.query += "&colorPrimary=" + $scope.config.colorPrimary.replace('#', '');
            $scope.query += "&colorSecondary=" + $scope.config.colorSecondary.replace('#', '');
            $scope.query += "&font=" + $scope.config.font;
            $scope.query += "&fontFamily=" + $scope.config.fontFamily;
            $scope.query += "&skillsStyle=" + $scope.config.skillsStyle;
            $scope.query += "&ts1=" + $scope.config.ts1;
            $scope.query += "&ts2=" + $scope.config.ts2;
            $scope.query += "&ts3=" + $scope.config.ts3;
            $scope.query += "&sections=" + $scope.getSectionOrder();
            $scope.query += "&time=" + currentTime.getTime();
            $scope.showPreview = true;
            console.log($scope.query);
        }

        $scope.getSectionOrder = function() {
            let tempArr = [];
            angular.forEach($scope.config.sections, function(value, key) {
                if (value.isVisible) {
                    tempArr.push(value.code);
                }
            });
            return tempArr.join("_");
        }

        $scope.getTemplates = function() {
            $http({
                method: 'get',
                url: base_url + '/api/get-resume-templates',
            }).then(function(response) {
                $scope.templates = response.data.data;
                console.log(response);
            }, function(response) {
                if (response.data.status == 403) {
                    toastr.error(response.data.messages.errorMessage);
                } else {
                    toastr.error("Something went wrong !!");
                }

            });
        }

        $scope.getTemplates();

        $scope.saveTemplate = function() {
            let templateName = prompt("Enter template name:",$scope.template.name)

            if (templateName.trim()) {

                var template_config = angular.copy($scope.config);
               
                $scope.errors = '';
                $scope.otpSuccessMsg = '';
                $scope.saveTemplateLoading = true;
                $scope.successMessage = '';
                // console.log($scope.profile);
                var apiUrl = base_url + '/api/save-resume-template';
                var method = "POST";
                // console.log($scope.profileForm);
                $http({
                    method: method,
                    url: apiUrl,
                    data: {
                        "name": templateName,
                        "template_config": template_config
                    }
                }).then(function(response) {

                    $scope.saveTemplateLoading = false;
                    $scope.successMessage = response.data.messages.success;
                    toastr.success(response.data.messages.success);


                    // window.location = base_url + '/profiles';
                }, function(response) {

                    $scope.saveTemplateLoading = false;
                    $scope.errors = response.data.messages;
                    if (response.data.status == 403) {

                        if (!!response.data.messages.redirectUrl) {
                            window.location.href = response.data.messages.redirectUrl;
                        }
                        if (response.data.messages.errorMessage != '') {
                            toastr.error(response.data.messages.errorMessage);
                        }

                    } else {
                        toastr.error("Please fill all the required information.");
                    }

                });
            }
        }

        $('#pdfViewer').load(function() {
            $scope.pdfLoader = false;
            $scope.$apply();
        });

    }]);
</script>
<?= $this->endSection() ?>