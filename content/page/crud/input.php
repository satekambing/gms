<?php
session_start();
$onpage = "";
if (isset($_GET['isi']) AND $_GET['isi'] == ""){
    $onpage = "onunload=tutup()";
}
if (isset($_GET['namajasa']) AND $_GET['namajasa'] == " "){
    $onpage = "onunload=tutup()";
}
if (isset($_GET['page']) AND $_GET['page'] == "part"){
    $onpage = "onbeforeunload=tutup()";
}
require_once ('../../../config/koneksi.php');
require_once ('../../../function/asuransi.php');

?>
<html>
<head> <title> Input </title><script src="../../../js/crud.js"></script>
<link rel="stylesheet" type="text/css" href="../../../css/unit.css" />
<link rel="stylesheet" type="text/css" href="../../../css/blueprint.css" />
<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />

</head>
<body <?php echo $onpage ?>>
<div class="container">
<!-- Input Estimasi-->
<?php if (isset($_GET['page']) and $_GET['page'] == "list") {?>
<h2>Tambah Estimasi</h2>
<form method="get" class="form">
  <div class="form-group">
    <label for="">Asuransi</label>
    <?php $hal = "modal"; ?>
    <select name="asuransi" class="form-control">
      <?php Asuransi() ?>
    </select>
  </div>
  <div class="form-group">
    <label for="">Tgl Masuk</label>
    <input type="date" name="tgl_masuk" class="form-control" required="" />
  </div>
  <div class="form-group">
    <label for="">Tgl Keluar</label>
    <input type="date" name="tgl_keluar" class="form-control"  />
  </div>
  <input type="hidden" name="page" value="list" />
  <input type="hidden" name="kode" value="<?php echo $_GET['kode'] ?>" />
  <div class="form-group">
    <input type="submit" name="tombol" value="simpan" class="btn btn-primary">
  </div>
</form>
<?php } ?>

