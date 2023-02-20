<?php
$oContentMetaProc = new net_irosoft_mypogal_content_meta_Process();

switch ($_REQUEST['act']) {
	case "add":
		if ($oContentMetaProc->add()) {
			echo "OK";
		} else {
			echo "FAILURE";
		}
		
		break;
		
	case "del":
		$oContentMetaProc->setContentGroup($_POST['cgroup']);
		$oContentMetaProc->setMeta($_POST['meta']);
		if ($oContentMetaProc->del()) {
			echo "OK";
		} else {
			echo "FAILURE";
		}
		break;
}
exit();
?>