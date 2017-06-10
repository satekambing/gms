<?php
include ('header_report_kecil.php');
//Query data part_kode dari estimasipart 
$es = mysql_query("SELECT * FROM ckjasa WHERE ckj_status = '1' ");

echo 	"<div id=kolom>";
while ($row = mysql_fetch_array($es)){
	echo "<input type=checkbox >".$row['ckj_nama']."<br />"; 
}

// Buat Table dahulu
?>		
</div>
</body>
</html>