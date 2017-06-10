<?php
// Index Page PO
if (isset($_GET['page']) and $_GET['kode']){
    $kode = $_GET['kode'];
    $page = $_GET['page'];
    //ambil data unit kode
    $query2 = mysql_query("SELECT * FROM estimasi WHERE u_kode = '".$kode."' ");
    while ($data = mysql_fetch_array($query2)){
        // Settingan Table pada PO
        echo "<form><fieldset><legend>Purcase Order</legend>";
        echo "<table width=100%><tr>";
        echo "<td width=30%>Unit ID </td><td>:".$data['u_kode']."</td></tr>";
        echo "<tr><td>Estimasi Data </td><td>:".$data['es_kode']."</td></tr>";
      
        //Simpan sessi untuk estimasi kode
        session_start();
        $_SESSION['es_kode'] = $data['es_kode'];
        $es_kode = $_SESSION['es_kode'];
        //ambil data purcaorder dimana estimasi kode sama
        $query3 = mysql_query("SELECT * FROM orderpurca WHERE es_kode = '".$data['es_kode']."' ")or die (mysql_error());
        $jml2 = mysql_num_rows($query3);
        echo "<tr><td>Jumlah Data </td><td>:".$jml2."</td></tr>";
        echo "</table>";
        //Pisah jadi 2 Table agar bisa memasukan HR
        echo "<hr />";
        echo "<table width=90%>";
        //Tampilkan purcase order
        $no = 0;
        while ($data2 = mysql_fetch_array($query3)){
            $no++;
            $or_kode = $data2['or_kode'];
            $or_nama = $data2['or_nama'];
            echo "<tr><td width=5%>".$no."</td><td width=80%>".$data2['or_nama']."</td> <td align=center width=15%><a href='' onclick=sate('content/page/crud/delete.php?page=$page&kode=$or_kode') >
            <img src='img/tombol/close.png' /></a> &nbsp".
            "<a href='' onclick=inputdata('content/page/crud/edit.php?page=$page&or_kode=$or_kode','300','120') ><img src='img/tombol/edit.png' /></a>".
                    
            "</td></tr>";
        }
        echo "</table>";
        echo "</fieldset></form>";
    }
}
else {
    header('Location: index.php?');
}
?>