<?php
// Include Header - Unit
include ('header_report.php');

$ck = mysql_query("SELECT * FROM ck");
$i = 0;

 echo "<table width='100%' id='border' align='center' cellpadding='3' cellspacing='1'>
        <tr>";
while ($result2 = mysql_fetch_array($ck)){        
      $i++;
      $space = "";
      if ($i < 10){
          $space = "&nbsp";
      }
      if ($i%3){
          echo "<td width=30%>".$i.$space.". ".$result2['ck_nama']."</td><td width=3%><input type=checkbox value='' /></td>";
      }
      else {
          echo "<td width=30%>".$i.$space.". ".$result2['ck_nama']."</td><td width=3%><input type=checkbox value='' />"."</td></tr>";
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