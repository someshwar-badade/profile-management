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

        // Set selected font on paragraphs
        $('p').css({
            fontFamily: "'" + fontFamily + "'",
            fontWeight: fontWeight
        });
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
                                    <td><select class="form-control form-control-sm" ng-model="config.template">
                                            <option value="template1">Template 1</option>
                                            <option value="template2">Template 2</option>
                                            <option value="template3">Template 3</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>
                                        Font
                                    </td>
                                    <td>
                                        <input id="font1" ng-model="config.fontFamily" type="text">
                                        <script>
                                            $('#font1')
                                                .fontselect()
                                                .on('change', function() {
                                                    applyFont(this.value);
                                                });
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
                                                <span class="input-group-text">Text 1</span>
                                            </div>
                                            <select ng-model="config.ts1" class="form-control">
                                                <option value="{{fontSize}}" ng-repeat="fontSize in fontSizes">{{fontSize}}</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Text 2</span>
                                            </div>
                                            <select ng-model="config.ts2" class="form-control">
                                                <option value="{{fontSize}}" ng-repeat="fontSize in fontSizes">{{fontSize}}</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Text 3</span>
                                            </div>
                                            <select ng-model="config.ts3" class="form-control">
                                                <option value="{{fontSize}}" ng-repeat="fontSize in fontSizes">{{fontSize}}</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Text 4</span>
                                            </div>
                                            <select ng-model="config.ts4" class="form-control">
                                                <option value="{{fontSize}}" ng-repeat="fontSize in fontSizes">{{fontSize}}</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Text 5</span>
                                            </div>
                                            <select ng-model="config.ts5" class="form-control">
                                                <option value="{{fontSize}}" ng-repeat="fontSize in fontSizes">{{fontSize}}</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Text 6</span>
                                            </div>
                                            <select ng-model="config.ts6" class="form-control">
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
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-sm btn-secondary">
                                                <input type="radio" ng-model="config.skillsStyle" autocomplete="off" value="bar"> Bar
                                            </label>
                                            <label class="btn btn-sm btn-secondary">
                                                <input type="radio" ng-model="config.skillsStyle" autocomplete="off" value="star"> Star
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
                                            <li ng-repeat="item in sections track by $index"> {{item.name}}
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
                                        <button type="button" class="btn btn-sm btn-primary" ng-click="changeQuery()">Apply</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </small>
                    {{config|json}}
                </div>
                <div class="col-md-9" style="height:80vh;max-height: 80vh;overflow:auto;">
                    <div ng-show="pdfLoader" role="status" class="spinner-border spinner-border-sm">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <iframe id="pdfViewer" ng-src={{query}} frameborder="1" width="100%" height="100%"></iframe>
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
        $scope.pdfLoader = false;
        $scope.sections = [{
                'code': "WE",
                'name': "Work Experience",
                'isVisible': true
            },
            {
                'code': "ED",
                'name': "Education Details",
                'isVisible': true
            },
            {
                'code': "CC",
                'name': "Courses and Certifications",
                'isVisible': true
            },
        ];

        $scope.fontSizes = [];
        (function() {
            var step = 2;
            var maxSize = 40;
            for (var startSize = 8; startSize <= maxSize; startSize += step) {
                $scope.fontSizes.push(startSize + "px");
            }

        })();

        $scope.config = {
            "template": "template1",
            "colorPrimary": "000000",
            "colorSecondary": "",
            "skillsStyle": "bar",
            "font": "Roboto-Regular.ttf",
            "ts1": "32px",
            "ts2": "28px",
            "ts3": "24px",
            "ts4": "20px",
            "ts5": "16px",
            "ts6": "12px",
        }
       
        $scope.changeQuery = function() {
            $scope.pdfLoader = true;
            $scope.query = base_url + "/download-my-resume?";
            $scope.query += "template=" + $scope.config.template;
            $scope.query += "&colorPrimary=" + $scope.config.colorPrimary.replace('#', '');
            $scope.query += "&colorSecondary=" + $scope.config.colorSecondary.replace('#', '');
            $scope.query += "&font=" + $scope.config.font;
            $scope.query += "&fontFamily=" + $scope.config.fontFamily;
            $scope.query += "&skillsStyle=" + $scope.config.skillsStyle;
            $scope.query += "&sections=" + $scope.getSectionOrder();
            console.log($scope.query);
        }

        $scope.getSectionOrder = function() {
            let tempArr = [];
            angular.forEach($scope.sections, function(value, key) {
                if (value.isVisible) {
                    tempArr.push(value.code);
                }
            });
            return tempArr.join("_");
        }

        $('#pdfViewer').load(function() {
            $scope.pdfLoader = false;
            $scope.$apply();
        });

    }]);
</script>
<?= $this->endSection() ?>