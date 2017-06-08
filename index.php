<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GMS</title>
        <!-- JAVA SCRIPT -->
        <script src="js/jquery-1.8.3.min.js"></script>
        <script src="js/crud.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.min.js" ></script>
        <!-- Style -->
        <link rel="icon" href="img/icon.png">
        <link href="css/index.css" rel="stylesheet" type="text/css" />  
        <link href="css/blueprint.css" rel="stylesheet" type="text/css" /> 
        <link href="css/menu.css" rel="stylesheet" type="text/css" /> 
        <link href="css/unit.css" rel="stylesheet" type="text/css" /> 
        <link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.9.2.custom.min.css" /> 
</head>

<body>
<?php 
include ('config/koneksi.php'); 
include ('function/tanggal.php');    
?>
<div id="wrapper">
    <div id="header"></div>
    <div id="menu"><?php include('content/menu.php'); ?></div>
    <div id="konten"><?php include('content/konten.php'); ?></div>
    <div class="clear"></div>
    <div id="footer"></div>
</div>
</body>
</html>