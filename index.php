<?php
session_start();
if(!isset($_SESSION['username'])){
  header('location: login.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GMS V2</title>

        <!-- Style -->
        <link rel="icon" href="img/icon.png">
        <link href="css/index.css" rel="stylesheet" type="text/css" />
        <!-- <link href="css/blueprint.css" rel="stylesheet" type="text/css" /> -->
        <link href="css/menu.css" rel="stylesheet" type="text/css" />
        <link href="css/unit.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css" />

        <link rel="stylesheet" href="font_awesome/css/font-awesome.min.css" type="text/css" >
</head>
<body>
<?php
require_once ('config/koneksi.php');
require_once ('function/asuransi.php');
require_once ('function/tanggal.php');
require_once ('function/fungsi_view.php');

?>
<div id="wrapper" class="container">
  <div class="row">
    <div id="header"></div>
    <div class="col-sm-2" id="menu">
      <?php require_once('content/menu.php'); ?>
    </div>
    <div class="col-sm-10">
      <div id="konten"><?php require_once('content/konten.php'); ?></div>

    </div>
    <div class="clear"></div>
  </div>
</div>
<!-- JAVA SCRIPT -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/crud.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>

<script >
$('#tablex').DataTable();
$('.fancybox').fancybox();
</script>
</body>
</html>
