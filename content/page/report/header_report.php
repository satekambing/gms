<?php
require_once('../../../config/koneksi.php');
require_once('../../../function/asuransi.php');
require_once('../../../function/tanggal.php');
require_once('../../../function/fungsi_view.php');

$u_kode = $_GET['u_kode'];
//Ambil data unit berdasarkan kode unit
$query1 = mysqli_query($koneksi, "SELECT * FROM unit, estimasi WHERE unit.u_kode = '$u_kode' AND estimasi.u_kode = '$u_kode' ")or die (mysqli_error());
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
<link rel="stylesheet" href="../../../css/report.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
 <!-- onload="window.print()" -->
<body onload="window.print()">
<div id="wrapper">
<table width="100%" align="center" cellpadding="3" cellspacing="2">
  <tr>
    <td class="kiri">Asuransi</td>
    <td>:</td>
    <td class="kanan"><?php echo NamaAsuransi($unit['asuransi']) ?></td>
    <td colspan="3" rowspan="3" valign=middle><div class=kanan style="height: 100%"><img src="../../../img/logo.png" width="88" height="68"></div>
    <div align=right><p style="font-size: 14px">Bengkel Gelis Motor Sampit</p>
    <p class="sepuluh">JL. Sampurna Sampit </p>
    <p class="sepuluh">TELP. 081 349002722</p>
    <p class="sepuluh">E-Mail. Gelismotorsampit@gmail.com</p>
    </div></td>
  </tr>
  <tr>
    <td>Kode</td>
    <td>:</td>
    <td class="kanan"><?php echo $unit['es_kode']?></td>
  </tr>
  <tr>
    <td>Tgl Cetak</td>
    <td>:</td>
    <td class="kanan"><?php echo $tglnow?></td>
  </tr>
  <tr>
    <td width="17%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="32%" class="kanan">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="besar">Nama</td>
    <td>:</td>
    <td class=""><?php echo $unit['u_nama']?></td>
    <td>Tgl Masuk</td>
    <td>:</td>
    <td><?php echo UbahTanggalKeBulan($unit['es_tgl_masuk'])?></td>
  </tr>
  <tr>
    <td class="besar">Nopol</td>
    <td>:</td>
    <td class=""><?php echo $unit['u_nopol']?></td>
    <td>Estimasi Tgl Keluar</td>
    <td>:</td>
    <td><?php echo $unit['es_tgl_keluar']?></td>
  </tr>
  <tr>
    <td class="besar">Nomor Rangka</td>
    <td>:</td>
    <td class=""><?php echo $unit['u_norangka']?></td>
     <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="besar">Nomor Mesin</td>
    <td>:</td>
    <td class=""><?php echo $unit['u_nomesin']?></td>
    <td>Tahun Kendaraan</td>
    <td>:</td>
    <td><?php echo $unit['u_tahun']?></td>
  </tr>
  <tr>
    <td class="besar">Type </td>
    <td>:</td>
    <td class=""><?php echo $unit['u_merk'].' '.$unit['u_model']?></td>
    <td>No. Model</td>
    <td>:</td>
    <td><?php echo $unit['u_nomodel']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>

    </tr>

     </table>
