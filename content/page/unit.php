<?php
// Paging
$ambil = mysqli_query($koneksi, "SELECT * FROM unit u JOIN estimasi e ON e.u_kode = u.u_kode GROUP BY u.u_kode ORDER BY e.asuransi, e.es_tgl_masuk DESC");

$th = array('1'=>'No','14'=>'Asuransi','42'=>'Tertanggung','25'=>'Model','18'=>'Nopol');

?>
<div class="row">
	<form method=get class="form-inline" />
		<select name="asuransi" class="form-control">
			<option value="all">ALL</option><?php Asuransi($_GET['asuransi']??''); ?>
		</select>
		<select name="bulan" class="form-control"><?php include('config/bulan.php'); ?></select>
		<input type=text name=search class="form-control" placeholder="Kata Kunci: Nopol,Nama,Unit.. " autofocus >

		<input type="hidden" name="page" value="unit" />
		<input type=submit class="btn btn-primary btn-sm" name=tombol value=CARI />
	</form>
<br>
<table  width="100%" id="tablex" class="table">
<tr class=info>
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
    if ($_GET['asuransi'] == "all"){
        $asuransi = '';
    }
    else{
        $asuransi = $_GET['asuransi'];
        }

    //Bulan aja - Berhasil;
    if ($_GET['bulan'] != '0' AND empty($_GET['search']) AND $asuransi == ''){

        $ambil = mysqli_query($koneksi, "SELECT * FROM unit u JOIN estimasi e ON u.u_kode = e.u_kode WHERE MONTH(e.es_tgl_masuk) = '$bulan' ORDER BY e.asuransi, u.u_nama ASC  ") or die ('Error - '.mysqli_error());
    }
    else
        //Gabungan
        if (($_GET['bulan'] != 0) AND (!empty($_GET['search'])) AND ($_GET['asuransi'] != 7)){
             $ambil = mysqli_query($koneksi, "SELECT * FROM unit u JOIN estimasi e ON u.u_kode = e.u_kode WHERE u.u_nama LIKE '%$search%' OR u.u_nopol LIKE '%$search%' OR u.u_model  LIKE '%$search%' AND MONTH(e.es_tgl_masuk) = '$bulan' AND e.asuransi = '$asuransi' ORDER BY e.asuransi, u.u_nama ASC  ") or die (mysqli_error());
             }
        else
             //Asuransi aja - Berhasil
             if (($_GET['asuransi'] != 0) AND empty($_GET['search']) AND $_GET['bulan'] == 0){
                 $ambil = mysqli_query($koneksi, "SELECT * FROM unit u JOIN estimasi e ON u.u_kode = e.u_kode WHERE e.asuransi = '$asuransi' ORDER BY e.asuransi, u.u_nama ASC ") or die (mysqli_error());

             }
             else
                 // Asuransi dan Bulan
                 if (($asuransi != '') AND ($_GET['bulan'] != 0) AND (empty($_GET['search']))){
                     $ambil = mysqli_query($koneksi, "SELECT * FROM unit u JOIN estimasi e ON u.u_kode = e.u_kode WHERE MONTH(e.es_tgl_masuk) = '$bulan' AND e.asuransi = '$asuransi' ORDER BY e.asuransi, u.u_nama ASC  ") or die (mysqli_error());
                 }
                 else {
                 //echo 'search aja';
                      $ambil = mysqli_query($koneksi, "SELECT * FROM unit u JOIN estimasi e ON u.u_kode = e.u_kode WHERE u.u_nama LIKE '%$search%' OR u.u_nopol LIKE '%$search%' OR u.u_model  LIKE '%$search%' ORDER BY e.asuransi, u.u_nama ASC ") or die (mysqli_error());
                      }

}
$nourut = 1;
while ($data =mysqli_fetch_array($ambil)){
	    $nourut++;
	$no = $data['u_kode'];
        $asuransi = $data['asuransi'];
	$unit = strtoupper($data['u_model']);
        $nama = $data['u_nama'];
        $nopol = strtoupper($data['u_nopol']);
	$tmasuk = $data['es_tgl_masuk'];
        if ($nama == ""){
            $nama = "UNDEFINIED";
        }
	echo "<tr >
	        <td>$nourut.</td>
					<td align=center>";
	echo NamaAsuransi($asuransi);

	echo 	"</td> <td><a href='?page=list&kode=$no'>$nama</a></td>

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
	echo   "</td></tr>";
	echo"</table>";
?>
</div>
