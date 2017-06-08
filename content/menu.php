<ul>
    <!-- <li><a href="" ></a></li> -->
    <a href="index.php?page=unit" ><li>Unit Kendaraan</li></a>
    <!-- <a href="index.php?page=ck" ><li>Check List</li></a> -->
    <!-- <a href="index.php?page=asuransi"><li>Asuransi</li></a> --> 
    <!-- <a href="index.php?page=partadmin"><li>Spare Part</li></a> -->
    <!-- <a href="index.php?page=jasaadmin"><li>Jasa</li></a> -->
    <li> <a href='' ></a></li>
    
</ul>

<!--Menu JasaAdmin -->
<?php if (isset($_GET['page']) and $_GET['page'] == "jasaadmin"){?>
<ul>
    <li><p>Control Menu</p></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=jasaadmin','500','260')" ><li>Tambah Jasa</li></a>
</ul>
<?php } ?>

<!--Menu Infentori -->
<?php if (isset($_GET['page']) and $_GET['page'] == "ck"){?>
<ul>
    <li><p>Control Menu</p></li>
    <a href="" ><li>Input </li></a>
</ul>
<?php } ?>

<!-- Menu Unit -->
<?php if (isset($_GET['page']) and $_GET['page'] == "unit"){ ?>
<ul>
    <li><p>Control Menu</p></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=unit','600','320')" > <li>Tambah Unit</li></a>
    <?php if (isset($_GET['search']) AND $_GET['bulan'] != '0'){?>
    <a href="content/page/report/report_os.php?page=os&bulan=<?php echo $_GET['bulan']?>&asuransi=<?php echo $_GET['asuransi']?>" target="_Blank"> <li>Out Standing</li></a>
    <?php } ?>
</ul>    
<?php } ?>

<!-- Menu List Estimasi-->
<?php if (isset($_GET['page']) and $_GET['page'] == "list"){ ?>
<ul>
    <li><p>Control Menu</p></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=list&kode=<?php echo $_GET['kode']?>','250','150')" > <li>Tambah Estimasi</li></a>
    <a href="" onclick="inputdata('content/page/crud/delete.php?page=unit&kode=<?php echo $_GET['kode']?>','10','10')" > <li>Hapus Unit</li></a>
</ul>    
<?php } ?>

<!-- Menu Estimasi-->
<?php if (isset($_GET['page']) and $_GET['page'] == "estimasi"){ ?>
<ul>
    
    <li><p>Control Menu</p></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=part&es_kode=<?php echo $_GET['es_kode']?>','570','600')" > <li>Tambah Part</li></a>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=jasa&es_kode=<?php echo $_GET['es_kode']?>','500','550')" > <li>Tambah Jasa</li></a>
  
</ul>    
<?php } ?>
<!-- Menu List Estimasi-->
<?php if (isset($_GET['page']) and $_GET['page'] == "asuransi"){ ?>
<ul>
    <li><p>Control Menu</p></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=asuransi','250','150')" > <li>Tambah Asuransi</li></a>
    
</ul>    
<?php } ?>

<!-- Menu Nota-->
<?php if (isset($_GET['page']) and $_GET['page'] == "nota"){ ?>
<ul>
    <li><p>Control Menu</p></li>
    <a href="" onclick="inputdata('content/page/crud/input.php?page=unitnota','600','320')" >  <li>Tambah Nota</li></a>
    
</ul>    
<?php } ?>



