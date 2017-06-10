<?php
if (isset($_GET['page']) AND $_GET['page'] == "list"){
    $kode = $_GET['kode'];
    //Ambil data tgl masuk dan keluar dimana yg memiliki u_kode yg sama dengan u_kode dr url
    $query = mysqli_query($koneksi, "SELECT * FROM estimasi WHERE estimasi.u_kode = '$kode' ");
    $no = 0;
    ?>
  <blockquote>
    <p>Kode Unit : <span class="text-danger"><?php echo $kode ?></span> </p>
  </blockquote>
  <div class="tangan_div">
    <table width="100%" class="table table-striped">
        <th>ID</th>
        <th>Asuransi</th>
        <th>Tgl Masuk</th>
        <th>Tgl Keluar</th>
        <th>Pilihan</th>
    <?php
    while ($daftar = mysqli_fetch_array($query)){
        $no++;
        $es_kode = $daftar['es_kode'];
        $keluar =  UbahTanggalKeBulan($daftar['es_tgl_keluar']);
        $masuk = UbahTanggalKeBulan($daftar['es_tgl_masuk']);
        $es_kode = $daftar['es_kode'];
        $asuransi = NamaAsuransi($daftar['asuransi']);

        if (substr($keluar, 0,2) == 00){
            $keluar = "Belum di isi";
        }
        echo "<tr><td width=5% align=center><a href='?page=estimasi&es_kode=$es_kode&u_kode=$kode' >".$daftar['es_kode'].".</a>
            </td><td width=25% align=center>".$asuransi."</td><td width=30%>".$masuk."</td><td width=30%>".$keluar."</td><td align=center width=10%>
            <a href='' onclick=sate('content/page/crud/delete.php?page=listestimasi&kode=$es_kode') >
            <img src='img/tombol/close.png' /></a> &nbsp
            <a href='' onclick=inputdata('content/page/crud/edit.php?page=listestimasi&kode=$es_kode',460,400) >
            <img src='img/tombol/edit.png' /></a>
            </td></tr>";
    }
    echo "</table>"; // End of table
    echo "<div class=tangan_list>
          <img src='img/arrowr.png' >
         </div>

    </div>";

}
else {
    header("Location: ?");
}
?>
