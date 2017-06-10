<ul class="nav nav-list">
    <!-- <li><a href="" ></a></li> -->
    <li><a href="index.php?page=unit" >Data Unit</a></li>
    <!-- <a href="index.php?page=ck" ><li>Check List</li></a> -->
    <!-- <a href="index.php?page=asuransi"><li>Asuransi</li></a> -->
    <!-- <a href="index.php?page=partadmin"><li>Spare Part</li></a> -->
    <!-- <a href="index.php?page=jasaadmin"><li>Jasa</li></a> -->


<!--Menu JasaAdmin -->
<?php if (isset($_GET['page']) and $_GET['page'] == "jasaadmin"){?>

    <li><p>Control Menu</p></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=jasaadmin','500','260')" ><li>Tambah Jasa</li></a>

<?php } ?>

<!--Menu Infentori -->
<?php if (isset($_GET['page']) and $_GET['page'] == "ck"){?>

    <li><p>Control Menu</p></li>
    <a href="" ><li>Input </li></a>

<?php } ?>

<!-- Menu Unit -->
<?php if (isset($_GET['page']) and $_GET['page'] == "unit"){ ?>
    <li><a href="" onclick="inputdata('content/page/crud/input.php?page=unit','600','620')" > Tambah Unit</a></li>
    <?php if (isset($_GET['search']) AND $_GET['bulan'] != '0'){?>
    <a href="content/page/report/report_os.php?page=os&bulan=<?php echo $_GET['bulan']?>&asuransi=<?php echo $_GET['asuransi']?>" target="_Blank"> <li>Out Standing</li></a>
    <?php } ?>

<?php } ?>

<!-- Menu List Estimasi-->
<?php if (isset($_GET['page']) and $_GET['page'] == "list"){ ?>
    <li><a href="" onclick="inputdata('content/page/crud/input.php?page=list&kode=<?php echo $_GET['kode']?>','350','350')" > Tambah Estimasi</a></li>
    <li><a href="" onclick="inputdata('content/page/crud/delete.php?page=unit&kode=<?php echo $_GET['kode']?>','10','10')" > Hapus Unit</a></li>

<?php } ?>

<!-- Menu Estimasi-->
<?php if (isset($_GET['page']) and $_GET['page'] == "estimasi"){ ?>

    <li><a href="" onclick="inputdata('content/page/crud/input.php?page=part&es_kode=<?php echo $_GET['es_kode']?>','570','700')" > Tambah Part</li></a>
    <li><a href="" onclick="inputdata('content/page/crud/input.php?page=jasa&es_kode=<?php echo $_GET['es_kode']?>','500','750')" class="text-info"> Tambah Jasa</li></a>

    <li><a href="content/page/report/report_estimasi.php?page=estimasi&es_kode=<?php echo $_GET['es_kode']?>&u_kode=<?php echo $_GET['u_kode']?>" target="_Blank">Print Estimasi</a></li>
    <li><a href="content/page/report/report_kwitansi.php?page=estimasi&es_kode=<?php echo $_GET['es_kode']?>&u_kode=<?php echo $_GET['u_kode']?>" target="_Blank">Cetak Nota</a></li>



<?php } ?>
<!-- Menu List Estimasi-->
<?php if (isset($_GET['page']) and $_GET['page'] == "asuransi"){ ?>

    <li><a>Control Menu</a></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=asuransi','250','150')" > <li>Tambah Asuransi</li></a>


<?php } ?>

<!-- Menu Nota-->
<?php if (isset($_GET['page']) and $_GET['page'] == "nota"){ ?>

    <li><p>Control Menu</p></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=unitnota','600','320')" >  <li>Tambah Nota</li></a>


<?php } ?>
</ul>
