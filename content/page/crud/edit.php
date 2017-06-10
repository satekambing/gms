<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edit Data</title>
    <link rel="stylesheet" type="text/css" href="../../../css/unit.css" />
    <link rel="stylesheet" type="text/css" href="../../../css/blueprint.css" />
    <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
<div class="container">

<?php
if(isset($_GET['page']) && $_GET['page'] == "unit_edit"){
  require_once ('config/koneksi.php');
  require_once ('function/asuransi.php');
}else{
  require_once ('../../../config/koneksi.php');
  require_once ('../../../function/asuransi.php');
}

// Post data PO
if (isset($_GET['tombol'])){

    // Post data PO
    if (isset($_GET['page']) AND $_GET['page'] == "listestimasipost"){
        $es_kode = $_GET['kode'];
        $asuransi = $_GET['asuransi'];
        $ket = $_GET['ket'];

        $masuk = $_GET['tgl_masuk'];
        $keluar = $_GET['tgl_keluar'];
        $query   = mysqli_query($koneksi, "UPDATE estimasi SET es_tgl_masuk = '$masuk', es_tgl_keluar = '$keluar', asuransi = '$asuransi', ket = '$ket' WHERE es_kode = $es_kode ")or die (mysqli_error());
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
            $result1 = mysqli_query($koneksi, $query);
            //$estimasi = mysqli_query("UPDATE estimasi SET es_tgl_keluar = '$keluar', es_tgl_masuk = '$masuk' WHERE u_kode = '$kode' ");
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
                $query9 = mysqli_query("UPDATE  jasa SET  ja_nama =  '$janama',
                ja_jenis =  '$jajenis',
                ja_price =  '$jaharga' WHERE  ja_kode =  '$jakode' ") or die (mysqli_error());
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
                    $query10 = mysqli_query("UPDATE  part SET  part_code = '$pcode',part_nama =  '$pnama',
                    part_unit =  '$punit',
                    part_harga =  '$pharga' WHERE  part_kode =  '$pkode' ") or die (mysqli_error());
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
                        $query10 = mysqli_query("UPDATE  part SET  part_code = '$pcode',part_nama =  '$pnama',
                        part_unit =  '$punit',
                        part_harga =  '$pharga' WHERE  part_kode =  '$pkode' ") or die (mysqli_error());
                        //echo "

                    }
}
//Halaman Edit List Estimasi
if (isset($_GET['page'])){
   //include ('../../../config/koneksi.php');
   if ($_GET['page'] == "listestimasi"){
    $kode = $_GET['kode'];
    $query = mysqli_query($koneksi, "SELECT * FROM estimasi WHERE es_kode = $kode ") or die(mysqli_error());
    $data = mysqli_fetch_object($query);
    ?>
    <form method="get"  class="form">
      <h2> Edit Estimasi</h2>
    <!-- <select name="asuransi"> -->
      <?php //include'../../../function/xasuransi.php' ?>
    <!-- </select> -->
    <div class="form-group">
      <label for="">Tanggal Masuk</label>
      <input type="date" name="tgl_masuk" class='form-control' required="" value="<?php echo $data->es_tgl_masuk ?>"/>
    </div>
    <div class="form-group">
      <label for="">Tanggal Keluar</label>
      <input type="date" name="tgl_keluar" class='form-control' value="<?php echo $data->es_tgl_keluar ?>"/>
    </div>
    <div class="form-group">
      <label for="">Keterangan</label>
      <textarea cols="15" rows="2" name="ket" class="form-control"><?php echo $data->ket ?></textarea>
    </div>
    <div class="form-group">
      <label for="">Asuransi</label>
      <select class="form-control" name="asuransi">
        <?php Asuransi($data->asuransi??''); ?>
      </select>
    </div>
    <input type="hidden" name="page" class='form-control' value="listestimasipost" />
    <input type="hidden" name="kode" class='form-control' value="<?php echo $_GET['kode'] ?>" />
    <div class="form-group">
      <input type="submit" name="tombol" class='btn btn-primary' value="SIMPAN">
    </div>
    </form>
       <?php
   }

//Halaman Edit Unit
    if ($_GET['page'] == "unit_edit"){
        $kode = $_GET['kode'];
        $query = mysqli_query($koneksi, "SELECT * FROM unit, estimasi WHERE unit.u_kode = '".$kode."' AND estimasi.u_kode = '".$kode."' ") or die (mysqli_error());
        $row = mysqli_fetch_array($query);
    ?>
        <h2>Edit Unit</h2>
        <div class="row col-sm-9">
        <form method="get" action="content/page/crud/edit.php" class="form">
          <div class="form-group">
            <label for="">Nama </label>
            <input type="text" name="tertanggung" class='form-control' value="<?php echo $row['u_nama']?>" autofocus />
          </div>
          <div class="form-group">
            <label for="">Nopol</label>
            <input type="text" name="nopol" class='form-control' value="<?php echo $row['u_nopol']?>" />
          </div>
          <div class="form-group">
            <label for="">Jenis Kendaraan</label>
            <input type="text" name="merk" class='form-control' value="<?php echo $row['u_merk']?>" size="5"/>-
            <input type="text" name="model" class='form-control' value="<?php echo $row['u_model']?>" size="8"/>
          </div>
          <div class="form-group">
            <label for="">Tahun</label>
            <input type="text" name="tahun" class='form-control' value="<?php echo $row['u_tahun']?>" />
          </div>
          <div class="form-group">
            <label for="">No. Rangka</label>
            <input type="text" name="rangka" class='form-control' value="<?php echo $row['u_norangka']?>" />
          </div>
          <div class="form-group">
            <label for="">No. Mesin</label>
            <input type="text" name="mesin" class='form-control' value="<?php echo $row['u_nomesin']?>" />
          </div>
          <div class="form-group">
            <label for="">No. Model</label>
            <input type="text" name="nomodel" class='form-control' value="<?php echo $row['u_nomodel']?>" />
          </div>
          <div class="form-group">
            <input type="submit" name="tombol" class='btn btn-primary' value="SIMPAN">
          </div>


                <input type="hidden" name="page" class='form-control' value="unit" />
                <input type="hidden" name="kode" class='form-control' value="<?php echo $_GET['kode']?>" />
      </form>
      </div>
    <?php }
    else
        // Edit Jasaadmin
        if ($_GET['page'] == "jasaadmin"){

            // Set Variable
            $jakode = $_GET['kode'];
            $queryjasa = mysqli_query($koneksi, "SELECT * FROM jasa WHERE ja_kode = '$jakode' ");
            $j = mysqli_num_rows($queryjasa);
            while ($data = mysqli_fetch_array($queryjasa)){
            ?>
            <form action="" >
                <legend>Edit Jasa - Admin</legend>
                <table width="100%">
                    Kode <input type="text" name="jakode" class='form-control' value="<?php echo $data['ja_kode'] ?>"/>
                    Nama <input type="text" name="janama"  class='form-control' value="<?php echo $data['ja_nama'] ?> "/>
                    Harga <input type="text" name="jaharga" class='form-control' value="<?php echo $data['ja_price'] ?>"/>

                    Jenis<select name="jajenis">
                                <?php
                                foreach ($jenis as $value){
                                     if ($value == $data['ja_jenis']){
                                        echo "<option selected=selected class='form-control' value=$value>$value</option>";
                                     }
                                     else {
                                        echo "<option class='form-control' value=$value>$value</option>";
                                     }
                                } ?>
                            </select>
                    <input type="hidden" name="page" class='form-control' value="jasaadmin" />
                    <td colspan="4"><input type="submit" name="tombol" class='form-control' value="simpan">
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
                $query = mysqli_query($koneksi, "SELECT * FROM part WHERE part_kode = '$part_kode' ");
                $ambil = mysqli_fetch_array($query);
                $nama = $ambil['part_nama'];
                $code = $ambil['part_code'];
                $harga = $ambil['part_harga'];
                $unit = $ambil['part_unit'];
                ?>
                <form>
                    <fieldset>
                        <legend>Edit Part Admin</legend>
                        <table width="100%">
                            Code<input type="text" name="partcode" class='form-control' value="<?php echo $code ?>"/><input type="hidden" name="page" class='form-control' value="partadmin"><input type="hidden" name="partkode" class='form-control' value="<?php echo $part_kode?>" />Nama<input type="text" name="partnama" class='form-control' value="<?php echo $nama ?>"/>
                            Unit<input type=text" name="partunit" class='form-control' value="<?php echo $unit?>" size="10"/>Harga<input type=text name=partharga class='form-control' value="<?php echo $harga ?>" />
                            &nbsp<td colspan="3"><input type="submit" name="tombol" class='form-control' value="simpan" />
                        </table>
                    </fieldset>

                </form>
                <?php
            }
            else
                // Part Estimasi
                if ($_GET['page'] == 'partestimasi'){
                    $part_kode = $_GET['kode'];
                    $query = mysqli_query($koneksi, "SELECT * FROM part WHERE part_kode = '$part_kode' ");
                    $ambil = mysqli_fetch_array($query);
                    $nama = $ambil['part_nama'];
                    $code = $ambil['part_code'];
                    $harga = $ambil['part_harga'];
                    $unit = $ambil['part_unit'];
                    ?>
                    <form>
                        <fieldset>
                            <legend>Edit Part Estimasi</legend>
                            <table width="100%">
                                Code<input type="text" name="partcode" class='form-control' value="<?php echo $code ?>"/><input type="hidden" name="page" class='form-control' value="partestimasi"><input type="hidden" name="partkode" class='form-control' value="<?php echo $part_kode?>" />Nama<input type="text" name="partnama" class='form-control' value="<?php echo $nama ?>"/>
                                Unit<input type=text" name="partunit" class='form-control' value="<?php echo $unit?>" size="10"/>Harga<input type=text name=partharga class='form-control' value="<?php echo $harga ?>" />
                                &nbsp<td colspan="3"><input type="submit" name="tombol" class='form-control' value="simpan" />
                            </table>
                        </fieldset>

                    </form>
                    <?php
                }
        // End of JasaAdmin

}
?>

</div>
</body>
</html>
