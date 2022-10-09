<div class="row">
    <div class="col-md-7">
        <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">
                <div class="col">
                    <h5 class="card-title text-muted mb-0">Total Transaksi</h5>
                    <span class="h4 font-weight-bold mb-0"><?php echo count($transaction); ?></span>
                </div>
                <div class="icon icon-shape bg-light-success text-success rounded-circle">
                    <i class="feather-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">
                <div class="col">
                    <h5 class="card-title text-muted mb-0">Transaksi Sukses</h5>
                    <span class="h4 font-weight-bold mb-0"><?php echo count($transaction_success); ?></span>
                </div>
                <div class="icon icon-shape bg-light-primary text-primary rounded-circle">
                    <i class="feather-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card my-3 shadow-sm">
    <div class="card-header bg-white">
        Data Penjualan Per Bulan
    </div>
    <div class="card-body">
        <canvas id="myChart" width="400" height="100"></canvas>
    </div>
</div>
<script src="<?php echo base_url('assets/template/web/vendor/chart/chart.min.js'); ?>"></script>
<?php
$alltransaction         = $this->transaction_model->get_chart();

foreach ($alltransaction as $data) {
    $tanggal[] =  date('M-Y', strtotime($data->created_at));
    $order[] = (float) $data->total;
}
?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($tanggal); ?>,
            datasets: [{
                label: 'Total Sales ',
                data: <?php echo json_encode($order); ?>,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    beginAtZero: true,
                    callback: function(value) {
                        if (value % 1 === 0) {
                            return value;
                        }
                    }
                }],
            }
        }
    });
</script>