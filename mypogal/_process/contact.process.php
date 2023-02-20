<?php
$oContactProcess = new net_irosoft_mypogal_contact_Process();

switch ($_REQUEST['act']) {
	case "confirm":
		$oContactProcess->setNo($_REQUEST['no']);
		if ($oContactProcess->confirm()) {
			echo 'OK';
		} else {
			echo 'FAILURE';
		}
		
		exit();
		break;
		
	case "del":
		$oContactProcess->setNo($_REQUEST['no']);
		if ($oContactProcess->del()) {
			echo "OK";
		} else {
			echo "FAILURE";
		}
		
		exit();
		break;
		
	default:
		if ($oContactProcess->receipt()) {
			echo "OK";
		} else {
			echo "FAILURE";
		}
		
		exit();
		
		break;
}
?>