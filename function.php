<?php

//Koneksi Ke Database
$conn = mysqli_connect("localhost", "root", "", "simea");

// Function Tampil Data
function tampil($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Function Tambah Data
function tambah_manajer($data)
{
    global $conn;

    $id_manajer = htmlspecialchars($data['id_manajer']);
    $nama_manajer = htmlspecialchars($data['nama_manajer']);
    $foto_manajer = $_FILES['foto_manajer']['name'];
    $sumber = $_FILES['foto_manajer']['tmp_name'];
    $folder = './assets/img/';

    //untuk memindahkan foto ke folder yang telah di buat
    move_uploaded_file($sumber, $folder . $foto_manajer);

    $query = "INSERT INTO manager VALUES ('$id_manajer','$foto_manajer','$nama_manajer')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambah_tim($data)
{
    global $conn;

    $id_tim = $data['id_tim'];
    $id_manajer = htmlspecialchars($data['id_manajer']);
    $foto_tim = $_FILES['foto_tim']['name'];
    $sumber = $_FILES['foto_tim']['tmp_name'];
    $folder = './assets/img/';

    //untuk memindahkan foto ke folder yang telah di buat
    move_uploaded_file($sumber, $folder . $foto_tim);

    $nama_tim = htmlspecialchars($data['nama_tim']);
    $divisi = htmlspecialchars($data['divisi']);

    $query = "INSERT INTO team VALUES 
    ('$id_tim','$id_manajer','$foto_tim','$nama_tim','$divisi')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambah_penghargaan($data)
{
    global $conn;

    $id_penghargaan = $data['id_penghargaan'];
    $nama_penghargaan = htmlspecialchars($data['nama_penghargaan']);
    $pendapatan = htmlspecialchars($data['pendapatan']);
    $tgl_ach = htmlspecialchars($data['tgl_ach']);
    $tgl_ach = date('Y-m-d', strtotime($tgl_ach));

    $query = "INSERT INTO penghargaan 
    VALUES ('$id_penghargaan','$nama_penghargaan','$pendapatan','$tgl_ach')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambah_player($data)
{
    global $conn;

    $id_pemain = $data['id_pemain'];
    $id_tim = htmlspecialchars($data['id_tim']);
    $id_penghargaan = htmlspecialchars($data['id_penghargaan']);
    $foto = $_FILES['foto']['name'];
    $sumber = $_FILES['foto']['tmp_name'];
    $folder = './assets/img/players/';
    //untuk memindahkan foto ke folder yang telah di buat
    move_uploaded_file($sumber, $folder . $foto);
    $nama_pemain = htmlspecialchars($data['nama_pemain']);
    $tgl_lahir = htmlspecialchars($data['tgl_lahir']);
    $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
    $jurusan = htmlspecialchars($data['jurusan']);
    $nickname = htmlspecialchars($data['nickname']);
    $divisi = htmlspecialchars($data['divisi']);
    $role = htmlspecialchars($data['role']);
    $alamat = htmlspecialchars($data['alamat']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $nama_penghargaan = htmlspecialchars($data['nama_penghargaan']);
    $status = htmlspecialchars($data['status']);

    $query = "INSERT INTO player VALUES 
    ('$id_pemain', '$id_tim', '$id_penghargaan', '$foto', 
    '$nama_pemain', '$tgl_lahir', '$jurusan', '$nickname', '$divisi', 
    '$role', '$alamat', '$no_hp', '$nama_penghargaan', '$status')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// Function Hapus data
function hapus_pemain($id_pemain)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM player WHERE id_pemain = '$id_pemain'");
    return mysqli_affected_rows($conn);
}

function hapus_tim($id_tim)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM team wHERE id_tim = '$id_tim'");
    return mysqli_affected_rows($conn);
}

function hapus_penghargaan($id_penghargaan)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM penghargaan wHERE id_penghargaan = '$id_penghargaan'");
    return mysqli_affected_rows($conn);
}

function hapus_manajer($id_manajer)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM manager wHERE id_manajer = '$id_manajer'");
    return mysqli_affected_rows($conn);
}

// function edit data
function edit_manajer($data)
{
    global $conn;

    $id_manajer = $data['id_manajer'];
    $foto_manajer = $_FILES['foto_manajer']['name'];
    $sumber = $_FILES['foto_manajer']['tmp_name'];
    $folder = './assets/img/';

    //untuk memindahkan foto ke folder yang telah di buat
    move_uploaded_file($sumber, $folder . $foto_manajer);

    $nama_manajer = htmlspecialchars($data['nama_manajer']);

    $query = "UPDATE manager SET id_manajer = '$id_manajer', 
    foto_manajer = '$foto_manajer', nama_manajer = '$nama_manajer' 
    WHERE id_manajer = '$id_manajer'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_tim($data)
{
    global $conn;

    $id_tim = $data['id_tim'];
    $id_manajer = htmlspecialchars($data['id_manajer']);
    $foto_tim = $_FILES['foto_tim']['name'];
    $sumber = $_FILES['foto_tim']['tmp_name'];
    $folder = './assets/img/';

    //untuk memindahkan foto ke folder yang telah di buat
    move_uploaded_file($sumber, $folder . $foto_tim);

    $nama_tim = htmlspecialchars($data['nama_tim']);
    $divisi = htmlspecialchars($data['divisi']);

    $query = "UPDATE team SET id_tim = '$id_tim', id_manajer = '$id_manajer', 
    foto_tim = '$foto_tim', nama_tim = '$nama_tim', divisi = '$divisi' 
    WHERE id_tim = '$id_tim'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_penghargaan($data)
{
    global $conn;

    $id_penghargaan = htmlspecialchars($data['id_penghargaan']);
    $nama_penghargaan = htmlspecialchars($data['nama_penghargaan']);
    $pendapatan = $data['pendapatan'];
    $tgl_ach = htmlspecialchars($data['tgl_ach']);
    $tgl_ach = date('Y-m-d', strtotime($tgl_ach));

    $query = "UPDATE penghargaan SET id_penghargaan = '$id_penghargaan', 
    nama_penghargaan = '$nama_penghargaan', pendapatan = '$pendapatan', 
    tgl_ach = '$tgl_ach' WHERE id_penghargaan = '$id_penghargaan'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_pemain($data)
{
    global $conn;

    $id_pemain = $data['id_pemain'];
    $id_tim = htmlspecialchars($data['id_tim']);
    $id_penghargaan = htmlspecialchars($data['id_penghargaan']);
    $foto = $_FILES['foto']['name'];
    $sumber = $_FILES['foto']['tmp_name'];
    $folder = './assets/img/players/';
    //untuk memindahkan foto ke folder yang telah di buat
    move_uploaded_file($sumber, $folder . $foto);
    $nama_pemain = htmlspecialchars($data['nama_pemain']);
    $tgl_lahir = htmlspecialchars($data['tgl_lahir']);
    $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
    $jurusan = htmlspecialchars($data['jurusan']);
    $nickname = htmlspecialchars($data['nickname']);
    $divisi = htmlspecialchars($data['divisi']);
    $role = htmlspecialchars($data['role']);
    $alamat = htmlspecialchars($data['alamat']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $nama_penghargaan = htmlspecialchars($data['nama_penghargaan']);
    $status = htmlspecialchars($data['status']);

    $query = "UPDATE player SET id_pemain = '$id_pemain', id_tim = '$id_tim',
    id_penghargaan = '$id_penghargaan', foto = '$foto', nama_pemain = '$nama_pemain',
    tgl_lahir = '$tgl_lahir', jurusan = '$jurusan', nickname = '$nickname',
    divisi = '$divisi', role = '$role', alamat = '$alamat', no_hp = '$no_hp', 
    nama_penghargaan = '$nama_penghargaan', status = '$status' WHERE id_pemain = '$id_pemain'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