<!-- Input JASAADMIN-->
<?php if (isset($_GET['page']) and $_GET['page'] == "jasaadmin") {?>
<h2>Tambah Jasa </h2>
<form method="get" class="form-inline">
  <div class="form-group">
    Kode <input type="text" class="form-control" name="jakode" />
    Nama <input type="text" class="form-control" name="janama" autofocus/>
    Harga <input type="text" class="form-control" name="jaharga" />
  </div>


    Jenis<select name="jajenis">
                <?php
                foreach ($jenis as $value){
                     echo "<option value=$value>$value</option>";
                } ?>
            </select>
    <input type="hidden" name="page" value="jasaadmin" />
    <input type="submit" name="tombol" value="simpan">

</form>
<?php } ?>
<!--Input Unit-->
<?php if (isset($_GET['page']) and ($_GET['page'] == "unit" || $_GET['page'] == "unitnota")) {?>
<h2>Form Input - Unit</h2>
<form method="get" class="form-inline">
    <!-- <legend>Tambah Unit <?php //echo $tanggaldb ?></legend> -->
    <div class="form-group">
      <label for="">Nama</label>
      <input type="text" class="form-control" name="tertanggung" placeholder="Tertanggung" required autofocus/>
    </div>
    <div class="form-group">
      <label for="">Nopol</label>
      <input type="text" class="form-control" name="nopol" placeholder="Nopol" required />
    </div>
    <div class="form-group">
      <label for="">Jenis</label>
      <input type="text" class="form-control" name="merk" placeholder="Toyota" size="5"/>-<input type="text" class="form-control" name="model" placeholder="Avanza" size="8"/>
    </div>
    <div class="form-group">
      <label for="">Tahun</label>
      <input type="text" class="form-control" name="tahun" placeholder="Tahun" />
    </div>

	<?php if ($_GET['page'] == "unit"){?>
    <div class="form-group">
      <label for="">Tgl Masuk</label>
      <input type="date" class="form-control" name="tgl_masuk" placeholder="Tgl Masuk" required=""/>
    </div>
    <div class="form-group">
      <label for="">Tanggal Keluar</label>
      <input type="date" class="form-control" name="tgl_keluar" placeholder="Tgl Keluar" />
    </div>
    <div class="form-group">
      <label for="">No. Rangka</label>
      <input type="text" class="form-control" name="rangka" placeholder="No Rangka" />
    </div>
    <div class="form-group">
      <label for="">No. Mesin</label>
      <input type="text" class="form-control" name="mesin" placeholder="No Mesin" />
    </div>
    <div class="form-group">
       <label for="">No. Model</label>
       <input type="text" class="form-control" name="nomodel" placeholder="nomor model" />
    </div>
    <div class="form-group">
      <label for="">Asuransi</label>
      <?php $hal = "modal"; ?>
      <select name="asuransi" class="form-control"><?php Asuransi() ?></select>
    </div>

	<?php } ?>
  <div class="form-group">
    <label for="">No Hp.</label>
    <td colspan=4><input type="text" class="form-control" name="no_hp" placeholder="Nomer Telp"/>
  </div>
  <div class="form-group">
    <label for="">Ket</label>
    <textarea class="form-control" name="ket" cols="17" rows="2"></textarea>
  </div>

  <input type="hidden" name="page" value=<?php echo $_GET['page'] ?> />

  <input type="submit" name="tombol" class="btn btn-primary" value="SIMPAN">

</form>
<?php } ?>
<!-- Tambah Part -->
<?php if (isset($_GET['page']) and $_GET['page'] == "part") { ?>
<form method="get" action="" class="form-inline" onsubmit="refreshparent()">
  <div class="form-group">
    <label for="">Code</label>
    <input type="text" class="form-control" name="codepart" autofocus placeholder="Kode Spare Part" />
  </div>
  <div class="form-group">
    <label for="">Nama</label>
    <input type="text" class="form-control" name="namapart" placeholder="Nama Barang" />
  </div>
  <div class="form-group">
    <label for="">Harga</label>
    <input type="text" class="form-control" name="hargapart" placeholder="Harga Spare Part"/>
  </div>
    <input type="hidden" name="page" value="part"/>
    <?php
    if (isset($_GET['es_kode'])){
            echo "<input type=hidden name=es_kode value=".$_GET['es_kode']." />";
        }
    ?>
    <input type="hidden" class="form-control" name="partunit" value="<?php echo $_SESSION['model']; ?> "/>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" onclick="refreshparent()" name="tombol" value="Buat" />
    <input type="submit" class="btn btn-info" name="tombol" value="Cari" />
  </div>


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
        $result = mysqli_query($koneksi, $query) ;
        $jml = mysqli_num_rows($result);
        $es_kode = $_GET['es_kode'];
        echo "<table class='table table-striped table-bordered' style='font-size: 1em'>";
        $no = 0;
        while ($part = mysqli_fetch_array($result)){
            $no++;
            $partkode = $part['part_kode'];
            echo "  <tr>
                      <td width=5%>".$partkode."</td>
                      <td width=25%>".$part['part_code']."</td>
                      <td width=45%>
                        <a href='?page=espartkode&es_kode=$es_kode&partkode=$partkode&tombol=espartkode' onclick=refreshparent() >".$part['part_nama']."</a></td>
                      <td width=10%>".$part['part_unit']."</td>
                      <td width=15% align=right>".number_format($part['part_harga'])."</td>

                     </tr>
                      ";


            } // End while statment
         //if (isset($_GET['es_kode']))
         //echo "<td colspan=5 align=center><a href='?page=estimasipart&es_kode=".$_GET['es_kode']." ' >Kembali Ke Estimasi</a>";
         echo "</table>";
    }  // End of Part  ?>

