<?php
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
function rupiah($nominal){
    $rupiah = number_format($nominal,0, ",",".");
    $rupiah = $rupiah; // Bisa di tambah kan Rp. $rupiah
    return $rupiah;
}
