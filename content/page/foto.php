<?php
// koding baru - 2017
$ambil = mysqli_query($koneksi, "SELECT * FROM foto_kendaraan");

?>
<div class="row">
	<form method=POST class="form-inline">
		<input type=text name=search class="form-control" placeholder="Input Nomor Polisi " autofocus >

		<input type="hidden" name="page" value="foto" />
		<input type=submit class="btn btn-primary btn-sm" name=tombol value=CARI />
    <!-- <a href="#uploadmodal" data-toggle="modal"><button type="button" name="button" class="btn btn-success">Tambah Foto</button></a> -->
	</form>
<br>
  <div id="foto">
    <?php
    //Search
    // if (isset($_POST['search'])){
      $folder = array();
      $dir  = 'files';
      if (is_dir($dir)){
        if ($dh = opendir($dir)){
          while (($file = readdir($dh)) !== false){

            if ($file != "." && $file != "..") {
               $namafolder = $file;
              //  echo $namafolder.' => '.br ;
               // cari di dalam folder /files/$namafolder/
							 if($namafolder != ".png"){
               if ($dh2 = opendir($dir.'/'.$namafolder)){
                 // ini cark di dalam folder files / folder lagi
                 while (($file2 = readdir($dh2)) !== false){
                   if ($file2 != "." && $file2 != "..") {
                     $letakfile = $dir.'/'.$namafolder.'/'.$file2;
                     echo "<div class=kotak>
                            <figure class=figure>
                          ";
                      echo "   <img src='$letakfile' class='img-thumbnail' >
                               <figcaption class='figure-caption text-center'><b>$file</b></figcaption>
                            </figure>
                           </div>
                           ";
                   }
                 }
               }
						 }
							 //
            }

          }
          closedir($dh);
        }
      }
      // print_r($filenya);
    // }
    ?>
  </div>

</div>
