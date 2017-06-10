<?php
// error_reporting(E_ALL ^ E_DEPRECATED);
define('br', '<br />');
date_default_timezone_set('Asia/Brunei');
$tglnow = date("j/m/y");
$tanggaldb = date("Y-m-d");
$jenis 	= array('K/D','B/P','B/P/D','G','P') ;
$bulannow	= date('m');


define('SERVER','localhost');
define('USER','root');
define('PASS','tidakadakok');
define('DBNAME','gms');
define('ASURANSI',array(1=>'JASINDO','ASWATA','PRIBADI'));
$koneksi  = mysqli_connect(SERVER, USER, PASS, DBNAME) ;
?>
