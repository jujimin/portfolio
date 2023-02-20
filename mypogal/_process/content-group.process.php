<?php
/**
 * 콘텐츠 그룳 프로세스
 * Source Version 1.0.1
 * @var unknown_type
 */
$oContentGroupsProc = new net_irosoft_mypogal_content_groups_Process();

switch ($_REQUEST['act']) {
	case "add":
		if ($oContentGroupsProc->add()) {
			echo "OK";
		} else {
			echo "FAILURE";
		}
		
		break;
	/**
	 * v1.0.1 16/08/26 Added.
	 */
	case "del":
		$oContentGroupsProc->setContentGroup($_POST['cgroup']);
		if ($oContentGroupsProc->del()) {
			$msg = "OK";
		} else {
			$msg = "FAILURE";
		}
		$aResult = array("msg" => $msg);
		echo json_encode($aResult);
		break;
}
?>