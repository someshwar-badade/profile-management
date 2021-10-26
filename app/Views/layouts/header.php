<div class="wrapper">
  <header class="clearfix" ng-controller="headerCtrl">
    <!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="<?=base_url('assets/images/bitstring-logo.png')?>" width="50" height="50" class="d-inline-block align-top" alt="">
    <span>BitString</span>
  </a>
</nav>
    <script>
      var base_url = '<?= base_url(route_to('home')) ?>';
      var SITE_CODE = '<?= SITE_CODE ?>';
    </script>
  </header>