<?php
if (isset($_GET['page']) AND isset($_GET['kode'])){
    include ('../../../config/koneksi.php');
    $kode = $_GET['kode'];
    if ($_GET['page'] == "unit"){
        $query_eskode = mysqli_query($koneksi, "SELECT es_kode FROM estimasi WHERE u_kode = '$kode' ");
        $data_eskode = mysqli_fetch_array($query_eskode); // Ambil kode Esja
        $esja = $data_eskode['es_kode'];

        $query = mysqli_query($koneksi, "DELETE FROM unit WHERE unit.u_kode = '$kode'  ") or die (mysql_error());
        $query1 = mysqli_query($koneksi, "DELETE FROM estimasi WHERE es_kode = '$esja' ");
        $query2 = mysqli_query($koneksi, "DELETE FROM estimasijasa WHERE es_kode = '$esja' ");
        $query3 = mysqli_query($koneksi, "DELETE FROM estimasipart WHERE es_kode = '$esja' ");
    }
    else
        if ($_GET['page'] == "estimasidipart"){
            mysqli_query($koneksi, "DELETE FROM estimasipart WHERE espart_kode = $kode");
        }
        else
            if ($_GET['page'] == "estimasidijasa"){
                mysqli_query($koneksi, "DELETE FROM estimasijasa WHERE esja_kode = $kode");
                echo $kode;
            }
            else
                if ($_GET['page'] == "listestimasi"){
                    $esja = $_GET['kode'];
                    $query1 = mysqli_query($koneksi, "DELETE FROM estimasi WHERE es_kode = '$esja' ");
                    $query2 = mysqli_query($koneksi, "DELETE FROM estimasijasa WHERE es_kode = '$esja' ");
                    $query3 = mysqli_query($koneksi, "DELETE FROM estimasipart WHERE es_kode = '$esja' ");
                }
    /*
    if ($query){
        echo "Success";
    }
    else {
        echo "Gagal";
    }
    */



}
?>
<script>
    self.close();
    window.opener.location.reload();
</script>
