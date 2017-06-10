<?php
$no = 0;
if ($_GET['page'] == "ck" AND !isset($_GET['tombol'])){
    $query = mysql_query("SELECT * FROM ck ");
    echo "<table width=100%>
          <form>
          <tr><td colspan=4 align=right><input type=hidden name=page value=ck /><input type=submit name=tombol value=EDIT /><input type=submit name=tombol value=HAPUS /></td></tr>
          <tr>
            <th width=5% >No</th>
            <th width=78%>Nama Item</th>
            <th width=2%>Status</th>
            <th width=10%>Edit</th>
          </tr>";
    while ($row = mysql_fetch_array($query)){
        $kode = $row['ck_kode'];
        echo "<tr>";
        echo "<td align=center>".$row['ck_kode']."</td>";
        echo "<td>".$row['ck_nama']."</td>";
        echo "<td align=center>".$row['ck_status']."</td>";
        echo "<td align=center>";?><input type="checkbox" name="item[]" value="<?php echo $kode ?>" /></td><?php 
        echo "</tr>";
        $no++;
    }
    echo "</form></table>";
?>

<?php } 
// EDIT CHECK LIST
if (isset($_GET['tombol']) AND $_GET['tombol'] == "EDIT"){
    $item = $_GET['item'];
    $jum = count($item);
    //Query data ceklist berdasarkan kode ck
    //Forms
    echo '<form><fieldset>';
    echo '<legend>Jumlah Item - '.$jum.'</legend>';
    echo '<table>';
    foreach ($item as $value)     
    {
       $query = mysql_query("SELECT * FROM ck WHERE ck_kode = '$value' ");
       echo '<tr><td colspan=2>Data Ke - '.$value.'</td></tr>';
       while ($ckk = mysql_fetch_array($query)){
     
       ?>
            <input type=hidden name="kode[]" value="<?php echo $ckk['ck_kode'] ?>" >
            <tr><td>Nama Item </td><td><input type="text" name="cknama[]" value="<?php echo $ckk['ck_nama'] ?>"/></td></tr>
            <tr><td>Status    </td><td><input type="text" name="ckstatus[]" value="<?php echo $ckk['ck_status'] ?>"/></td></tr>
            <tr></tr>
            
       <?php
       } // End of while
    } // End of foreach
    
    echo '<tr><td colspan=2><input type=submit name=tombol value=UPDATE /></td></tr>';
    echo '<input type=hidden name=page value=ck />';
    echo '</table></fieldset></form>';
    
}
// Update Query 
if (isset($_GET['tombol']) AND $_GET['tombol'] == "UPDATE"){
    $kode = $_GET['kode'];
    $item = $_GET['cknama'];
    $status = $_GET['ckstatus'];
    $jum = count($kode);
    for ($i=0;$i < $jum;$i++){
        $update = mysql_query("UPDATE  ck SET  ck_nama = '".$item[$i]."',
                              ck_status = '".$status[$i]."' WHERE  ck_kode = '".$kode[$i]."' ") or die (mysql_error());
    }
    header("Location: ?page=ck");
}
else 
    if (isset($_GET['tombol']) AND $_GET['tombol'] == "HAPUS"){
        $kode = $_GET['kode'];
        $jum = count($kode);
        for ($i=0;$i < $jum;$i++){
            $hapus = mysql_query("DELECT FROM ck WHERE ck_kode = '".$kode[$i]."' ");
        }
    }
?>
