<?php
if (isset($_GET['page']) AND $_GET['page'] == "estimasi"){
    $es_kode = $_GET['es_kode'];
    $u_kode = $_GET['u_kode'];
    $totalestimasi = 0;
    $totaljasa = 0;
    $totalpart = 0;

    //Ambil data unit dan estimasi berdasarkan u_kode dan es_kode
    $query1 = mysqli_query($koneksi, "SELECT * FROM unit, estimasi WHERE unit.u_kode = '$u_kode' AND estimasi.u_kode = '$u_kode' AND
             estimasi.es_kode = '$es_kode' ")or die (mysqli_errno());

    //Ambil data Estimasi Jasa
    $query2 = mysqli_query($koneksi, "SELECT * FROM estimasijasa WHERE es_kode = '$es_kode' ");
    $querypart = mysqli_query($koneksi, "SELECT * FROM estimasipart WHERE es_kode = '$es_kode' ");
    $s = (isset($_GET['s'])) ? filter_var($_GET['s'], FILTER_SANITIZE_STRING) : '';
    echo "<table class='table table-condensed'>";

    //Tampilkan detail Unit
    while ($data = mysqli_fetch_array($query1)){
        echo "<tr><td>Nama</td><td>:</td><td>".$data['u_nama']."</td><td>Unit ID</td><td>:</td><td>".$data['u_kode']."</td></tr>";
        echo "<tr><td>Nopol</td><td>:</td><td>".$data['u_nopol']."</td><td>Estimasi ID</td><td>:</td><td>".$data['es_kode']."</td></tr>";
        echo "<tr><td>No. Rangka</td><td>:</td><td>".$data['u_norangka']."</td><td>Tgl Kend. Masuk</td><td>:</td><td>".UbahTanggalKeBulan($data['es_tgl_masuk'])."</td></tr>";
        echo "<tr><td>No. Mesin</td><td>:</td><td>".$data['u_nomesin']."</td><td>Tgl Kend. Keluar</td><td>:</td><td>".UbahTanggalKeBulan($data['es_tgl_keluar'])."</td></tr>";
        echo "<tr><td>No. Model</td><td>:</td><td>".$data['u_nomodel']."</td><td>Tahun </td><td>:</td><td>".$data['u_tahun']."</td></tr>";
        echo "<tr><td>Model Kendaraan</td><td>:</td><td>".$data['u_model']."</td><td>Asuransi</td><td>:</td><td>".NamaAsuransi($data['asuransi'])."</td></tr>";
        echo "<tr><td>Keterangan</td><td>:</td><td colspan=4>".$data['ket']."</td></tr>";
        $_SESSION['model'] = $data['u_model'];

    }
    echo "</table>";
    // Part
    echo "<table class='table'>";
    echo "<tr class='success text-center'><td colspan=6><b>SPARE PART</b></td></tr>";
    $no = 0;
    $hasil = 0;
    while ($data2 = mysqli_fetch_array($querypart)){
            $no++;
            $part_kode = $data2['part_kode'];
            $espart_kode = $data2['espart_kode'];
            $query3 = mysqli_query($koneksi, "SELECT * FROM part WHERE part_kode = '$part_kode' ");
            $data22 = mysqli_fetch_array($query3);

            $jumlah_total = mysqli_query($koneksi, "SELECT SUM(part_harga) AS total FROM part WHERE part.part_kode = '$part_kode'");
            $total = mysqli_fetch_array($jumlah_total);
            $jml3 = mysqli_num_rows($query3);


            if ($jml3 != 0){
                $partkode = $data22['part_kode'];
                echo "<tr><td width=5%>$no.</td><td width=20%>".$data22['part_code']."</td><td width=40% colspan=2>";
                ?>
                <a href="" onclick="inputdata('content/page/crud/edit.php?page=partestimasi&kode=<?php echo $partkode?>','470','170')" >
                <?php
                echo $data22['part_nama']."</a></td><td width=25% align=right>".rupiah($data22['part_harga'])."</td><td width=10% align=center>
                    <a href='' onclick=sate('content/page/crud/delete.php?page=estimasidipart&kode=$espart_kode') >
                    <img src='img/tombol/close.png' /></a></td></tr>";
                $hasil = $total['total'] + $hasil;

            }
            $totalpart = $hasil;

    }

    echo "<tr class=''><td colspan=4 align=right><b>TOTAL PART</td></b><td colspan=1 align=right><b>".rupiah($hasil)."</b></td><td>&nbsp</td></b></tr>";
    echo "</table>";

    // Jasa
    echo "<table class='table'>";
    echo "<tr class='info text-center'><td colspan=5><b>JASA</b></td></tr>";

    $no = 0;
    $hasil = 0;
    while ($data2 = mysqli_fetch_array($query2)){
            $no++;
            $ja_kode = $data2['ja_kode'];
            $esja_kode = $data2['esja_kode'];
            $query3 = mysqli_query($koneksi, "SELECT * FROM jasa WHERE ja_kode = '$ja_kode' ");
            $data22 = mysqli_fetch_array($query3);

            $jumlah_total = mysqli_query($koneksi, "SELECT SUM(ja_price) AS total FROM jasa WHERE jasa.ja_kode = '$ja_kode'");
            $total = mysqli_fetch_array($jumlah_total);
            $jml3 = mysqli_num_rows($query3);


            if ($jml3 != 0){

                echo "<tr><td width=5%>$no.</td><td width=50%>".$data22['ja_nama']."</td><td width=10% align=center>".$data22['ja_jenis']."</td><td width=25% align=right>".rupiah($data22['ja_price'])."</td><td width=10% align=center>
                    <a href='' onclick=sate('content/page/crud/delete.php?page=estimasidijasa&kode=$esja_kode') >
                    <img src='img/tombol/close.png' /></a></td></tr>";
                $hasil = $total['total'] + $hasil;

            }

    }
    $totaljasa = $hasil;
    $totalestimasi = $totaljasa + $totalpart;
    echo "<tr><td colspan=3 align=center>TOTAL JASA</td><td colspan=1 align=right>".rupiah($totaljasa)."</td><td>&nbsp</td></tr>";
    echo "</table>";

    echo "<table width=100%>";
    echo "<tr><th colspan=5>Total Estimasi</th></tr>";
    echo "<tr ><td width=5%></td><td width=60% colspan=2 align=center>TOTAL ESTIMASI &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td width=25% align=right>".rupiah($totalestimasi)."</td><td width=10%></td></tr>";

    echo "</table>";
}
?>
