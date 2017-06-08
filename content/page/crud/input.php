<?php
$onpage = "";
if (isset($_GET['isi']) AND $_GET['isi'] == ""){
    $onpage = "onload=tutup()";
}
if (isset($_GET['namajasa']) AND $_GET['namajasa'] == " "){
    $onpage = "onload=tutup()";
}
if (isset($_GET['namapart']) AND $_GET['namapart'] == " "){
    $onpage = "onload=tutup()";
}
include ('../../../config/koneksi.php');
?>
<html>
<head> <title> Input </title><script src="../../../js/crud.js"></script>
<link rel="stylesheet" type="text/css" href="../../../css/unit.css" />
<link rel="stylesheet" type="text/css" href="../../../css/blueprint.css" />
</head>
<body <?php echo $onpage ?> >

<!-- Input Estimasi-->
<?php if (isset($_GET['page']) and $_GET['page'] == "list") {?>

<form method="get" action="">
    <fieldset>
        <legend>Tambah Estimasi</legend>
    <select name="asuransi"><?php include'../../../function/asuransi.php' ?></select><br />
    Tgl Masuk<input type="date" name="tgl_masuk" /><br />
    Tgl Keluar<input type="date" name="tgl_keluar" />
    <input type="hidden" name="page" value="list" />
    <input type="hidden" name="kode" value="<?php echo $_GET['kode'] ?>" />
    <input type="submit" name="tombol" value="simpan">
    </fieldset>
</form>
<?php } ?>

