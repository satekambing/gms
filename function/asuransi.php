<?php
// if(isset($hal) && $hal == "modal"){
//   require_once ('../../../config/koneksi.php');
// }else {
//   require_once ('config/koneksi.php');
// }
// // Cek apakah halaman ada di edit list estimasi
// if(!isset($_GET['tombol']) && !$_GET['tombol'] == "SIMPAN"){
//   if ((isset($_GET['page']) AND ($_GET['page'] == "listestimasi") OR isset($_GET['asuransi'])) ){
//       require_once ('../config/koneksi.php');
//       // require_once ('../../../config/koneksi.php');
//
//       $kode = $_GET['kode']; // $kode disini merupakan kode dari estimasi
//       if (isset($_GET['asuransi'])){
//           $kodeangka = $_GET['asuransi'];
//           $kode = ubahasuransi($_GET['asuransi']);
//       }
//       else {
//           $querya = mysqli_query($koneksi, "SELECT asuransi FROM estimasi WHERE es_kode = '$kode' ");
//           $ambil = mysqli_fetch_array($querya);
//           $askode = $ambil['asuransi'];
//           $asnama = ubahasuransi($ambil['asuransi']);
//       }
//       $test = 'ss';
//   }
// }
// $queryas = mysqli_query($koneksi,"SELECT as_kode,as_nama FROM asuransi WHERE as_nama != '' ORDER BY as_nama");
// while ($asdata = mysqli_fetch_array($queryas)){
//     // OR
//     if (isset($kodeangka) AND $kodeangka == $asdata['as_kode']){ // Halaman Unit
//         echo '<option selected=selected value='.$asdata['as_kode'].' >'.$kode.'</option>';
//     }
//     if (isset($askode) AND $askode == $asdata['as_kode'] ){ // List Estimasi
//         echo '<option selected=selected value='.$askode.' >'.$asnama.'</option>';
//     }
//     else {
//         echo '<option value ='.$asdata['as_kode'].' />'.$asdata['as_nama'].'</option>';
//     }
// }
function DropDown(array $data, $selected = null){
  $withkey = (isset($data[0])?0:1);
  // $withkey = 0;
  // if ($data[0] == null){
  //   $withkey = 1; // kalo menggunakan key / misalnya untuk level di table user
  // }
  foreach ($data as $key => $value) {
    $seleksi = "";
    if (($selected == $value) OR($selected == $key)){
      $seleksi = "SELECTED";
    }
    if ($withkey == 0){
      $key = $value ;
    }
    echo "<option $seleksi value='$key'>$value</option>";
    # code...
  }
}
function Asuransi($asuransi = null){
  DropDown(ASURANSI,$asuransi);
}
function NamaAsuransi($asuransi){
  // berupa angka
  return ASURANSI[$asuransi];
}
?>
