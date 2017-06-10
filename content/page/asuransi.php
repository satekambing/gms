<?php
$no = 1;
echo "<table width=100%>";
$ambil = mysql_query("SELECT * FROM asuransi");
while ($row = mysql_fetch_array($ambil)){
    echo "<tr>";
    echo "<td>$no</td><td>".$row['as_nama']."</td>";
    echo "<td>".$row['as_deskripsi']."</td>";
    echo "<td><input type=checkbox /></td>";
    echo "</tr>";
    $no++;
}
echo "</table>";
?>
