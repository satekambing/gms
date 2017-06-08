<?php
$bulan = 0;
if (isset($_GET['bulan']) AND $_GET['bulan'] != 'bulan'){
    $bulan = $_GET['bulan'];
}
$daftar = array('Bulan','Januari','Febuari','Maret','April','Mey','Juni','Juli','Agustus','September','Oktober','November','Desember');
$count = count($daftar);

for ($i=0;$i < $count;$i++){
    if ($bulan == $i){
    $selek = 'Selected';
    }
    else {
        $selek = '';
    }
    
    echo "<option value=".$i." $selek>".$daftar[$i]."</option>";
    
}
?>