<?php
include ('../../../config/koneksi.php');
include ('../../../function/asuransi.php');
include ('../../../function/tanggal.php');
include ('../../../function/fungsi_view.php');

$u_kode = $_GET['u_kode'];
//Ambil data unit berdasarkan kode unit
$query1 = mysqli_query($koneksi, "SELECT * FROM unit, estimasi WHERE unit.u_kode = '$u_kode' AND estimasi.u_kode = '$u_kode' ")or die (mysql_error());
$unit = mysqli_fetch_array($query1);
$es_kode = $unit['es_kode'];
$nopol = $unit['u_nopol'];
$nama = $unit['u_nama'];
$model = $unit['u_model'];

if ($unit['es_tgl_keluar'] == '0000-00-00'){
    $unit['es_tgl_keluar'] = ' ';
}
?>
<!DOCTYPE html">
<html>
<head>
<title><?php echo $nopol."_".$model.'_'.$nama ?></title>
<link rel="stylesheet" href="../../../css/report_kecil.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<!--  onload="window.print()"  -->
<body onload="window.print()">
<div class="wrapper">
  <div class="header">
    <div class="kiri">
      <div class="logo">
        <img src="../../../img/logo.png" width="88" height="68">
      </div>
      <div class="judul_atas">
        <h2>Bengkel Gelis Motor Sampit</h2>
        <p>JL. Sampurna Sampit<br>
           TELP. 081 349002722<br>
           E-Mail. Gelismotorsampit@gmail.com<br>
        </p>
      </div>
    </div>
    <div class="kanan">
      <table width=100%>
        <tr>
          <td width=40%>Tanggal </td>
          <td width=60%>: <?php echo UbahTanggalKeBulan($tanggaldb) ?></td>
        </tr>
        <tr>
          <td>Kepada Yth. </td>
          <td>: <?php echo $unit['u_nama']?> </td>
        </tr>
        <tr>
          <td>Unit  </td>
          <td>: <?php echo $unit['u_merk'].' '.$unit['u_model']?></td>
        </tr>
        <tr>
          <td>Nopol </td>
          <td>: <?php echo $unit['u_nopol']?></td>
        </tr>
      </table>
    </div>
  </div>
</div>