<!--Input Jasa-->
<?php if (isset($_GET['page']) and $_GET['page'] == "jasa") { ?>
<h3>Tambah Daftar Jasa</h3>
<form method="get" action="" class="form">
    <input type="hidden" name="page" value="jasa"/>
    <input type="hidden" name="kode" value="">
    <input type="hidden" name="es_kode" value="<?php echo $_GET['es_kode']?>" >

  <div class="form-group">
    <label for="">Nama</label>
    <input type="text" class="form-control" name="namajasa" autofocus/>
  </div>
  <div class="form-group">
    <label for="">Harga</label>
    <input type="text" class="form-control" name="hargajasa" />
  </div>

  <?php
  if (isset($_GET['es_kode'])){
          echo "<input type=hidden name=es_kode value=".$_GET['es_kode']." />";
      }
  ?>
  <div class="form-group">
    <label for="">Jenis Perbaikan</label>
    <select name="jenis" class='form-control'>
      <?php
      foreach ($jenis as $value){
        echo "<option value=$value>$value</option>";
      } ?>
    </select>
  </div>
  <div class="form-group">
    <input type="submit" name="tombol" class="btn btn-primary" value="Buat" />
    <input type="submit" name="tombol" class="btn btn-info" value="Cari" /> * Untuk nama jasa usahakan di singkat
  </div>


</form>
    <?php
        $ja_kode = "";
        if (isset($_GET['inputjasa']))
            $ja_kode = $_GET['inputjasa'];
        // if (!empty($_GET['inputjasa']) OR !empty($_GET['namajasa'])){
        //     $namajasa = $_GET['namajasa'];
        //     // $kodejasa = $_GET['inputjasa'];
        //     $query = "SELECT * FROM jasa WHERE ja_nama LIKE '%$namajasa%' AND ja_kode LIKE '%$kodejasa%' ";
        //
        // }
        else {
            $query = "SELECT * FROM jasa WHERE ja_kode <> '' LIMIT 0,9";
        }
        $result = mysqli_query($koneksi, $query) ;
        $jml = mysqli_num_rows($result);

        echo "<table class='table table-striped table-bordered'>";
        $no = 0;
        $es_kodes = $_GET['es_kode'];
        while ($jasa = mysqli_fetch_array($result)){
            $no++;
            $jasakode = $jasa['ja_kode'];
            // table jasa
            echo "<tr><td width=1%>$no.
                      <td width=20%>".$jasakode."
                      <td width=39%><a href='?page=esjasakode&es_kode=$es_kodes&jakode=$jasakode&tombol=esjakode' onclick=refreshparent() >".$jasa['ja_nama']."</a>
                      <td width=10%>".$jasa['ja_jenis']."
                      <td width=20% align=right>".number_format($jasa['ja_price'])."
                  </tr>  ";


            } // End while statment
         //if (isset($_GET['es_kode']))
         //echo "<td colspan=5 align=center><a href='?page=estimasijasa&es_kode=".$_GET['es_kode']." ' >Kembali Ke Estimasi</a>";
         echo "</table>";

    }  // End of Jasa  ?>

