<?php
// Paging
	$halaman = 0;
	if (isset($_GET['halaman']) && $_GET['halaman'] > 1){$halaman = $_GET['halaman'] * 10 - 10; };
    $perhalaman = 10;
    $sql = mysql_query("SELECT count(u_kode) FROM unit");
    $pages = ceil(mysql_result($sql,0) / $perhalaman);
    
    $page = (isset($_GET['halaman'])) ? (int)$_GET['halaman'] : 1;
    $start = ($page - 1) * $perhalaman;
// LIMIT $start, $perhalaman

//Query Join Unit
// Query semua data tanpa LIMIT
// Query semua data dengan LIMIT
// $start, $perhalaman
    $ambil = mysql_query("SELECT * FROM faktur n JOIN unit u ON n.u_kode = u.u_kode LIMIT $start, $perhalaman") or die (mysql_error());

$th = array('1'=>'No','14'=>'Tanggal','42'=>'Tertanggung','25'=>'Model','18'=>'Nopol');
?>
<table cellpadding="5"  width="100%" id="unit"">
    <tr>
        <td colspan="4">
            <form method=get accept-charset='utf-8' />
            <select name="bulan"><?php include('config/bulan.php'); ?></select>
            <input type=text name=search value='' placeholder="Kata Kunci: Nopol,Nama,Unit.. " size="25" autofocus >
            <input type="hidden" name="page" value="nota" /><input type=submit name=tombol value=cari />
        </td>
            <td align="center"></form><?php // paging($sql, $item_per_page); ?></td>
    </tr>
<tr>
<?php
	foreach ($th as $key=> $value){
		$key .= '%';
		echo "<th width=$key>$value</th>";
	}
?>
</tr>
<?php
//Search 
if (isset($_GET['search'])){
    $search = $_GET['search'];
    $bulan = $_GET['bulan'];
    $bulan = substr($bulan,0,3);
    
    if ($_GET['bulan'] == "Bulan"){
        $bulan = '';
    }
   
    //Bulan aja - Berhasil;
    if ($_GET['bulan'] != '0' AND empty($_GET['search']) AND $asuransi == ''){
        
        $ambil = mysql_query("SELECT * FROM unit u JOIN estimasi e ON n.no_id = e.u_kode WHERE MONTH(e.es_tgl_masuk) = '$bulan' ORDER BY e.asuransi, u.u_nama ASC LIMIT $start, $perhalaman ") or die ('Error - '.mysql_error());
    }
    else
        //Gabungan 
        if (($_GET['bulan'] != 0) AND (!empty($_GET['search'])) AND ($_GET['asuransi'] != 7)){
             $ambil = mysql_query("SELECT * FROM unit u JOIN estimasi e ON n.no_id = e.u_kode WHERE u.u_nama LIKE '%$search%' OR u.u_nopol LIKE '%$search%' OR u.u_model  LIKE '%$search%' AND MONTH(e.es_tgl_masuk) = '$bulan' AND e.asuransi = '$asuransi' ORDER BY e.asuransi, u.u_nama ASC  ") or die (mysql_error());
             }
                 else { 
                 //echo 'search aja';
                      $ambil = mysql_query("SELECT * FROM unit u JOIN estimasi e ON n.no_id = e.u_kode WHERE u.u_nama LIKE '%$search%' OR u.u_nopol LIKE '%$search%' OR u.u_model  LIKE '%$search%' ORDER BY e.asuransi, u.u_nama ASC ") or die (mysql_error());
                      }
    
}
$nourut = 1;
$nourut = $nourut * $halaman;
while ($data =mysql_fetch_array($ambil)){
	    $nourut++;
	$no = $data['u_kode']; 
	$unit = strtoupper($data['u_model']);
    $nama = $data['u_nama'];
    $nopol = strtoupper($data['u_nopol']);
	$fak_id = $data['fak_id']; 
	$tmasuk = $data['fak_tanggal']; 
        if ($nama == ""){
            $nama = "UNDEFINIED";
        }
echo "<tr>	
        <td>$nourut.</td>
	
	<td align=center>";
echo    $tmasuk;
            
echo 	"</td> <td><a href='?page=estimasifaktur&fak_id=$fak_id&kode=$no'>$nama</a></td>
	
	<td>$unit</td>
        <td><a href='?page=unit_edit&kode=$no' >$nopol
        ";
        if ($nopol == ''){
            echo 'Kosong';
        }
 echo   "</a></td>
	
</tr>";
};

echo "<tr><td colspan=6>";
if ($pages >= 1 AND $page <= $pages ){
    for ($x=1;$x<=$pages;$x++){
        echo ($x == $page) ? '<u><a href="index.php?page=unit&halaman='.$x.'">'.$x.'</a></u>' : '<a href="index.php?page=unit&halaman='.$x.'"> '.$x.' </a>';
    }
}          
echo   "</td></tr>";
echo"</table>";
?>