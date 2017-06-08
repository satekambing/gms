<?php
// Cek apakah halaman ada di edit list estimasi
if ((isset($_GET['page']) AND ($_GET['page'] == "listestimasi") OR isset($_GET['asuransi'])) ){
    include '../config/koneksi.php';
    
    $kode = $_GET['kode']; // $kode disini merupakan kode dari estimasi
    if (isset($_GET['asuransi'])){
        $kodeangka = $_GET['asuransi'];
        $kode = ubahasuransi($_GET['asuransi']); 
    }
    else {
        $querya = mysql_query("SELECT asuransi FROM estimasi WHERE es_kode = '$kode' ");
        $ambil = mysql_fetch_array($querya);
        $askode = $ambil['asuransi'];
        $asnama = ubahasuransi($ambil['asuransi']);
    }
    $test = 'ss';
}
//include ('../config/koneksi.php');
$queryas = mysql_query("SELECT as_kode,as_nama FROM asuransi WHERE as_nama != '' ORDER BY as_nama");
while ($asdata = mysql_fetch_array($queryas)){
    // OR 
    if (isset($kodeangka) AND $kodeangka == $asdata['as_kode']){ // Halaman Unit
        echo '<option selected=selected value='.$asdata['as_kode'].' >'.$kode.'</option>';
    }
    if (isset($askode) AND $askode == $asdata['as_kode'] ){ // List Estimasi
        echo '<option selected=selected value='.$askode.' >'.$asnama.'</option>'; 
    }
    else {
        echo '<option value ='.$asdata['as_kode'].' />'.$asdata['as_nama'].'</option>';
    }
}
echo 'sate';
?>
