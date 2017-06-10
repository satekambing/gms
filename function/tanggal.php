<?php
function  tanggal_indonesia($tgl){
$tanggal  =  substr($tgl,8,2);
$bulan  =  getBulan(substr($tgl,5,2));
$tahun  =  substr($tgl,0,4);
return  $tanggal.' '.$bulan.' '.$tahun;
}

function angkaKeBulan(int $angka){
  if($angka > 12){ return 'Tanggal Tidak Valid';}
  $bulan = array(1=>'Jan','Feb','Maret','April','Mei','Juni','Juli','Agust','Sept','Okt','Nov','Des');
  return $bulan[$angka];
}
function UbahTanggalKeBulan($tanggal){
  // return $tanggal;
  if ($tanggal == "" OR $tanggal == "0000-00-00"){
    return "";
  }
  $tanggal = explode("-",$tanggal);
  $tanggal = str_replace(" ","",$tanggal);
  $bulan   = angkaKeBulan($tanggal[1]);
  $tanggal = $tanggal[2].' '.$bulan.' '.$tanggal[0];

  return $tanggal;
}

?>
