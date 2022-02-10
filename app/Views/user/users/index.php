<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div ng-cloak class="content-wrapper">
    <section class="content" ng-controller="ServerSideProcessingCtrl as showCase">
        <div class="container-fluid">

            <div class="row m-0">
                <div class="col-12">
                    <h1>Users</h1>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-12 text-right my-2">
                    <a href="<?=base_url(route_to('newUser'))?>" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add new user</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="row-border hover table "></table>
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
    app.controller('ServerSideProcessingCtrl', ServerSideProcessingCtrl);

    function ServerSideProcessingCtrl($scope, $http, DTOptionsBuilder, DTColumnBuilder) {
        $scope.tableFilter = {}
        var vm = this;
        vm.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                //  dataSrc: 'data',
                url: base_url + '/api/users',
                type: 'POST',
                data: {
                    filter: $scope.tableFilter
                }
            }) 
            // or here
            .withDataProp('data')
            .withOption('processing', true)
            .withOption('serverSide', true)
            .withPaginationType('full_numbers')
            .withOption('responsive', true);
        vm.dtColumns = [
            DTColumnBuilder.newColumn('id').withTitle('ID'),
            DTColumnBuilder.newColumn('fname').withTitle('First name'),
            DTColumnBuilder.newColumn('lname').withTitle('Last name'),
            DTColumnBuilder.newColumn('mobile').withTitle('Mobile'),
            DTColumnBuilder.newColumn('email').withTitle('E-mail'),
            DTColumnBuilder.newColumn('status').withTitle('Profile Status').renderWith(function(data, type, full) {
                // return full.gender + ' ' + full.id;
                return full.status == '1' ? "<span class='text-success'>Active</span>" : "<span class='text-danger'>Deactive</span>";
            }).withClass('none'),
            DTColumnBuilder.newColumn('').withTitle('Actions').renderWith(function(data, type, full) {
                // return full.gender + ' ' + full.id;
               
                var html = '<div class="dropdown">'+
                        '<button class="btn" type="button" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>'+
                        '<ul class="dropdown-menu">'+
                        "<a class='  btn-tool text-primary' href='" + base_url + "/user/" + full.id + "'><i class='fas fa-user-edit'></i> Edit</a>";
                        '</ul>'
                    '</div>';

                    
                    return html;
            })
        ];


        $scope.initializeDatepicker = function() {
            $('#date1').datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false,
                maxDate: new Date(),
                onSelectDate: function() {
                    $scope.tableFilter.date1 = $('#date1').val()
                }
            });
            $('#date2').datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false,
                maxDate: new Date(),
                onSelectDate: function() {
                    $scope.tableFilter.date2 = $('#date2').val()
                }
            });
        }

        $scope.tableFilter.profile_plan = [];
        $scope.selcected_profile_plan = [];
        $scope.profile_plan_list = JSON.parse('<?= json_encode($profilePlanList['data']) ?>');;
        $scope.example13settings = {
            smartButtonMaxItems: 3,
            template: '{{option.code}}',
            buttonClasses: "btn btn-primary btn-sm",
            idProperty: 'code',
            checkBoxes: true,
            showCheckAll: false,
            showUncheckAll: false,
            smartButtonTextConverter: function(skip, option) {
                return option.code;
            },

        };
        $scope.events = {
            onItemSelect: function(item) {
                $scope.tableFilter.profile_plan.push(item.code);
                console.log($scope.tableFilter.profile_plan);
            },
            onItemDeselect: function(item) {
                $scope.tableFilter.profile_plan = $scope.tableFilter.profile_plan.filter(function(e) {
                    return e !== item.code
                });
                console.log($scope.tableFilter.profile_plan);
            }
        }

        $scope.clearFilter = function() {
            $scope.tableFilter.status = '';
            $scope.tableFilter.date1 = '';
            $scope.tableFilter.date2 = '';
            $scope.tableFilter.referral_id = '';
            $scope.tableFilter.profile_plan = [];;
        }


    }

    app.controller('usersCtrl', ['$scope', '$http', 'slugifyFilter', function($scope, $http, slugifyFilter) {

    }]);
</script>

<?= $this->endSection() ?>