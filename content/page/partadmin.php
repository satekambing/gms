
<?php
$jdataall = '';

if (isset($_GET['search']) OR isset($_GET['unit'])){
    // pencarian unit doang 
    if (isset($_GET['unit']) AND empty($_GET['search']) ){
        $mobil = $_GET['unit'];
        $query = "SELECT * FROM part WHERE part_unit = '$mobil' ORDER BY part_kode";
    }
    
    else {
        $search = $_GET['search'];
        if (!(empty($_GET['search']) AND empty($_GET['unit']))){
            echo '22';
            $mobil = $_GET['unit'];
            $query = "SELECT * FROM part WHERE (part_kode LIKE '%$search%' OR part_nama LIKE '%$search%' OR part_code LIKE '%$search%') AND part_unit = '$mobil' ORDER BY part_kode";
        }
        // Pencarian doang
        else {
            $query = "SELECT * FROM part WHERE part_kode LIKE '%$search%' OR part_nama LIKE '%$search%' OR part_unit LIKE '%$search%' OR part_harga LIKE '%$search%' OR part_code LIKE '%$search%' ORDER BY part_kode LIMIT 0, 10";
        }
    }
    
}else {
    $query = "SELECT * FROM part ORDER BY part_kode ASC LIMIT 0,10";
}   
$dataquery = mysql_query($query) or die(mysql_error());
$jdata = mysql_num_rows($dataquery);

// Set Variable 
?>
<table width="100%">
    <tr>
        <form action="">
        <td></td>
        <td colspan="2"></td>
        <td><select name="unit">
                <?php 
                $queryunit = mysql_query("SELECT part_unit FROM part GROUP BY part_unit ");
                while ($u = mysql_fetch_array($queryunit)){
                    echo "<option name=".$u['part_unit'].">".$u['part_unit']."</option>";
                }
                ?>
                </select></td>
        <td><input type="hidden" name="page" value="partadmin" /><input type="text" name="search" placeholder="Pencarian..."/></td>
        <td><input type="submit" value="Cari" name="tombol" /></form></td>
    </tr>
    <tr>
        
        <th width="5%">Kode</th>
        <th width="24%">Code</th>
        <th width="50%">Nama Item</th>
        <th width="10%">Unit</th>
        <th width="10%">Harga</th>
        <th width="1%">Edit</th>
    </tr>


<?php 
if ($jdata != 0){
    while ($data = mysql_fetch_array($dataquery)){
    $partkode = $data['part_kode'];
    echo "<tr>";
    
    echo "<td align=center>".$data['part_kode']."</td>";
    echo "<td>"; 
    echo $data['part_code']."</td>
       <td>";
    ?>
    <a href="" onclick="inputdata('content/page/crud/edit.php?page=partadmin&kode=<?php echo $partkode?>','470','170')" >
    <?php
    echo $data['part_nama']."</a></td>
       <td align=center>".$data['part_unit']."</td>
       <td align=right>".rupiah($data['part_harga'])."</td>
       <td align=center> <a href='' onclick=sate('content/page/crud/delete.php?page=jasaadmin&kode=$partkode') >
                    <img src='img/tombol/close.png' /></a></td></tr>";
    
    }
    echo "<tr><td colspan=7>";
           
    echo "</td></tr>";
} // End of if Jika 

else {
    echo '<tr><td colspan=7><h1 align=center>Data Not Found</h1> </td>';
}
echo '</table>';

?>