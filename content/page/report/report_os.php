<?php
// Settingan width sebelumnya 612
include ('../../../config/koneksi.php');
$bulan = $_GET['bulan'];
$asuransi = $_GET['asuransi'];
if ($asuransi == "all"){
    $asuransi = '';
}
$hasil2 = 0;
//Ambil data unit berdasarkan kode bulan
if ($bulan == 0){
    $bulan = '';
}
if ($asuransi == ''){
    $query = "SELECT * FROM unit u JOIN estimasi e ON u.u_kode = e.u_kode WHERE MONTH(es_tgl_masuk) = '$bulan' ORDER BY e.es_tgl_masuk ASC";
}else 
{
    $query = "SELECT * FROM unit u JOIN estimasi e ON u.u_kode = e.u_kode WHERE MONTH(es_tgl_masuk) = '$bulan' AND asuransi = '$asuransi' ORDER BY e.es_tgl_masuk ASC";
}
$ambil = mysql_query($query) or die (mysql_error());
$total = 0;
$total2 = 0;
    
// $totales = mysql_query("SELECT SUM(ja_price) AS totaljasa FROM unit u JOIN estimasi e ON u.u_kode = e.u_kode WHERE MONTH(e.es_tgl_masuk) = '$bulan' GROUP BY u.u_nama ORDER BY u.u_nama ASC") or die (mysql_error());
?>
<!DOCTYPE html">
<html>
<head>
    <title>OS__<?php echo ubahasuransi($asuransi).' '.ubahbulan($bulan) ?></title>
<link rel="stylesheet" href="../../../css/report.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<!-- onload="window.print()" -->
<body onload="window.print()" >
<div id="wrapper2">

  <table width="100%" align="center" cellpadding="3" cellspacing="1">
      <tr><th colspan="8"><h3>Data OutStanding <?php echo 'Asuransi '.ubahasuransi($asuransi).' Bulan '.ubahbulan($bulan) ?></h3></th></tr>
      <tr><th colspan="8">&nbsp;</th></tr>
      <th class=judul>No</th>
      <th class=judul>Nopol</th>
      <th class=judul>Tgl Masuk</th>
      <th class=judul>Nama Tertanggung</th>
      <th class="judul">Type</th>
      <th class=judul>Jasa</th>
      <th class=judul>Part</th>
      <th class=judul>Total</th>
  <?php
  $no = 0;
  while ($data = mysql_fetch_array($ambil)){
    $no++;
    $hasil = 0;
    $hasil2 = 0;
    $es_kode = $data['es_kode'];
    echo '<tr>
          <td>'.$no.'</td>
          <td>'.strtoupper($data['u_nopol']).'</td>';
    echo '<td>'.angkakebulan($data['es_tgl_masuk']).'</td>';
    echo '<td>'.$data['u_nama']."</td>";
    echo '<td>'.$data['u_model']."</td>";
    $ambiljakode = mysql_query("SELECT * FROM estimasijasa WHERE es_kode = '$es_kode' ");
    $ambilpartkode = mysql_query("SELECT * FROM estimasipart WHERE es_kode = '$es_kode' ");
    
    while ($dataja = mysql_fetch_array($ambiljakode)){
        $ja_kodes = $dataja['ja_kode'];
        $totjasa = mysql_query("SELECT SUM(ja_price) AS totaljasa FROM jasa WHERE ja_kode = '$ja_kodes' ")or die (mysql_error());
        $ambiltotja = mysql_fetch_array($totjasa);
        $hasil = $ambiltotja['totaljasa'] + $hasil;
        
    }
    // Part
    while ($dataja = mysql_fetch_array($ambilpartkode)){
        $part_kodes = $dataja['part_kode'];
        $totpart = mysql_query("SELECT SUM(part_harga) AS totalpart FROM part WHERE part_kode = '$part_kodes' ")or die (mysql_error());
        $ambiltotpart = mysql_fetch_array($totpart);
        $hasil2 = $ambiltotpart['totalpart'] + $hasil2;
        
    }
    
    $total = $total + $hasil;
    $total2 = $total2 + $hasil2; // Total Part
        
    $jasadanpart = $hasil + $hasil2;
    
    
    echo '<td align=right>'.rupiah($hasil).'</td>';
    echo '<td align=right>'.rupiah($hasil2).'</td>';
    echo '<td align=right>'.rupiah($jasadanpart).'</td></tr>';
        
    }
    
    $total = $total;
    $total2 = $total2 + $hasil2; // Total Part
    $total3 = $total + $total2;    
    
    echo '<tr><td  class=judul colspan=5 align=center>Total </td><td align=right>'.rupiah($total).'</td><td align=right>'.rupiah($total2).'</td><td align=right><u>'.  rupiah($total3).'</u></td></tr>';
    echo '</table>';
  /*
  if ($jmlpart != 0){
      for ($i=1;$i <= $jmlpart;$i++){ 
          $esget = mysql_fetch_array($es);
          $ess = $esget['part_kode'];
          $estimasi = mysql_query("SELECT * FROM part WHERE part_kode = '$ess' ");
          
          $result2 = mysql_fetch_array($estimasi);
          $part_kode = $result2['part_kode'];
          $space = "";
          if ($i < 10){
              $space = "&nbsp";
          }
          if ($i%3){
              echo "<td width=30%>".$i.$space.". ".$result2['part_nama']."</td>";
          }
          else {
              echo "<td width=30%>".$i.$space.". ".$result2['part_nama']."</td></tr>";
          }
      }
  }
   
   */
  ?>
</table>
	<br />
	<p align=right>Hormat Kami</p>
    <br />
    <br />
    <p align=right>Manager Bengkel</p>
  
</div>
</body>
</html>