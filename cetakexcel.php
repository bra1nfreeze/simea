<?php

include('function.php');
// menggunakan library phpspreadsheet
require_once("vendor\autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$header = array(
    'ID Pemain', 'ID Tim', 'ID Penghargaan',
    'Nama Pemain',
    'Tanggal Lahir', 'Jurusan',
    'Nickname', 'Divisi', 'Role',
    'Alamat', 'Nama Penghargaan',
    'Status'
);
$columm = array(
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
    'K', 'L', 'M'
);
$dbcolumm = array(
    'id_pemain', 'id_tim', 'id_penghargaan', 'nama_pemain',
    'tgl_lahir', 'jurusan', 'nickname', 'divisi', 'role',
    'alamat', 'nama_penghargaan', 'status'
);

//sheet headery
for ($i = 0; $i < sizeof($header); $i++) {
    # code...
    $j = 1;
    $sheet->setCellValue($columm[$i] . $j, $header[$i]);
}

$query = mysqli_query($conn, "select * from player");

$indexrow = 2;
while ($row = mysqli_fetch_array($query)) {
    # code...
    for ($i = 0; $i < sizeof($header); $i++) {
        # code...
        $sheet->setCellValue($columm[$i] . $indexrow, $row[$dbcolumm[$i]]);
    }
    $indexrow = $indexrow + 1;
}

$writer = new Xlsx($spreadsheet);
$writer->save('Report Data Pemain.Xlsx');
header("location: player.php");
