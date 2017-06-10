<?php
// Include Header - Unit
include ('header_report_kecil.php');

// Set nilai default dr masing" total
$totalpart = 0;
$totaljasa = 0;
$totalestimasi = 0;

//Query data part dan jasa berdasarkan estimasi.part_kode (didapat dr include diatas)
$es = mysqli_query($koneksi, "SELECT part_kode FROM estimasipart WHERE es_kode = '$es_kode'");
$es_jasa = mysqli_query($koneksi, "SELECT ja_kode FROM estimasijasa WHERE es_kode = '$es_kode' ");

//cari jumlah part
$jmlpart = mysqli_num_rows($es);

// Ambil data part dan jasa
$jmljasa = mysqli_num_rows($es_jasa);
$jmlpart = mysqli_num_rows($es);

// BEGIN OF PART
// jika hasil dari query part di temukan maka
  ?>
  <table width="100%" id="border" align="center" cellpadding="3" cellspacing="1">
    <tr><td colspan="4" class="noborder"><div class="judul"><strong> NOTA - PERBAIKAN</strong></div></td></tr>
    <tr>
      <th width="1%">NO.</td>
      <th width="20%">Jenis</td>
      <th width="55%">Keterangan</td>
      <th width="15%">Harga</td>
    </tr>
    <tr>
 <?php
 if(mysqli_num_rows($es)){
    //Lakukan perulangan sesuai jumlah part
		$jenis = "Penggantian";
    for ($i=1;$i <= $jmlpart;$i++){

      $esget = mysqli_fetch_array($es);
      $ess = $esget['part_kode'];
      $estimasi = mysqli_query($koneksi, "SELECT * FROM part WHERE part_kode = '$ess'");

      $result2 = mysqli_fetch_array($estimasi);
      $part_kode = $result2['part_kode'];
      if ($result2['part_nama'] == ''){ }
      else {
      echo "<tr>
							<td >".$i.".</td>
							<td align=center>$jenis</td>
							<td>".$result2['part_nama']."</td>
							<td align=right>".rupiah($result2['part_harga'])."</td>
						</tr>";
      }

      $sumpart = mysqli_query($koneksi, "SELECT SUM(part_harga) AS totalpart FROM part WHERE part.part_kode = '$part_kode' ")or die (mysqli_error());
      $jmlp = mysqli_fetch_array($sumpart);
      $totalpart = $totalpart + $jmlp['totalpart'];
			$jenis = "-";
		}
}
?>

<?php
// END OF PART
// BEGIN OF JASA
// jika hasil dari query jasa di temukan maka
  if ($jmljasa != 0){
			$jmlpart = $jmlpart+1;
    	$jenis = "Perbaikan";
       //Lakukan perulangan sesuai jumlah jasa
      for ($i=$jmlpart;$i <= ($jmljasa+$jmlpart);$i++){
          $esget = mysqli_fetch_array($es_jasa);
          $ess = $esget['ja_kode'];
          $estimasi = mysqli_query($koneksi, "SELECT * FROM jasa WHERE ja_kode = '$ess' ");

          $result2 = mysqli_fetch_array($estimasi);
          // Untuk menghindari jenis perbaikan yg kosong
          if ($result2['ja_jenis'] != ''){
            echo "<tr><td>".$i.".</td>
										<td align=center>$jenis</td>
									  <td align=left>".$result2['ja_nama']."</td>
										<td align=right>".rupiah($result2['ja_price'])."</td>
									</tr>";
          }

          $ja_kode = $result2['ja_kode'];

          // Query total dari keseluruhan jasa berdasarkan jakode
          $sumjasa= mysqli_query($koneksi, "SELECT SUM(ja_price) AS totaljasa FROM jasa WHERE jasa.ja_kode = '$ja_kode' ")or die (mysqli_error());
          $jmlp = mysqli_fetch_array($sumjasa);

          // Jumlahkan total jasa
          $totaljasa = $totaljasa + $jmlp['totaljasa'];
					$jenis = "-";

      }// End of For
  }
// END OF JASA

// Jumlahkan totaljasa dan total part
$totalestimasi = $totaljasa + $totalpart;
?>
<tr><td colspan="4" class="noborder"><div class="judul"><strong> TOTAL </strong></div></td></tr>

<?php
echo "<tr><td colspan=4></td></tr>";
echo "<tr><td align=center colspan=2>Hormat Kami, </td><td colspan=1 align=right>Total Perbaikan</td><td align=right>".rupiah($totaljasa)."</td></tr>";
echo "<tr><td align=center colspan=2></td><td colspan=1 align=right>Total Penggantian</td><td align=right>".rupiah($totalpart)."</td></tr>";
echo "<tr><td align=center colspan=2></td><td colspan=1 align=right><b>Total Pembayaran</td><td align=right><u>".rupiah($totalestimasi)."</b></td></u></tr>";
echo "<tr><td align=center colspan=2>( Manajer Bengkel )</td><td colspan=3 align=right></td></tr>";

echo "</table>";
?>
</body>
</html>
