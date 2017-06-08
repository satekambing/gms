<?php
error_reporting(E_ERROR);
include ('../../../config/koneksi.php');
    
// Post data PO
if (isset($_GET['tombol'])){

    // Post data PO
    if (isset($_GET['page']) AND $_GET['page'] == "listestimasipost"){
        $es_kode = $_GET['kode'];
        $asuransi = $_GET['asuransi'];
        $ket = $_GET['ket'];
        
        $masuk = $_GET['tgl_masuk'];
        $keluar = $_GET['tgl_keluar'];
        $query   = mysql_query("UPDATE estimasi SET es_tgl_masuk = '$masuk', es_tgl_keluar = '$keluar', asuransi = '$asuransi', ket = '$ket' WHERE es_kode = $es_kode ")or die (mysql_error());
            if ($query){
                echo "Success";
            }
        // Tutup Halaman
        echo "
            <script>
            self.close();
            window.opener.location.reload();
            </script>";
    }
    else 
    // Post data Unit 
        if (isset($_GET['tertanggung'])){
            
            $cus = strtoupper($_GET['tertanggung']);
            $nopol = strtoupper($_GET['nopol']);
            $model = strtoupper($_GET['model']);
            $merk = strtoupper($_GET['merk']);
            $rangka = strtoupper($_GET['rangka']);
            $mesin = strtoupper($_GET['mesin']);
            $kode = strtoupper($_GET['kode']);
            $tahun = $_GET['tahun'];
            $nomodel = $_GET['nomodel'];
            $query = ("UPDATE unit SET ");
            $query .= "u_nama = '$cus',u_nopol = '$nopol', u_model = '$model', ";
            $query .= "u_norangka = '$rangka',u_merk = '$merk', u_nomesin = '$mesin', ";
            $query .= "u_tahun = '$tahun', u_nomodel = '$nomodel' ";
            $query .= " WHERE u_kode = '$kode' ";
            $result1 = mysql_query($query) or die (mysql_error());
            //$estimasi = mysql_query("UPDATE estimasi SET es_tgl_keluar = '$keluar', es_tgl_masuk = '$masuk' WHERE u_kode = '$kode' ");
            if ($result1){
                header("Location: ../../../index.php?page=list&kode=$kode");
            }
        }
        else 
            // Update Post Jasaadmin
            if ($_GET['page'] == "jasaadmin" AND $_GET['tombol'] == "simpan"){
                $jakode = strtoupper($_GET['jakode']);
                $janama = strtoupper($_GET['janama']);
                $jaharga = trim($_GET['jaharga']);
                $jajenis = $_GET['jajenis'];
                $query9 = mysql_query("UPDATE  jasa SET  ja_nama =  '$janama',
                ja_jenis =  '$jajenis',
                ja_price =  '$jaharga' WHERE  ja_kode =  '$jakode' ") or die (mysql_error());
                if ($query9){
                    echo ' Has Ben Updated';
                }
                echo "
                    <script>
                    self.close();
                    window.opener.location.reload();
                    </script>";
                
            }
            else 
                // Part Admin Post
                if (isset ($_GET['partharga']) AND !isset ($_GET['partestimasi'])){
                   
                    $pkode = $_GET['partkode'];
                    $pcode = strtoupper(str_replace('#', '',  str_replace(';', '', str_replace('&', '', $_GET['partcode']))));
                    $pnama = strtoupper($_GET['partnama']);
                    $pharga = $_GET['partharga'];
                    $punit = strtoupper($_GET['partunit']);
                    $query10 = mysql_query("UPDATE  part SET  part_code = '$pcode',part_nama =  '$pnama',
                    part_unit =  '$punit',
                    part_harga =  '$pharga' WHERE  part_kode =  '$pkode' ") or die (mysql_error());
                    if ($query10){
                        echo ' Has Ben Updated';
                    }
                    else {
                        echo 'Gagal';
                    }
                    echo "
                     <script>
                     self.close();
                     window.opener.location.reload();
                     </script>";
                }
                else 
                    // Part Estimasi 
                    if ($_GET['page'] == "partestimasi"){
                        $pkode = $_GET['partkode'];
                        $pcode = strtoupper(str_replace('#', '',  str_replace(';', '', str_replace('&', '', $_GET['partcode']))));
                        $pnama = strtoupper($_GET['partnama']);
                        $pharga = $_GET['partharga'];
                        $punit = strtoupper($_GET['partunit']);
                        $query10 = mysql_query("UPDATE  part SET  part_code = '$pcode',part_nama =  '$pnama',
                        part_unit =  '$punit',
                        part_harga =  '$pharga' WHERE  part_kode =  '$pkode' ") or die (mysql_error());
                        //echo "
                         
                    }
}
//Halaman Edit List Estimasi
if (isset($_GET['page'])){ 
   //include ('../../../config/koneksi.php');
   if ($_GET['page'] == "listestimasi"){
    $kode = $_GET['kode'];
    $query = mysql_query("SELECT * FROM estimasi,asuransi WHERE es_kode = $kode ") or die(mysql_error());
    $data = mysql_fetch_array($query);
    ?>
    <form method="get" action="">
    <fieldset>
        <legend>Edit Estimasi</legend>
    <select name="asuransi"><?php include'../../../function/asuransi.php' ?></select><br />
    <input type="date" name="tgl_masuk" value="<?php echo $data['es_tgl_masuk']?>"/><br />
    <input type="date" name="tgl_keluar" value="<?php echo $data['es_tgl_keluar']?>"/><br />
    <textarea cols="15" rows="2" name="ket"><?php echo $data['ket']?></textarea><br />
    <input type="hidden" name="page" value="listestimasipost" />
    <input type="hidden" name="kode" value="<?php echo $_GET['kode'] ?>" />
    <input type="submit" name="tombol" value="simpan">
    </fieldset>
    </form>
       <?php
   }

//Halaman Edit Unit
    if ($_GET['page'] == "unit_edit"){
       
        $kode = $_GET['kode'];
        $query = mysql_query("SELECT * FROM unit, estimasi WHERE unit.u_kode = '".$kode."' AND estimasi.u_kode = '".$kode."' ") or die (mysql_error());
        $row = mysql_fetch_array($query);
    ?>
        <form method="get" action="content/page/crud/edit.php">
        <fieldset>
           <legend>Edit Unit</legend>
                <table width="100%">
                <tr>
                    <td>Nama </td><td><input type="text" name="tertanggung" value="<?php echo $row['u_nama']?>" autofocus/></td>
                    <td>Nopol</td><td><input type="text" name="nopol" value="<?php echo $row['u_nopol']?>" /></td>
                </tr>
                <tr>
                    <td>Jenis</td><td><input type="text" name="merk" value="<?php echo $row['u_merk']?>" size="5"/>-<input type="text" name="model" value="<?php echo $row['u_model']?>" size="8"/></td>
                    <td>Tahun</td><td><input type="text" name="tahun" value="<?php echo $row['u_tahun']?>" /></td>
                </tr>
                <tr>
                    <td>No. Rangka</td><td><input type="text" name="rangka" value="<?php echo $row['u_norangka']?>" /></td>
                    <td>No. Mesin</td><td><input type="text" name="mesin" value="<?php echo $row['u_nomesin']?>" /></td>
                </tr>
                <tr>
                    <td>No. Model</td><td><input type="text" name="nomodel" value="<?php echo $row['u_nomodel']?>" /></td>
                    <td colspan="2"><input type="submit" name="tombol" value="SIMPAN"></td>
                </tr>
                <input type="hidden" name="page" value="unit" />
                <input type="hidden" name="kode" value="<?php echo $_GET['kode']?>" />
                </table>
        </fieldset>
    </form>
    <?php }
    else 
        // Edit Jasaadmin
        if ($_GET['page'] == "jasaadmin"){
            
            // Set Variable 
            $jakode = $_GET['kode'];
            $queryjasa = mysql_query("SELECT * FROM jasa WHERE ja_kode = '$jakode' ");
            $j = mysql_num_rows($queryjasa);
            while ($data = mysql_fetch_array($queryjasa)){
            ?>
            <form action="" >
            <fieldset>
                <legend>Edit Jasa - Admin</legend>
                <table width="100%">
                    <td>Kode </td><td><input type="text" name="jakode" value="<?php echo $data['ja_kode'] ?>"/></td>
                    <td>Nama </td><td><input type="text" name="janama"  value="<?php echo $data['ja_nama'] ?> "/></tr>
                    <tr><td>Harga </td><td><input type="text" name="jaharga" value="<?php echo $data['ja_price'] ?>"/></td>

                    <td>Jenis</td><td><select name="jajenis">
                                <?php
                                foreach ($jenis as $value){
                                     if ($value == $data['ja_jenis']){
                                        echo "<option selected=selected value=$value>$value</option>"; 
                                     }
                                     else {
                                        echo "<option value=$value>$value</option>"; 
                                     }
                                } ?>
                            </select></td></tr>   
                    <input type="hidden" name="page" value="jasaadmin" />
                    <tr><td colspan="4"><input type="submit" name="tombol" value="simpan"></td></tr>
                </table>
            </fieldset>
            </form>
            <?php
            } //  End of while statment
        }
        else 
            // Start Part Admin
            if ($_GET['page'] == 'partadmin'){
                $part_kode = $_GET['kode'];
                $query = mysql_query("SELECT * FROM part WHERE part_kode = '$part_kode' ");
                $ambil = mysql_fetch_array($query);
                $nama = $ambil['part_nama'];
                $code = $ambil['part_code'];
                $harga = $ambil['part_harga'];
                $unit = $ambil['part_unit'];
                ?>
                <form>
                    <fieldset>
                        <legend>Edit Part Admin</legend>
                        <table width="100%">
                            <tr><td>Code</td><td><input type="text" name="partcode" value="<?php echo $code ?>"/><input type="hidden" name="page" value="partadmin"><input type="hidden" name="partkode" value="<?php echo $part_kode?>" /></td><td>Nama</td><td><input type="text" name="partnama" value="<?php echo $nama ?>"/></td></tr>
                            <tr><td>Unit</td><td><input type=text" name="partunit" value="<?php echo $unit?>" size="10"/></td><td>Harga</td><td><input type=text name=partharga value="<?php echo $harga ?>" /></td></tr>
                            <tr><td>&nbsp</td><td colspan="3"><input type="submit" name="tombol" value="simpan" /></td></tr>
                        </table>
                    </fieldset>

                </form>
                <?php
            }
            else 
                // Part Estimasi 
                if ($_GET['page'] == 'partestimasi'){
                    $part_kode = $_GET['kode'];
                    $query = mysql_query("SELECT * FROM part WHERE part_kode = '$part_kode' ");
                    $ambil = mysql_fetch_array($query);
                    $nama = $ambil['part_nama'];
                    $code = $ambil['part_code'];
                    $harga = $ambil['part_harga'];
                    $unit = $ambil['part_unit'];
                    ?>
                    <form>
                        <fieldset>
                            <legend>Edit Part Estimasi</legend>
                            <table width="100%">
                                <tr><td>Code</td><td><input type="text" name="partcode" value="<?php echo $code ?>"/><input type="hidden" name="page" value="partestimasi"><input type="hidden" name="partkode" value="<?php echo $part_kode?>" /></td><td>Nama</td><td><input type="text" name="partnama" value="<?php echo $nama ?>"/></td></tr>
                                <tr><td>Unit</td><td><input type=text" name="partunit" value="<?php echo $unit?>" size="10"/></td><td>Harga</td><td><input type=text name=partharga value="<?php echo $harga ?>" /></td></tr>
                                <tr><td>&nbsp</td><td colspan="3"><input type="submit" name="tombol" value="simpan" /></td></tr>
                            </table>
                        </fieldset>

                    </form>
                    <?php
                }
        // End of JasaAdmin
    
}
?>


