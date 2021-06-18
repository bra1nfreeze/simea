<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$id_tim = $_GET['id_tim'];
$mts = tampil("SELECT * FROM team WHERE id_tim = '$id_tim'")[0];

//proses edit data
if (isset($_POST['simpan'])) {
    if (edit_tim($_POST) > 0) {
        echo "<script>
            setTimeout(function(){
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil diperbarui',
                    timer: 3000,
                    showConfirmButton: true
                });
            },20);
            window.setTimeout(function(){
            window.location.replace('team.php');
            },3000);
        </script>";
    } else {
        echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Data gagal diperbarui',
                    text: 'Periksa kembali kondingan'
                });

                </script>";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Sistem Informasi Manajemen Tim Esports</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="dist/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="dist/sweetalert2.min.css">

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
                        <li>
                            <a href="manager.php"><i class="fa fa-user-secret"></i> <span>Manager</span></a>
                        </li>
                        <li class="active">
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
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Team</h4>
                    </div>
                </div>
                <header>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="id_tim" value="<?= $mts['id_tim']; ?>">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ID Manajer <span class="text-danger">*</span></label>
                                            <select class="select" name="id_manajer">
                                                <option>Select
                                                <option>
                                                    <?php
                                                    $sql = "SELECT id_manajer, nama_manajer FROM manager";
                                                    $query = mysqli_query($conn, $sql);
                                                    while ($data = mysqli_fetch_assoc($query)) {
                                                        echo '<option value="' . $data['id_manajer'] . '">' . $data['nama_manajer'] . '</option>';
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Foto Tim</label>
                                            <div class="profile-upload">
                                                <div class="upload-img">
                                                    <img alt="" src="assets/img/user.jpg">
                                                </div>
                                                <div class="upload-input">
                                                    <input type="file" class="form-control" name="foto_tim" value="<?= $mts['foto_tim']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Team <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="nama_tim" value="<?= $mts['nama_tim']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Divisi <span class="text-danger">*</span></label>
                                            <input type="text" name="divisi" class="form-control" value="<?= $mts['divisi']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button type="submit" name="simpan" class="btn btn-primary submit-btn">Perbarui</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </header>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="dist/sweetalert2.all.js"></script>
    <script src="dist/sweetalert2.js"></script>
    <script src="dist/sweetalert2.min.js"></script>

</body>

</html>