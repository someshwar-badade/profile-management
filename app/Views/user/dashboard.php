<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row m-0">

             
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<!-- ChartJS -->
<script src="<?= base_url('assets/admin/plugins/chart.js/Chart.min.js') ?>"></script>
<script>
    var donutData = {
        labels: [
            'Live',
            'Dead',
            'Sold',
        ],
        datasets: [{
            data: [700, 500, 400],
            backgroundColor: ['#00a65a', '#f56954', '#f39c12'],
        }]
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })

    var donutData2 = {
        labels: [
            'Female',
            'Male',
        ],
        datasets: [{
            data: [200, 500],
            backgroundColor: ['#00a65a', '#f56954'],
        }]
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
    var pieData = donutData2;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })
</script>
<?= $this->endSection() ?>