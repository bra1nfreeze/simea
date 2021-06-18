<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$data = tampil("SELECT * FROM manager");

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

</head>

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
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a>
                        </li>
                        <li class="active">
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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Manager</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="tambah_manager.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Tambah Manager</a>
                    </div>
                </div>
                <div class="row doctor-grid">

                    <?php foreach ($data as $mts) : ?>

                        <div class="col-md-4 col-sm-4  col-lg-3">
                            <div class="profile-widget">
                                <div class="doctor-img">
                                    <a class="avatar"><img alt="" src="assets/img/<?= $mts['foto_manajer']; ?>"></a>
                                </div>
                                <div class="dropdown profile-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="edit_manajer.php?id_manajer=<?= $mts['id_manajer']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item" href="hapus_manajer.php?id_manajer=<?= $mts['id_manajer']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                                <h4 class="doctor-name text-ellipsis"><?= $mts['nama_manajer']; ?></h4>
                                <div class='doc-prof'><?= $mts['id_manajer']; ?></div>
                            </div>
                        </div>

                    <?php endforeach; ?>

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
    <script src="assets/js/app.js"></script>

</body>

</html>