<!-- Input JASAADMIN-->
<?php if (isset($_GET['page']) and $_GET['page'] == "jasaadmin") {?>

<form method="get" action="">
    <fieldset>
        <legend>Tambah Jasa</legend>
        <table width="100%">
        <td>Kode </td><td><input type="text" name="jakode" /></td>
        <td>Nama </td><td><input type="text" name="janama" autofocus/></tr>
        <tr><td>Harga </td><td><input type="text" name="jaharga" /></td>
        
        <td>Jenis</td><td><select name="jajenis">
                    <?php
                    foreach ($jenis as $value){
                         echo "<option value=$value>$value</option>";
                    } ?>
                </select></td></tr>   
        <input type="hidden" name="page" value="jasaadmin" />
        <tr><td colspan="4"><input type="submit" name="tombol" value="simpan"></td></tr>
        </table>
    </fieldset>
</form>
<?php } ?>
<!--Input Unit-->
<?php if (isset($_GET['page']) and ($_GET['page'] == "unit" || $_GET['page'] == "unitnota")) {?>
<form method="get">
<fieldset>
    <legend>Tambah Unit <?php echo $tanggaldb ?></legend>
    <table width="100%">
    <tr>
        <td>Nama </td><td><input type="text" name="tertanggung" placeholder="Tertanggung" autofocus/></td>
        <td>Nopol</td><td><input type="text" name="nopol" placeholder="Nopol" /></td>
    </tr>
    <tr>
        <td>Jenis</td><td><input type="text" name="merk" placeholder="Toyota" size="5"/>-<input type="text" name="model" placeholder="Avanza" size="8"/></td>
        <td>Tahun</td><td><input type="text" name="tahun" placeholder="Tahun" /></td>
    </tr>
	<?php 
	 if ($_GET['page'] == "unit"){ 
	?>
    <tr>
        <td>Tgl Masuk</td><td><input type="date" name="tgl_masuk" placeholder="Tgl Masuk"/></td>
        <td>Tgl Keluar</td><td><input type="date" name="tgl_keluar" placeholder="Tgl Keluar" /></td>
    </tr>
	
	
    <tr>
        <td>No. Rangka</td><td><input type="text" name="rangka" placeholder="No Rangka" /></td>
        <td>No. Mesin</td><td><input type="text" name="mesin" placeholder="No Mesin" /></td>
    </tr>
	
    <tr>
        <td>No. Model</td><td><input type="text" name="nomodel" placeholder="nomor model" /></td>
        <td>Asuransi</td><td><select name="asuransi"><?php include'../../../function/asuransi.php' ?></select></td>
    </tr>
	<?php } ?>
	 <tr>
        <td>No Hp.</td><td colspan=4><input type="text" name="no_hp" placeholder="Nomer Telp"/></td>
    </tr>
	
    <input type="hidden" name="page" value=<?php echo $_GET['page'] ?> />
    <tr>
        <td>&nbsp;</td><td><input type="submit" name="tombol" value="SIMPAN"></td><td>Ket</td><td><textarea name="ket" cols="17" rows="2"></textarea></td>
    </tr>
    </table>
</fieldset>
</form>
<?php } ?>
<!--Input Part -->
<?php if (isset($_GET['page']) and $_GET['page'] == "part") { ?>
<form method="get" action="">
<fieldset>
    <legend>Tambah Spare Part</legend>
    <table width="100%">
        <tr><td>Code</td><td><input type="text" name="codepart" autofocus /></td>
        <td>Nama </td><td><input type="text" name="namapart" /></tr>
        
        <tr><td>Default</td><td><input type="text" name="harganormal" placeholder="Harga Normal"/></td><td>Harga </td><td><input type="text" name="hargapart" placeholder="Harga yang digunakan"/></td></tr>
        <tr><input type="hidden" name="page" value="part"/>
        <?php 
        if (isset($_GET['es_kode'])){
                echo "<input type=hidden name=es_kode value=".$_GET['es_kode']." />";
            }
        ?>
        <td>Unit</td><td><input type="text" name="partunit" placeholder="EXP: AVZ"/></td><td colspan="2"> <input type="submit" name="tombol" value="Buat" /> / 
                 <input type="submit" name="tombol" value="Cari" />
                </td></tr>
    <tr><td colspan="4"><textarea name="partarray" cols="50" row="3"></textarea></td></tr>
    </table>
</fieldset>
</form>
    <?php
        $ja_kode = "";
        if (isset($_GET['inputpart']))
            $part_kode = $_GET['inputpart']; 
        if (!empty($_GET['inputpart']) OR !empty($_GET['namapart'])){
            $namapart = $_GET['namapart'];
            $kodepart = $_GET['codepart'];
            $query = "SELECT * FROM part WHERE part_nama LIKE '%$namapart%' AND part_kode LIKE '%$kodepart%' ORDER BY part_kode DESC";
        }
        else {
            $query = "SELECT * FROM part WHERE part_kode <> '' ORDER BY part_kode DESC LIMIT 0,9"; //
        }
        $result = mysql_query($query) or die (mysql_error());
        $jml = mysql_num_rows($result);
        $es_kode = $_GET['es_kode'];
        echo "<table width=100%>";
        $no = 0;
        while ($part = mysql_fetch_array($result)){
            $no++;
            $partkode = $part['part_kode'];
            
            echo "<tr>
                      <td width=5%><a href='?page=espartkode&es_kode=$es_kode&partkode=$partkode&tombol=espartkode' >".$partkode."</td>
                      <td width=25%>".$part['part_code']."</td>
                      <td width=45%>".$part['part_nama']."</td>
                      <td width=10%>".$part['part_unit']."</td>
                      <td width=15% align=right>".rupiah($part['part_harga'])."</td>    
                      </tr></a>";
            
            
            } // End while statment
         //if (isset($_GET['es_kode']))
         //echo "<tr><td colspan=5 align=center><a href='?page=estimasipart&es_kode=".$_GET['es_kode']." ' >Kembali Ke Estimasi</a></td></tr>";
         echo "</table>";   
    }  // End of Part  ?>