<!--Input Estimasi Jasa-->
<?php if (isset($_GET['page']) AND $_GET['page'] == "estimasijasa") {?>

<form method="get">
<fieldset>
    <legend>Pencarian Jasa</legend>

        Kode Jasa<input type="text" class="form-control" name="kodejasa" />
        Nama Jasa<input type="text" class="form-control" name="namajasa" autofocus/>
                <input type="hidden" name="page" value="estimasijasa" />
                <input type="hidden" name="es_kode" value="<?php echo $_GET['es_kode']?>" />
                <input type="submit" name="tombol" value="cari" />

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
    $result = mysqli_query($koneksi, $query) ;
    $jml = mysqli_num_rows($result);


    $no = 0;
    echo "<table width=100%>";
    while ($jasa = mysqli_fetch_array($result)){
        $no++;
        $jasakode = $jasa['ja_kode'];

        echo "<td width=1%>$no.
                  <td width=20%><a href='?page=esjasakode&es_kode=$es_kode&jakode=$jasakode&tombol=esjakode' >".$jasakode."</a>
                  <td width=39%>".$jasa['ja_nama']."
                  <td width=10%>".$jasa['ja_jenis']."
                  <td width=20% align=right>".rupiah($jasa['ja_price'])."
                  ";

    } // End while statment

    echo "<td colspan=5 align=center><a href='?page=jasa&es_kode=$es_kode' >Buat Jasa</a>";
    echo "";
}  // End of Estimasi Jasa  ?>
<!--Asuransi-->
<?php if (isset($_GET['page']) AND $_GET['page'] == "asuransi") {?>
<form method="get">
    <fieldset>
        <legend>Asuransi</legend>
            <input type="text" class="form-control" name="asuransi" placeholder="Asuransi" autofocus/>
            <input type="text" class="form-control" name="des" placeholder="Desktription" />
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

        Kode Part<input type="text" class="form-control" name="kodepart" />
        Nama     <input type="text" class="form-control" name="namapart" autofocus/>
                <input type="hidden" name="page" value="estimasipart" />
                <input type="hidden" name="es_kode" value="<?php echo $_GET['es_kode']?>" />
                <input type="submit" name="tombol" value="cari" />

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
    $result = mysqli_query($koneksi, $query) ;
    $jml = mysqli_num_rows($result);


    $no = 0;
    echo "<table width=100%>";
    while ($part = mysqli_fetch_array($result)){
        $no++;
        $partkode = $part['part_kode'];

        echo "
                  <td width=10%><a href='?page=espartkode&es_kode=$es_kode&partkode=$partkode&tombol=espartkode' >".$partkode."</a>
                  <td width=30%>".$part['part_code']."
                  <td width=40%>".$part['part_nama']."
                  <td width=20% align=right>".rupiah($part['part_harga'])."
                  ";

    } // End while statment

    echo "<td colspan=5 align=center><a href='?page=part&es_kode=$es_kode' >Buat Part</a>";
    echo "";
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
                $kodeid = str_replace(" ","",$nopol).substr($_GET['tgl_masuk'],5,2).substr($_GET['tgl_keluar'],8,3);

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

					 $query = mysqli_query($koneksi, "INSERT INTO unit (u_kode,u_nama,u_nopol,u_norangka,u_nomesin,u_model,u_nomodel,u_tahun,u_merk) VALUES
                    ('$kodeid','$cus','$nopol','$rangka','$nomesin','$model','$nomodel', '$tahun','$merk') ") ;
					 $estimasi = mysqli_query($koneksi, "INSERT INTO estimasi (u_kode, es_tgl_masuk, es_tgl_keluar,asuransi,ket) VALUES ('".$kodeid."','".$tgl_masuk."','".$tgl_keluar."','".$asuransi."','".$ket."') ");

                // Direct ke Estimasi berdasarkan kode id
                     echo "<script>directlink('page=unit_edit&kode=$kodeid')</script>";
				}
				else {
					 $query = mysqli_query($koneksi, "INSERT INTO unit (u_kode,u_nama,u_nopol,u_model,u_tahun,u_merk) VALUES
                    ('$kodeid','$cus','$nopol','$model','$tahun','$merk') ") ;
					 $estimasi = mysqli_query($koneksi, "INSERT INTO faktur (u_kode, fak_tanggal) VALUES ('".$kodeid."','".$datenow."') ");

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
                   $query = mysqli_query($koneksi, "INSERT INTO estimasijasa (es_kode,ja_kode) VALUES ('$es_kode','$ja_kode') ");
                   header("Location: ?page=jasa&es_kode=".$es_kode);



                }
                else
             // Input Jasa Post
                    if ($_GET['page'] == "jasa" AND $_GET['tombol'] == "Buat"){
                        // $kodejasa = $_GET['inputjasa']; // Kode Jasa
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
                        $kode = rand(0,9999);
                        $jenis = $_GET['jenis'];
                        $harga = $_GET['hargajasa'];
                        $cek = mysqli_query($koneksi, "SELECT ja_kode FROM jasa WHERE ja_kode = '$kode' ");
                        if(mysqli_num_rows($cek) > 0){
                          $kode = rand(0,99999);
                        }
                        $jumcek = mysqli_num_rows($cek);
                        $cetak = mysqli_fetch_array($cek);

                        if ($jumcek != 0){
                            echo 'Gagal : Kode Jasa Sudah Ada !';
                        }
                        else {
                            echo 'Berhasil Input '.$kode;
                        }

                        if (isset($_GET['es_kode'])){
                            $es_kode = $_GET['es_kode'];
                            $query1 = mysqli_query($koneksi, "INSERT INTO estimasijasa (es_kode,ja_kode) VALUES ('$es_kode','$kode')");
                            if ($query1){
                                echo '-- Has Ben Insert'.$es_kode.' - '.$kode;
                            }
                            else {
                                echo "<script>alert ('Gagal')</script>";
                            }


                        }
                        $query = mysqli_query($koneksi, "INSERT INTO jasa (ja_kode,ja_nama,ja_jenis,ja_price) VALUES ('$kode','$namajasa','$jenis','$harga') ");
                        echo "<script>refreshparent()</script>Berhasil";
                        // header("Location: ?page=jasa&es_kode=$es_kode");

                    }
                    else
                        // Input Part Post
                        if ($_GET['page'] == "part" AND $_GET['tombol'] == "Buat"){
                            // Ambil Kode trakir dari table part
                            $query = mysqli_query($koneksi, "SELECT part_kode FROM part WHERE part_kode=(select max(part_kode) FROM part)");
                            $data = mysqli_fetch_array($query);
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
                            $harga2 = 0;
                            echo $kode.' '.$nama.' '.$harga;
                            $es_kode = $_GET['es_kode'];
                            if ($namapart == ''){ // Penggunaan Part Array
                                for ($i=0; $i < $s; $i++){
                                    $hargax[$i] = str_replace(',','', $hargax[$i]);
                                    $codex[$i] = trim($codex[$i]);
                                    $namax[$i] = trim($namax[$i]);
                                    if ($codex[$i] != 0){
                                         $query = mysqli_query($koneksi, "INSERT INTO part (part_code,part_nama,part_harga) VALUES ('$codex[$i]','$namax[$i]','$hargax[$i]') ") ;
                                         $insertestimasix = mysqli_query($koneksi, "INSERT INTO estimasipart (es_kode,part_kode) VALUES ('$es_kode','$kodetrakir') ");

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
                                    $query = mysqli_query($koneksi, "INSERT INTO part (part_code,part_nama,part_harga,part_unit,part_harganormal) VALUES ('$kode','$nama','$harga','$unit','$harga2') ");
                                    $insertestimasi = "INSERT INTO estimasipart (es_kode,part_kode) VALUES ('$es_kode','$kodetrakir') ";
                                    $es_kode = $_GET['es_kode'];
                                    $query = mysqli_query($koneksi, $insertestimasi);
                                }

                            }
                            if ($query){
                              echo "<div class='alert alert-info'>Berhasil Input $nama </div>";
                            }
                            else {
                              echo "<div class='alert alert-warning'>Gagal Memasukkan Data</div>";
                            }


                        }
                        else
                        // Estimasi Part Post
                            if ($_GET['page'] == "espartkode"){
                                $es_kode = $_GET['es_kode'];
                                $part_kode = $_GET['partkode'];
                                $query = mysqli_query($koneksi, "INSERT INTO estimasipart (es_kode,part_kode) VALUES ('$es_kode','$part_kode') ");
                                header("Location: ?page=part&es_kode=".$es_kode);
                            }
                            else
                                if ($_GET['page'] == "list" AND $_GET['tombol'] == "simpan"){
                                    $u_kode = $_GET['kode'];
                                    $masuk = $_GET['tgl_masuk'];
                                    $keluar = $_GET['tgl_keluar'];
                                    $asuransi = $_GET['asuransi'];

                                    mysqli_query($koneksi, "INSERT INTO estimasi (u_kode,es_tgl_masuk,es_tgl_keluar,asuransi) VALUES ('$u_kode','$masuk','$keluar','$asuransi') ");
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
                                        $query = mysqli_query($koneksi, "INSERT INTO jasa (ja_kode,ja_nama,ja_jenis,ja_price) VALUES ('$kode','$namajasa','$jenis','$harga') ");
                                        if ($query){
                                            echo "Succes Input : ".$kode.' '.$namajasa.' '.$jenis.' '.$harga;
                                        }
                                    }

                                    else
                                        // input asuransi
                                            if ($_GET['page'] == "asuransi") {
                                                $asuransi = $_GET['asuransi'];
                                                $des = $_GET['des'];

                                                $query = mysqli_query($koneksi, "INSERT INTO asuransi (as_nama,as_deskripsi) VALUES ('$asuransi','$des') ") ;
                                                echo "<script>tutup()</script>";
                                            }

}
// Test script

?>
</div>

</body>
</html>
