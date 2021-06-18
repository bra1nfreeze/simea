<?php
include('function.php');
require_once("dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$query = mysqli_query($conn, "select * from player");

$html = '<hr><center><h3>Data Pemain</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
<tr>
<th>Nomor</th>
<th>ID Pemain</th>
<th>ID Team</th>
<th>ID Penghargaan</th>
<th>Nama Pemain</th>
<th>Tanggal Lahir</th>
<th>Jurusan</th>
<th>Nickname</th>
<th>Divisi</th>
<th>Role</th>
<th>Alamat</th>
<th>Nomor HP</th>
<th>Nama Penghargaan</th>
<th>Status</th>
</tr>';
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $html .= "<tr>
    <td>" . $no . "</td>
    <td>" . $row['id_pemain'] . "</td>
    <td>" . $row['id_tim'] . "</td>
    <td>" . $row['id_pemain'] . "</td>
    <td>" . $row['nama_pemain'] . "</td>
    <td>" . $row['tgl_lahir'] . "</td>
    <td>" . $row['jurusan'] . "</td>
    <td>" . $row['nickname'] . "</td>
    <td>" . $row['divisi'] . "</td>
    <td>" . $row['role'] . "</td>
    <td>" . $row['alamat'] . "</td>
    <td>" . $row['no_hp'] . "</td>
    <td>" . $row['nama_penghargaan'] . "</td>
    <td>" . $row['status'] . "</td>
    </tr>";
    $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A3', 'landscape');
// Rendering dari HTML ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_data_pemain.pdf');