<!--Input Jasa-->
<?php if (isset($_GET['page']) and $_GET['page'] == "jasa") {
    ?>
<form method="get" action="">
<fieldset>
    <legend>Tambah Daftar Jasa</legend>
    <table>
        <tr><td>Kode </td><td><input type="text" name="inputjasa" /></td>
        <td>Nama </td><td><input type="text" name="namajasa" autofocus/></tr>
        <tr><td>Harga </td><td><input type="text" name="hargajasa" /></td>
        <input type="hidden" name="page" value="jasa"/>
        <?php 
        if (isset($_GET['es_kode'])){
                echo "<input type=hidden name=es_kode value=".$_GET['es_kode']." />";
            }
        ?>
        <td>Jenis</td><td><select name="jenis">
                    <?php
                    foreach ($jenis as $value){
                         echo "<option value=$value>$value</option>";
                    } ?>
                </select></td></tr>   
        <tr><td colspan="4"><input type="submit" name="tombol" value="Cari" /> / 
                <input type="submit" name="tombol" value="Buat" /> * Untuk nama jasa usahakan di singkat
                </td></tr>
    </table>
</fieldset>
</form>
    <?php
        $ja_kode = "";
        if (isset($_GET['inputjasa']))
            $ja_kode = $_GET['inputjasa']; 
        if (!empty($_GET['inputjasa']) OR !empty($_GET['namajasa'])){
            $namajasa = $_GET['namajasa'];
            $kodejasa = $_GET['inputjasa'];
            $query = "SELECT * FROM jasa WHERE ja_nama LIKE '%$namajasa%' AND ja_kode LIKE '%$kodejasa%' ";

        }
        else {
            $query = "SELECT * FROM jasa WHERE ja_kode <> '' LIMIT 0,9";
        }
        $result = mysql_query($query) or die (mysql_error());
        $jml = mysql_num_rows($result);

        echo "<table width=100%>";
        $no = 0;
        $es_kodes = $_GET['es_kode'];
        while ($jasa = mysql_fetch_array($result)){
            $no++;
            $jasakode = $jasa['ja_kode'];
            
            echo "<tr><td width=1%>$no. </td>
                      <td width=20%><a href='?page=esjasakode&es_kode=$es_kodes&jakode=$jasakode&tombol=esjakode' >".$jasakode."</a></td>
                      <td width=39%>".$jasa['ja_nama']."</td>
                      <td width=10%>".$jasa['ja_jenis']."</td>
                      <td width=20% align=right>".rupiah($jasa['ja_price'])."</td>    
                      </tr>";
            
            
            } // End while statment
         //if (isset($_GET['es_kode']))
         //echo "<tr><td colspan=5 align=center><a href='?page=estimasijasa&es_kode=".$_GET['es_kode']." ' >Kembali Ke Estimasi</a></td></tr>";
         echo "</table>";   
         
    }  // End of Jasa  ?>

<!--Input Estimasi Jasa-->
<?php if (isset($_GET['page']) AND $_GET['page'] == "estimasijasa") {?>

<form method="get">
<fieldset>
    <legend>Pencarian Jasa</legend>
    <table>
        <tr><td>Kode Jasa</td><td><input type="text" name="kodejasa" /></td></tr>
        <tr><td>Nama Jasa</td><td><input type="text" name="namajasa" autofocus/>
                <input type="hidden" name="page" value="estimasijasa" />
                <input type="hidden" name="es_kode" value="<?php echo $_GET['es_kode']?>" />
                <input type="submit" name="tombol" value="cari" /></td></tr>
    </table>
</fieldset>
</form>
    <?php 
    $es_kode = $_GET['es_kode']; 
    if (!empty($_GET['kodejasa']) OR !empty($_GET['namajasa'])){
        $namajasa = $_GET['namajasa'];
        $kodejasa = $_GET['kodejasa'];
        $query = "SELECT * FROM jasa WHERE ja_nama LIKE '%$namajasa%' AND ja_kode LIKE '%$kodejasa%' ORDER BY ja_kode DESC ";
        
    }
    else {
        $query = "SELECT * FROM jasa ORDER BY ja_kode DESC LIMIT 0,9";
    }
    $result = mysql_query($query) or die (mysql_error());
    $jml = mysql_num_rows($result);
    
  
    $no = 0;
    echo "<table width=100%>";
    while ($jasa = mysql_fetch_array($result)){
        $no++;
        $jasakode = $jasa['ja_kode'];
        
        echo "<tr><td width=1%>$no. </td>
                  <td width=20%><a href='?page=esjasakode&es_kode=$es_kode&jakode=$jasakode&tombol=esjakode' >".$jasakode."</a></td>
                  <td width=39%>".$jasa['ja_nama']."</td>
                  <td width=10%>".$jasa['ja_jenis']."</td>
                  <td width=20% align=right>".rupiah($jasa['ja_price'])."</td>    
                  </tr>";
        
    } // End while statment 
    
    echo "<tr><td colspan=5 align=center><a href='?page=jasa&es_kode=$es_kode' >Buat Jasa</a></td></tr>";
    echo "</table>";
}  // End of Estimasi Jasa  ?>
<!--Asuransi-->
<?php if (isset($_GET['page']) AND $_GET['page'] == "asuransi") {?>
<form method="get">
    <fieldset>
        <legend>Asuransi</legend>
            <input type="text" name="asuransi" placeholder="Asuransi" autofocus/>
            <input type="text" name="des" placeholder="Desktription" />
            <input type="hidden" name="page" value="asuransi" />
            <input type="submit" name="tombol" value="Simpan" />
    </fieldset>
</form>
<?php } ?>

