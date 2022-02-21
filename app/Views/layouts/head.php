<!doctype html>
<html lang="en" ng-app="app">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon">
    <title><?= $page_title ?> | <?= SITE_TITLE ?></title>

    <script src="<?= base_url('assets/js/jquery-3.2.1.slim.min.js') ?>"></script>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/dist/css/adminlte.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/summernote/summernote-bs4.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/js/datatables/datatables.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css?v1.4') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/custom.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/js/toastr/toastr.min.css') ?>">
    <script src="<?= base_url('assets/js/angular/angular.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/ui-bootstrap-2.5.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/ui-bootstrap-tpls-2.5.0.min.js') ?>"></script>
    <!--Tags input-->
    <link rel="stylesheet" href="<?= base_url('assets/js/ng-tags-input/ng-tags-input.min.css') ?>">
    <script src="<?= base_url('assets/js/ng-tags-input/ng-tags-input.min.js') ?>"></script>


    <script src="<?= base_url('assets/js/angular-timeago.min.js') ?>"></script>



    <script src="<?= base_url('assets/js/angular/app.js?v=1.5') ?>"></script>
    <script src="<?= base_url('assets/js/angular/angular-cookies.min.js') ?>"></script>
    <script>
        var base_url = '<?= base_url(route_to('home')) ?>';
        var SITE_CODE = '<?= SITE_CODE ?>';
    </script>
</head>

<body ng-cloak class="hold-transition layout-fixed">