<?php
// koding baru - 2017
if(!isset($_GET['folder'])){
?>

<div class="row">
	<form method=GET class="form-inline">
		<input type=text name=search class="form-control" placeholder="Input Nomor Polisi " autofocus >

		<input type="hidden" name="page" value="foto" />
		<input type=submit class="btn btn-primary btn-sm" name=tombol value=CARI />
    <!-- <a href="#uploadmodal" data-toggle="modal"><button type="button" name="button" class="btn btn-success">Tambah Foto</button></a> -->
	</form>
	<?php }else{
		echo "<a href='?page=foto'><p class='btn btn-primary'>Kembali Ke semua foto </p></a> &nbsp".
					"<a href=''><p class='btn btn-success'>".$_GET['folder'].'</p></a>';
	} ?>
<br>
  <div id="foto">
    <?php
		$folder = (isset($_GET['folder']))?$_GET['folder']:'';
		$dir = "files/";
		if($folder == ''){
			// root
			// echo "<a href=''><p>ROOT /</p></a>";
			$lokasi = "root";
			$sql = "SELECT * FROM foto_kendaraan ";
			if(isset($_GET['search'])){
				$cari = $_GET['search'];
				$sql = "SELECT * FROM foto_kendaraan WHERE folder LIKE '%$cari%' ";
			}
			$sql .= "GROUP BY folder  ORDER BY tgl_upload DESC LIMIT 0,15";
		}else{
			$lokasi = "subroot";
			$sql = "SELECT * FROM foto_kendaraan WHERE folder = '$folder' ";
		}
		$ambil = mysqli_query($koneksi, $sql);
		if(mysqli_num_rows($ambil) <= 0){
			$sql = "SELECT * FROM foto_kendaraan ";
			$sql .= "GROUP BY folder  ORDER BY tgl_upload DESC LIMIT 0,15";
			$ambil = mysqli_query($koneksi, $sql);

		}
		while ($r=mysqli_fetch_object($ambil)) {
			# code...
			$letakfile = $dir.$r->folder.'/'.$r->nama_file;
			$judul = $r->label;
			$href  = $letakfile;
			if($lokasi == "root"){
				$judul = $r->folder;
				$href  ="?page=foto&folder=".$r->folder;
			}
			 ?>
			 <div class=kotak>
				 <figure class=figure>
	 	 			<a href='<?php echo $href?>' <?php echo ($lokasi=='subroot')?'data-fancybox=gallery':'' ?> data-caption="<?php echo $judul ?>" ><img src='<?php echo $letakfile ?>' class='img-thumbnail' alt=$namafolder></a>
						<figcaption class='figure-caption text-center'><b><?php echo $judul ?></b></figcaption>
				 </figure>
				</div>
			 <?php

		}
    ?>
  </div>

</div>