<!-- -->
<!--Input Estimasi Part-->
<?php if (isset($_GET['page']) AND $_GET['page'] == "estimasipart") {?>

<form method="get">
<fieldset>
    <legend>Pencarian Part</legend>
    <table>
        <tr><td>Kode Part</td><td><input type="text" name="kodepart" /></td></tr>
        <tr><td>Nama     </td><td><input type="text" name="namapart" autofocus/>
                <input type="hidden" name="page" value="estimasipart" />
                <input type="hidden" name="es_kode" value="<?php echo $_GET['es_kode']?>" />
                <input type="submit" name="tombol" value="cari" /></td></tr>
    </table>
</fieldset>
</form>
    <?php 
    $es_kode = $_GET['es_kode']; 
    if (!empty($_GET['kodepart']) OR !empty($_GET['namapart'])){
        $namapart = $_GET['namapart'];
        $kodepart = $_GET['kodepart'];
        $query = "SELECT * FROM part WHERE part_nama LIKE '%$namapart%' AND part_kode LIKE '%$kodepart%' ORDER BY part_kode DESC";
    }
    else {
        $query = "SELECT * FROM part ORDER BY part_kode DESC LIMIT 0,9 ";
    }
    $result = mysql_query($query) or die (mysql_error());
    $jml = mysql_num_rows($result);
    
  
    $no = 0;
    echo "<table width=100%>";
    while ($part = mysql_fetch_array($result)){
        $no++;
        $partkode = $part['part_kode'];
        
        echo "<tr>
                  <td width=10%><a href='?page=espartkode&es_kode=$es_kode&partkode=$partkode&tombol=espartkode' >".$partkode."</a></td>
                  <td width=30%>".$part['part_code']."</td>
                  <td width=40%>".$part['part_nama']."</td>
                  <td width=20% align=right>".rupiah($part['part_harga'])."</td>    
                  </tr>";
        
    } // End while statment 
    
    echo "<tr><td colspan=5 align=center><a href='?page=part&es_kode=$es_kode' >Buat Part</a></td></tr>";
    echo "</table>";
}  // End of Estimasi Part  ?>
<?php
// Memasukkan ke Database
if (isset($_GET['tombol']) AND isset($_GET['page'])){
    
            // Unit Post
            if ($_GET['page'] == "unit" || $_GET['page'] == "unitnota"){
                $cus = strtoupper($_GET['tertanggung']);
                $nopol = strtoupper($_GET['nopol']);
                if ($nopol == ''){
                    $nopol = 'NULL';
                }
				$tahun = $_GET['tahun'];
                $ket = $_GET['ket'];
                $kodeid = str_replace(" ","",$nopol).substr($tgl_masuk,5,2).substr($tgl_masuk,8,3);
				
                $model = strtoupper($_GET['model']);
                $merk = strtoupper($_GET['merk']);
				$datenow = $tanggaldb;
				if ($_GET['page'] == "unit"){
					$tgl_masuk = $_GET['tgl_masuk'];
					$tgl_keluar = $_GET['tgl_keluar'];
				
					//$kodeid = str_replace(" ","",$nopol).substr($tgl_masuk,5,2).substr($tgl_masuk,8,3);
				
					$nomesin = strtoupper($_GET['mesin']);
					$rangka = strtoupper($_GET['rangka']);
					$nomodel = $_GET['nomodel'];
					$asuransi = $_GET['asuransi'];
					
					 $query = mysql_query("INSERT INTO unit (u_kode,u_nama,u_nopol,u_norangka,u_nomesin,u_model,u_nomodel,u_tahun,u_merk) VALUES
                    ('$kodeid','$cus','$nopol','$rangka','$nomesin','$model','$nomodel', '$tahun','$merk') ") or die (mysql_error());
					 $estimasi = mysql_query("INSERT INTO estimasi (u_kode, es_tgl_masuk, es_tgl_keluar,asuransi,ket) VALUES ('".$kodeid."','".$tgl_masuk."','".$tgl_keluar."','".$asuransi."','".$ket."') ");
            
                // Direct ke Estimasi berdasarkan kode id
                     echo "<script>directlink('page=unit_edit&kode=$kodeid')</script>";
				}
				else {
					 $query = mysql_query("INSERT INTO unit (u_kode,u_nama,u_nopol,u_model,u_tahun,u_merk) VALUES
                    ('$kodeid','$cus','$nopol','$model','$tahun','$merk') ") or die (mysql_error());
					 $estimasi = mysql_query("INSERT INTO faktur (u_kode, fak_tanggal) VALUES ('".$kodeid."','".$datenow."') ");
            
                // Direct ke Estimasi berdasarkan kode id
                     echo "<script>directlink('page=unit_edit&kode=$kodeid')</script>";
				}
				
                
               
                //
                //header("Location: ?page=jasa");
            }
            // End of Unit post
            else 
            // Estimasi Jasa Post
                if ($_GET['page'] == "esjasakode"){
                   $es_kode = $_GET['es_kode'];
                   $ja_kode = $_GET['jakode'];
                   $query = mysql_query("INSERT INTO estimasijasa (es_kode,ja_kode) VALUES ('$es_kode','$ja_kode') ");
                   header("Location: ?page=jasa&es_kode=".$es_kode);
                  
                   
                   
                }
                else 
             // Input Jasa Post
                    if ($_GET['page'] == "jasa" AND $_GET['tombol'] == "Buat"){
                        $kodejasa = $_GET['inputjasa']; // Kode Jasa
                        $namajasa = strtoupper($_GET['namajasa']);
                        //if (empty($kode)){ 
                            $kode = $namajasa;
                            $kode = str_replace(" ", "", "$kode");
                            $kode = str_replace("A", "", "$kode");
                            $kode = str_replace("I", "", "$kode");
                            $kode = str_replace("U", "", "$kode");
                            $kode = str_replace("E", "", "$kode");
                            $kode = str_replace("O", "", "$kode");
                        //}
                        $kode = $kode.$kodejasa;
                        $jenis = $_GET['jenis'];
                        $harga = $_GET['hargajasa'];
                        $cek = mysql_query("SELECT ja_kode FROM jasa WHERE ja_kode = '$kode' ");
                        $jumcek = mysql_num_rows($cek);
                        $cetak = mysql_fetch_array($cek);
                        
                        if ($jumcek != 0){
                            echo 'Gagal : Kode Jasa Sudah Ada !';
                        }
                        else {
                            echo 'Berhasil Input '.$kode;
                        }
                        
                        if (isset($_GET['es_kode'])){
                            $es_kode = $_GET['es_kode'];
                            $query1 = mysql_query("INSERT INTO estimasijasa (es_kode,ja_kode) VALUES ('$es_kode','$kode')");
                            if ($query1){
                                echo '-- Has Ben Insert'.$es_kode.' - '.$kode;
                            }
                            else {
                                echo "<script>alert ('Gagal')</script>";
                            }
                                
                            
                        }
                        $query = mysql_query("INSERT INTO jasa (ja_kode,ja_nama,ja_jenis,ja_price) VALUES ('$kode','$namajasa','$jenis','$harga') ");
                        // header("Location: ?page=jasa");
                    }
                    else 
                        // Input Part Post
                        if ($_GET['page'] == "part" AND $_GET['tombol'] == "Buat"){
                            // Ambil Kode trakir dari table part
                            $query = mysql_query("SELECT part_kode FROM part WHERE part_kode=(select max(part_kode) FROM part)");
                            $data = mysql_fetch_array($query);
                            if (isset($_GET['partarray'])){
                                // Multi Insert
                                $datax = $_GET['partarray'];
                                $darray = explode('?',$datax);
                                $j = count($darray)-1;
                                $s = 0;
                                for ($ii=1; $ii <= $j; $ii++){

                                if ($ii%3){ // Kondisi Jika $i bukan 3,6,9...

                                      if ($ii == 1 || $ii == 4 || $ii == 7 || $ii == 10 || $ii == 13 || $ii == 16 || $ii == 19 || $ii == 22 || $ii == 25 || $ii == 28 ){
                                          $codex[] = (strtoupper($darray[$ii]));

                                      }
                                      else {
                                          $namax[] = trim(strtoupper($darray[$ii]));
                                      }  
                                   }
                                 else {
                                      $hargax[] = intval(str_replace('Rp','',str_replace(',', '',$darray[$ii])));
                                      }  
                                }
                              
                            } // End if part array
                            
                            // End Definition of Variable
                            $kodetrakir = $data['part_kode'] + 1;
                            $codepart = str_replace('‑', '-',strtoupper($_GET['codepart']));
                            $namapart = $_GET['namapart'];
                            $hargapart= intval(str_replace('Rp', '',  str_replace(',', '',$_GET['hargapart'])));
                            
                            $kode = trim(strtoupper($codepart));
                            $nama = trim(strtoupper($namapart));
                            $harga = intval(str_replace(',','',trim($hargapart)));
                            $unit = trim(strtoupper($_GET['partunit']));
                            $harga2 = $_GET['harganormal'];
                            echo $kode.' '.$nama.' '.$harga;
                            $es_kode = $_GET['es_kode'];
                            if ($namapart == ''){ // Penggunaan Part Array 
                                for ($i=0; $i < $s; $i++){
                                    $hargax[$i] = str_replace(',','', $hargax[$i]);
                                    $codex[$i] = trim($codex[$i]);
                                    $namax[$i] = trim($namax[$i]);
                                    if ($codex[$i] != 0){
                                         $query = mysql_query("INSERT INTO part (part_code,part_nama,part_harga) VALUES ('$codex[$i]','$namax[$i]','$hargax[$i]') ") or die (mysql_error());
                                         $insertestimasix = mysql_query("INSERT INTO estimasipart (es_kode,part_kode) VALUES ('$es_kode','$kodetrakir') ")or die (mysql_error());

                                         echo $i.'. '.$codex[$i].' '.$namax[$i].' '.$hargax[$i].$es_kode.' kode akhir '.$kodetrakir.br;
                                         $kodetrakir = $kodetrakir + 1 ; 
                                    }
                                    else {
                                        echo $codex[$i].' Error';
                                    }
                                   
                                }
                            }
                            else { // Penggunaan Jalur biasa
                                if ($harga != 0){
                                    $query = mysql_query("INSERT INTO part (part_code,part_nama,part_harga,part_unit,part_harganormal) VALUES ('$kode','$nama','$harga','$unit','$harga2') ");
                                    $insertestimasi = "INSERT INTO estimasipart (es_kode,part_kode) VALUES ('$es_kode','$kodetrakir') ";
                                    $es_kode = $_GET['es_kode'];
                                    $query = mysql_query($insertestimasi);
                                }
                                
                            }
                            if ($query){ echo 'Berhasil Input '.$nama; }else {echo 'Gagal Input';}
                            
                            
                        }
                        else
                        // Estimasi Part Post
                            if ($_GET['page'] == "espartkode"){
                                $es_kode = $_GET['es_kode'];
                                $part_kode = $_GET['partkode'];
                                $query = mysql_query("INSERT INTO estimasipart (es_kode,part_kode) VALUES ('$es_kode','$part_kode') ");
                                header("Location: ?page=part&es_kode=".$es_kode);
                            }
                            else 
                                if ($_GET['page'] == "list" AND $_GET['tombol'] == "simpan"){
                                    $u_kode = $_GET['kode'];
                                    $masuk = $_GET['tgl_masuk'];
                                    $keluar = $_GET['tgl_keluar'];
                                    $asuransi = $_GET['asuransi'];
                                    
                                    mysql_query("INSERT INTO estimasi (u_kode,es_tgl_masuk,es_tgl_keluar,asuransi) VALUES ('$u_kode','$masuk','$keluar','$asuransi') ");
                                    echo "<script>tutup()</script>";
                                }
                                else 
                                    // Input JasaAdmin Post
                                    if ($_GET['page'] == "jasaadmin" AND $_GET['janama'] != ''){
                                        $kodejasa = trim(strtoupper($_GET['jakode'])); // Kode Jasa
                                        $namajasa = trim(strtoupper($_GET['janama']));
                                        //if (empty($kode)){ 
                                            $kode = $namajasa;
                                            $kode = str_replace(" ", "", "$kode");
                                            $kode = str_replace("A", "", "$kode");
                                            $kode = str_replace("I", "", "$kode");
                                            $kode = str_replace("U", "", "$kode");
                                            $kode = str_replace("E", "", "$kode");
                                            $kode = str_replace("O", "", "$kode");
                                        //}
                                        $kode = $kode.$kodejasa;
                                        $jenis = $_GET['jajenis'];
                                        $harga = $_GET['jaharga'];
                                        $query = mysql_query("INSERT INTO jasa (ja_kode,ja_nama,ja_jenis,ja_price) VALUES ('$kode','$namajasa','$jenis','$harga') ");
                                        if ($query){
                                            echo "Succes Input : ".$kode.' '.$namajasa.' '.$jenis.' '.$harga;
                                        }
                                    }
                                    
                                    else 
                                        // input asuransi
                                            if ($_GET['page'] == "asuransi") {
                                                $asuransi = $_GET['asuransi'];
                                                $des = $_GET['des'];
                                                
                                                $query = mysql_query("INSERT INTO asuransi (as_nama,as_deskripsi) VALUES ('$asuransi','$des') ") or die (mysql_error());
                                                echo "<script>tutup()</script>";
                                            }

}
// Test script

?>
</body>
</html>
