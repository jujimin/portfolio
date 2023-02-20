<?php
$oContentCategoryProc = new net_irosoft_mypogal_content_category_Process();

switch ($_REQUEST['act']) {
	case "add":
		if ($oContentCategoryProc->add()) {
			echo "OK";
		} else {
			echo "FAILURE";
		}
		
		break;
		
	case "order":
		if ($oContentCategoryProc->setOrder()) {
			echo "OK";
		} else {
			echo "FAILURE";
		}

		break;
		
	case "del":
		$oContentCategoryProc->setCategory($_POST['category']);
		if ($oContentCategoryProc->del()) {
			echo "OK";
		} else {
			echo "FAILURE";
		}
		break;
}
exit();
?>