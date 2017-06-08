<?php
	define('br', '<br />');
	date_default_timezone_set('Asia/Brunei');
	$tglnow = date("j/m/y");
	$tanggaldb = date("Y-m-d");
	$jenis 	= array('K/D','B/P','B/P/D','G','P') ;
	$bulannow	= date('m');
	
	$server = "127.0.0.1";
	$user = "root";
	$password = "";
	$db  = "amd";
	 
	$koneksi  = mysql_connect($server, $user, $password) ;
	$db = mysql_select_db($db,$koneksi);
	
function paging($sql,$item_per_page){
   $halaman          =  isset($_GET['halaman']) ? $_GET['halaman'] : 1 ; // halaman adalah didapat dari GET page. Jika tidak ada ya berarti halaman satu
   if( ( $halaman < 1) && (empty( $halaman ) ) ){
      $halaman=1; 
   }
   $query         = mysql_query( $sql ) or die (mysql_error());
   $jumlah_data   = mysql_num_rows($query) or die (mysql_error());
   $jumlah_hal    = ceil( $jumlah_data/$item_per_page );
   if( $halaman>$jumlah_hal ){
      $halaman=$jumlah_hal;
   }
   $lanjut  = $halaman + 1;
   $sebelum = $halaman - 1;
   ?>
  
   <a href="?page=unit&halaman=1"></a><a href="?page=unit&halaman=<?php echo $sebelum; ?>">Prev</a>
   ||
   <a href="?page=unit&halaman=<?php echo $lanjut;?>">Next</a><a href="?page=unit&halaman=<?php echo $jumlah_hal;?>"></a>
   
   <?php 
}
function ubahbulan($angka){
    switch ($angka){
        case '1' : $bulan = 'Januari';
            break;
        case '2' : $bulan = 'Febuari';
            break;
        case '3' : $bulan = 'Maret';
            break;
	case '4' : $bulan = 'April';
            break;
	case '5' : $bulan = 'Mey';
            break;
	case '6' : $bulan = 'Juni';
            break;
	case '7' : $bulan = 'Juli';
            break;
	case '8' : $bulan = 'Agustus';
            break;
	case '9' : $bulan = 'September';
            break;	
	case '10' : $bulan = 'Oktober';
            break;
	case '11' : $bulan = 'November';
            break;
	case '12' : $bulan = 'Desember';
            break;
	}
    return strtoupper($bulan);
}
function angkakebulan($tanggal){
    $tahun = substr($tanggal,0,4);
    $bulan = substr($tanggal, 5,2);
    $tanggal = substr($tanggal, 8,2);
    // $bulan = ubahbulan($bulan);
    $hasil = $tanggal.'/'.$bulan.'/'.$tahun;
    return $hasil;
}
function ubahasuransi($asuransi){
    $konvertasuransi = mysql_query("SELECT * FROM asuransi WHERE as_kode = '$asuransi' ");
    $ambilas = mysql_fetch_array($konvertasuransi);
    $namaas = $ambilas['as_nama'];
    return $namaas;
}
function rupiah($nominal){
    $rupiah = number_format($nominal,0, ",",".");
    $rupiah = $rupiah; // Bisa di tambah kan Rp. $rupiah
    return $rupiah;
}
    ?>