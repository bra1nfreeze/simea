<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$id_manajer = $_GET['id_manajer'];
if (hapus_manajer($id_manajer) > 0) {
    echo "<script>
            setTimeout(function(){
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus',
                    timer: 3000,
                    showConfirmButton: true
                });
            },20);
            window.setTimeout(function(){
            window.location.replace('manager.php');
            },3000);
        </script>";
} else {
    echo
    mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Sistem Informasi Manajemen Tim Esports</title>
    <link rel='stylesheet' type='text/css' href='dist/sweetalert2.css'>
    <link rel='stylesheet' type='text/css' href='dist/sweetalert2.min.css'>
</head>

<body>
    <script src='dist/sweetalert2.all.min.js'></script>
    <script src='dist/sweetalert2.all.js'></script>
    <script src='dist/sweetalert2.js'></script>
    <script src='dist/sweetalert2.min.js'></script>
</body>

</html>