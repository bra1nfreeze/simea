<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$tampil = mysqli_query($conn, "SELECT * FROM manager");
$tampil2 = mysqli_query($conn, "SELECT * FROM team");
$tampil3 = mysqli_query($conn, "SELECT * FROM penghargaan");
$tampil4 = mysqli_query($conn, "SELECT * FROM player");

$jumlah = mysqli_num_rows($tampil);
$jumlah2 = mysqli_num_rows($tampil2);
$jumlah3 = mysqli_num_rows($tampil3);
$jumlah4 = mysqli_num_rows($tampil4);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Sistem Informasi Manajemen Tim Esports</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script type="text/javascript" src="assets/Chart.js"></script>
</head>

<body>

    <body>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="index.php" class="logo">
                        <img src="assets/img/logo-upn.png" width="35" height="35" alt=""> <span>
                            <h4>SIMEA</h4>
                        </span>
                    </a>
                </div>
                <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
                <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
                <ul class="nav user-menu float-right">
                    <li class="nav-item dropdown has-arrow">
                        <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin">
                            </span>
                            <span>Admin</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="logout.php">Keluar</a>
                        </div>
                    </li>
                </ul>
                <div class="dropdown mobile-user-menu float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="index.php">Keluar</a>
                    </div>
                </div>
            </div>
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>
                            <li class="active">
                                <a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a>
                            </li>
                            <li>
                                <a href="manager.php"><i class="fa fa-user-secret"></i> <span>Manager</span></a>
                            </li>
                            <li>
                                <a href="team.php"><i class="fa fa-podcast"></i> <span>Team</span></a>
                            </li>
                            <li>
                                <a href="penghargaan.php"><i class="fa fa-star"></i> <span>Penghargaan</span></a>
                            </li>
                            <li>
                                <a href="player.php"><i class="fa fa-users"></i> <span>Player</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget">
                                <span class="dash-widget-bg2"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $jumlah; ?></h3>
                                    <span class="widget-title2">Manager <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget">
                                <span class="dash-widget-bg1"><i class="fa fa-podcast"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $jumlah2; ?></h3>
                                    <span class="widget-title1">Team <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget">
                                <span class="dash-widget-bg2"><i class="fa fa-star" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $jumlah3; ?></h3>
                                    <span class="widget-title2">Penghargaan <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget">
                                <span class="dash-widget-bg1"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $jumlah4; ?></h3>
                                    <span class="widget-title1">Players <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="chart-title">
                                        <h4>Total Pemain</h4>
                                    </div style="width: 800px;height: 800px">
                                    <canvas id="myChart"></canvas>
                                </div>
                                <script>
                                    var ctx = document.getElementById("myChart").getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: ["Manajemen", "Akuntasi", "Ekonomi Pembangunan", "Arsitektur", "Agroteknologi", "Agribisnis", "Teknik Kimia", "Teknik Industri", "Teknik Sipil", "Teknik Lingkungan", "Teknik Pangan", "Teknik Mesin", "Adm. Negara", "Adm. Bisnis", "Ilmu Komunikasi", "Hub. Internasional", "Pariwisata", "Hukum", "Informatika", "Sistem Informasi", "Data Sains"],
                                            datasets: [{
                                                label: 'Grapich Total Pasien',
                                                data: [
                                                    <?php
                                                    $jumlah_manajemen = mysqli_query($conn, "SELECT * FROM player where jurusan = 'Manajemen'");
                                                    echo mysqli_num_rows($jumlah_manajemen);
                                                    ?>,
                                                    <?php
                                                    $jumlah_akuntasi = mysqli_query($conn, "SELECT * FROM player where jurusan = 'Akuntasi'");
                                                    echo mysqli_num_rows($jumlah_akuntasi);
                                                    ?>,
                                                    <?php
                                                    $jumlah_ep = mysqli_query($conn, "SELECT * FROM player where jurusan ='Ekonomi'");
                                                    echo mysqli_num_rows($jumlah_ep);
                                                    ?>,
                                                    <?php
                                                    $jumlah_arsitektur = mysqli_query($conn, "SELECT * FROM player where jurusan ='Arsitektur'");
                                                    echo mysqli_num_rows($jumlah_arsitektur);
                                                    ?>,
                                                    <?php
                                                    $jumlah_agroteknologi = mysqli_query($conn, "SELECT * FROM player where jurusan ='Agroteknologi'");
                                                    echo mysqli_num_rows($jumlah_agroteknologi);
                                                    ?>,
                                                    <?php
                                                    $jumlah_agribisnis = mysqli_query($conn, "SELECT * FROM player where jurusan ='Agribisnis'");
                                                    echo mysqli_num_rows($jumlah_agribisnis);
                                                    ?>,
                                                    <?php
                                                    $jumlah_tk = mysqli_query($conn, "SELECT * FROM player where jurusan ='Teknik Kimia'");
                                                    echo mysqli_num_rows($jumlah_tk);
                                                    ?>,
                                                    <?php
                                                    $jumlah_ti = mysqli_query($conn, "SELECT * FROM player where jurusan ='Teknik Industri'");
                                                    echo mysqli_num_rows($jumlah_ti);
                                                    ?>,
                                                    <?php
                                                    $jumlah_ts = mysqli_query($conn, "SELECT * FROM player where jurusan ='Teknik Sipil'");
                                                    echo mysqli_num_rows($jumlah_ts);
                                                    ?>,
                                                    <?php
                                                    $jumlah_tl = mysqli_query($conn, "SELECT * FROM player where jurusan ='Teknik Lingkungan'");
                                                    echo mysqli_num_rows($jumlah_tl);
                                                    ?>,
                                                    <?php
                                                    $jumlah_tp = mysqli_query($conn, "SELECT * FROM player where jurusan ='Teknik Pangan'");
                                                    echo mysqli_num_rows($jumlah_tp);
                                                    ?>,
                                                    <?php
                                                    $jumlah_tm = mysqli_query($conn, "SELECT * FROM player where jurusan ='Teknik Mesin'");
                                                    echo mysqli_num_rows($jumlah_tm);
                                                    ?>,
                                                    <?php
                                                    $jumlah_anegara = mysqli_query($conn, "SELECT * FROM player where jurusan ='Adm. Negara'");
                                                    echo mysqli_num_rows($jumlah_anegara);
                                                    ?>,
                                                    <?php
                                                    $jumlah_abisnis = mysqli_query($conn, "SELECT * FROM player where jurusan ='Adm. Bisnis'");
                                                    echo mysqli_num_rows($jumlah_abisnis);
                                                    ?>,
                                                    <?php
                                                    $jumlah_ilkom = mysqli_query($conn, "SELECT * FROM player where jurusan ='Ilmu Komunikasi'");
                                                    echo mysqli_num_rows($jumlah_ilkom);
                                                    ?>,
                                                    <?php
                                                    $jumlah_hi = mysqli_query($conn, "SELECT * FROM player where jurusan ='Hub. Internasional'");
                                                    echo mysqli_num_rows($jumlah_hi);
                                                    ?>,
                                                    <?php
                                                    $jumlah_pariwisata = mysqli_query($conn, "SELECT * FROM player where jurusan ='Pariwisata'");
                                                    echo mysqli_num_rows($jumlah_pariwisata);
                                                    ?>,
                                                    <?php
                                                    $jumlah_hukum = mysqli_query($conn, "SELECT * FROM player where jurusan ='Hukum'");
                                                    echo mysqli_num_rows($jumlah_hukum);
                                                    ?>,
                                                    <?php
                                                    $jumlah_informatika = mysqli_query($conn, "SELECT * FROM player where jurusan ='Informatika'");
                                                    echo mysqli_num_rows($jumlah_hi);
                                                    ?>,
                                                    <?php
                                                    $jumlah_sifo = mysqli_query($conn, "SELECT * FROM player where jurusan ='Sistem Informasi'");
                                                    echo mysqli_num_rows($jumlah_sifo);
                                                    ?>,
                                                    <?php
                                                    $jumlah_dasains = mysqli_query($conn, "SELECT * FROM player where jurusan ='Data Sains'");
                                                    echo mysqli_num_rows($jumlah_dasains);
                                                    ?>
                                                ],
                                                backgroundColor: [
                                                    'rgba(0, 255, 255, 0.1)',
                                                    'rgba(0, 255, 255, 0.3)',
                                                    'rgba(255, 255, 0, 0.3)',
                                                    'rgba(255, 0, 0, 0.3)',
                                                    'rgba(255, 0, 255, 0.3)',
                                                    'rgba(2, 99, 95, 0.3)',
                                                    'rgba(128, 0, 128, 0.3)',
                                                    'rgba(0, 128, 128, 0.3)',
                                                    'rgba(255, 6, 6, 0.3)',
                                                    'rgba(2, 206, 86, 0.3)',
                                                    'rgba(255, 2, 86, 0.3)',
                                                    'rgba(255, 206, 8, 0.3)',
                                                    'rgba(81, 180, 51, 0.3)',
                                                    'rgba(13, 35, 58, 0.3)',
                                                    'rgba(179, 78, 101, 0.3)',
                                                    'rgba(1, 77, 173, 0.3)',
                                                    'rgba(253, 190, 87, 0.3)',
                                                    'rgba(78, 185, 117, 0.3)',
                                                    'rgba(185, 185, 185, 0.3)',
                                                    'rgba(124, 170, 254, 0.3)',
                                                    'rgba(0, 0, 0, 0.3)'
                                                ],
                                                hoverOffset: 4
                                            }]
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
                                </script>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="chart-title">
                                        <h4>Jumlah Pendapatan Tim Esports</h4>
                                    </div>
                                    <canvas id="myChart2"></canvas>
                                </div>
                                <script>
                                    var ctx = document.getElementById("myChart2").getContext('2d');
                                    var myChart2 = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                                            datasets: [{
                                                label: 'Grapich Total Pendapatan',
                                                data: [
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=1"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=2"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=3"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=4"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=5"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=6"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=7"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=8"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=9"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=10"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=11"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>,
                                                    <?php
                                                    $jumlah_1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pendapatan) as Jumlah FROM penghargaan where MONTH(tgl_ach)=12"));
                                                    echo $jumlah_1['Jumlah'];
                                                    ?>
                                                ],
                                                backgroundColor: [
                                                    'rgba(0, 0, 255, 0.3)',
                                                    'rgba(0, 255, 255, 0.3)',
                                                    'rgba(255, 255, 0, 0.3)',
                                                    'rgba(255, 0, 0, 0.3)',
                                                    'rgba(255, 0, 255, 0.3)',
                                                    'rgba(2, 99, 95, 0.3)',
                                                    'rgba(128, 0, 128, 0.3)',
                                                    'rgba(0, 128, 128, 0.3)',
                                                    'rgba(255, 6, 6, 0.3)',
                                                    'rgba(2, 206, 86, 0.3)',
                                                    'rgba(255, 2, 86, 0.3)',
                                                    'rgba(255, 206, 8, 0.3)'
                                                ],
                                                borderColor: [
                                                    'rgba(0, 0, 255, 1)',
                                                    'rgba(0, 255, 255, 1)',
                                                    'rgba(255, 255, 0, 1)',
                                                    'rgba(255, 0, 0, 1)',
                                                    'rgba(255, 0, 255, 1)',
                                                    'rgba(2, 99, 95, 1)',
                                                    'rgba(128, 0, 128, 1)',
                                                    'rgba(0, 128, 128, 1)',
                                                    'rgba(255, 6, 6, 1)',
                                                    'rgba(2, 206, 86, 1)',
                                                    'rgba(255, 2, 86, 1)',
                                                    'rgba(255, 206, 8, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
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
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <!-- <script src="assets/js/Chart.bundle.js"></script> -->
        <script src="assets/js/app.js"></script>

    </body>

</html>