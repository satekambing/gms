<?php
include ('header_report.php');
//Query data part_kode dari estimasipart 
$es = mysql_query("SELECT part_kode FROM estimasipart WHERE es_kode = '$es_kode'");
$jmlpart = mysql_num_rows($es);

// Buat Table dahulu

if ($jmlpart != 0){
  echo "<table width='100%' id='border' align='center' cellpadding='3' cellspacing='1'>
        <tr><td colspan=6 class=noborder><div class=judul><strong>PURCASE ORDER</strong></div></td></tr>
    
        <tr>";
        
  for ($i=1;$i <= $jmlpart;$i++){ 
      $esget = mysql_fetch_array($es);
      $ess = $esget['part_kode'];
      $estimasi = mysql_query("SELECT * FROM part WHERE part_kode = '$ess' ");
      
      $space = "";
      if ($i < 10){
          $space = "&nbsp";
      }
      
      $result2 = mysql_fetch_array($estimasi);
      $part_kode = $result2['part_kode'];
      echo "<tr><td width=2%>&nbsp$i.</td><td width=28%>".strtoupper($result2['part_code'])."</td><td width=70%>".$result2['part_nama']."</td></tr>";
      /* Menggunakan 3 kolom
      
      
      if ($i%3){
          echo "<td width=30%>".$i.$space.". ".$result2['part_nama']."</td>";
      }
      else {
          echo "<td width=30%>".$i.$space.". ".$result2['part_nama']."</td></tr>";
      }
      */
  }
}
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