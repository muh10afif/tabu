<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Taman Batu</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6 col-xl-3"> 
        <div class="card shadow bg-primary text-white text-center">
            <div class="card-heading p-4">
                <div>
                    <h4 class="tgl-part"></h4>
                </div>
                <h3 style="margin-top: 20px;" class="time-part"></h3>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card shadow">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right mt-1">
                    <i class="ti-medall bg-success text-white"></i>
                </div>
                <div>
                    <h4 class="font-20">Transaksi</h4>
                </div>
                <h3 style="margin-top: 50px;" class="text-center"><?= $transaksi ?></h3>
                <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card shadow">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right mt-1">
                    <i class="ti-user bg-info text-white"></i>
                </div>
                <div>
                    <h4 class="font-20">Pengunjung</h4>
                </div>
                <h3 style="margin-top: 50px;" class="text-center"><?= $pengunjung ?></h3>
                <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card shadow">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right mt-1">
                    <i class="ti-money bg-warning text-white"></i>
                </div>
                <div>
                    <h4 class="font-20">Pemasukan</h4>
                </div>
                <h3 style="margin-top: 50px;" class="text-center">Rp. <?= number_format($pendapatan,0,'.','.') ?></h3>
                <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">

                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item waves-effect waves-light shadow">
                        <a class="nav-link active" data-toggle="tab" href="#pertanggal" role="tab">
                            <span class="d-none d-md-block font-weight-bold">Per Tanggal</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light shadow">
                        <a class="nav-link" data-toggle="tab" href="#perbulan" role="tab">
                            <span class="d-none d-md-block font-weight-bold">Per Bulan</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span> 
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active p-3" id="pertanggal" role="tabpanel">
                        <p class="mb-0 mt-1">
                        <canvas id="pertanggal_c" height="110"></canvas>
                        </p>
                        <p class="mb-0 mt-3">
                        <canvas id="pertanggal_p" height="110"></canvas>
                        </p>
                    </div>

                    <div class="tab-pane p-3" id="perbulan" role="tabpanel">
                        <p class="mb-0 mt-1">
                            <canvas id="perbulan_c" height="110"></canvas>
                        </p>
                        <p class="mb-0 mt-3">
                            <canvas id="perbulan_p" height="110"></canvas>
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>

<?php 

    foreach ($bln as $b) {
        $bulan[] = $b;
    }

    foreach ($day as $d) {
        $hari[] = $d;
    }

    foreach ($pendapatan_h as $pd) {
        $pd_h[] = $pd;
    }

    foreach ($transaksi_h as $t) {
        $t_h[] = $t;
    }

    foreach ($pengunjung_h as $pj) {
        $pj_h[] = $pj;
    }

    foreach ($pendapatan_b as $pdb) {
        $pd_b[] = $pdb;
    }

    foreach ($transaksi_b as $tb) {
        $t_b[] = $tb;
    }

    foreach ($pengunjung_b as $pjb) {
        $pj_b[] = $pjb;
    }

?>

<script>
    $(document).ready(function () {

        var ctx = document.getElementById('perbulan_c').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($bulan) ?>,
                datasets: [
                {
                    label: "Transaksi",
                    backgroundColor: "rgba(141, 252, 221, 0.4)",
                    borderColor: "#02c58d",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(141, 252, 221, 0.5)",
                    hoverBorderColor: "#02c58d",
                    data: <?= json_encode($t_b) ?>
                },
                {
                    label: "Pengunjung",
                    backgroundColor: "rgba(219, 243, 255, 0.4)",
                    borderColor: "#59c6fb",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(219, 243, 255, 0.5)",
                    hoverBorderColor: "#59c6fb",
                    data: <?= json_encode($pj_b) ?>
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // 05-11-2020
        var ctx = document.getElementById('pertanggal_c').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($hari) ?>,
                datasets: [
                {
                    label: "Transaksi",
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(54, 245, 190, 0.2)",
                    borderColor: "#02c58d",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#02c58d",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#02c58d",
                    pointHoverBorderColor: "#eef0f2",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: <?= json_encode($t_h) ?>
                },
                {
                    label: "Pengunjung",
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(140, 211, 245, 0.2)",
                    borderColor: "#59c6fb",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#59c6fb",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#59c6fb",
                    pointHoverBorderColor: "#59c6fb",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: <?= json_encode($pj_h) ?>
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // 05-11-2020
        var ctx = document.getElementById('pertanggal_p').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($hari) ?>,
                datasets: [
                {
                    label: 'Pendapatan',
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(227, 190, 102, 0.2)",
                    borderColor: "#fcbe2d",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#fcbe2d",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fcbe2d",
                    pointHoverBorderColor: "#fcbe2d",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: <?= json_encode($pd_h) ?>
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if(parseInt(value) >= 1000){
                                    return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                } else {
                                    return 'Rp.' + value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chart){
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp. ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    }
                },
            }
        });

        var ctx = document.getElementById('perbulan_p').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($bulan) ?>,
                datasets: [
                {
                    label: 'Pendapatan',
                    backgroundColor: "rgba(255, 240, 204, 0.4)",
                    borderColor: "#fcbe2d",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(255, 240, 204, 0.5)",
                    hoverBorderColor: "#fcbe2d",
                    data: <?= json_encode($pd_b) ?>
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if(parseInt(value) >= 1000){
                                    return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                } else {
                                    return 'Rp.' + value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chart){
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp. ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    }
                },
            }
        });
        
    })
</script>