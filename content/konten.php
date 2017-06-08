<?php 
if (!isset($_GET['page'])){
    header("Location: ?page=unit");
}
else {
	$page = $_GET['page'];
	switch ($page) {
	
	case 'unit': include ('page/unit.php');
                     $title = "Unit Kendaraan"; 
				break;
	case 'ck':  include ('page/ck.php');
				break;
        case 'po' :  include ('page/po.php');
                                break;
        case 'unit_edit' : include ('page/crud/edit.php');
                                break;
        case 'list' : include ('page/listestimasi.php');
                                break;
        case 'estimasi' : include 'page/estimasi.php';
                                break;
        case 'jasaadmin' : include 'page/jasaadmin.php';
                                break;
        case 'partadmin' : include 'page/partadmin.php';
                                break;
        case 'asuransi' : include 'page/asuransi.php';
                                break;
		case 'nota' :	  include 'page/nota.php';
								break;
		case 'estimasifaktur' :	  include 'page/estimasifaktur.php';
								break;
	default : include ('page/404.php');
				break;
	
	}
}
?>