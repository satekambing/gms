<?php
$jdataall = '';
if (isset($_GET['search']) AND !empty($_GET['search'])){
    $search = $_GET['search'];
    $query = "SELECT * FROM jasa WHERE ja_kode LIKE '%$search%' OR ja_nama LIKE '%$search%' OR ja_jenis LIKE '%$search%' OR ja_price LIKE '%$search%' ORDER BY ja_kode LIMIT 0,20";
}else {
    $query = "SELECT * FROM jasa ORDER BY ja_kode ASC LIMIT 0,10";
}
$dataquery = mysql_query($query) or die(mysql_error());
$jdata = mysql_num_rows($dataquery);

// Set Variable 
$no = 1;
?>
<table width="100%">
    <tr>
        <td colspan="4">Perubahan pada JASA dibawah akan merubah semua data.. * Be Carefull</td>
        <td><form action=""><input type="hidden" name="page" value="jasaadmin" /><input type="text" name="search" placeholder="Pencarian..."/></td>
        <td><input type="submit" value="Cari" name="tombol" /></form></td>
    </tr>
    <tr>
        <th width="7%">No</th>
        <th width="20%">Kode</th>
        <th width="35%">Nama Item</th>
        <th width="8%">Tipe</th>
        <th width="20%">Harga</th>
        <th width="10%">Edit</th>
    </tr>


<?php 
if ($jdata != 0){
    while ($data = mysql_fetch_array($dataquery)){
    $ja_kode = $data['ja_kode'];
    echo "<tr>";
    echo"<td align=center>$no</td>";
    echo "<td>"; ?> 
    <a href="" onclick="inputdata('content/page/crud/edit.php?page=jasaadmin&kode=<?php echo $ja_kode?>','490','170')" >
    <?php 
    echo $data['ja_kode']."</a></td>
       <td>".$data['ja_nama']."</td>
       <td align=center>".$data['ja_jenis']."</td>
       <td align=right>".rupiah($data['ja_price'])."</td>
       <td align=center> <a href='' onclick=sate('content/page/crud/delete.php?page=jasaadmin&kode=$ja_kode') >
                    <img src='img/tombol/close.png' /></a></td></tr>";
    $no++;
    }
    echo '<tr><td colspan=6>Jumlah Data : '.$jdata.'</td></tr>';
} // End of if Jika 

else {
    echo '<tr><td colspan=6><h1 align=center>Data Not Found</h1> </td>';
}
echo '</table>';

?>