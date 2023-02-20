<?php
$oContentProc = new net_irosoft_mypogal_content_Process();

switch ($_REQUEST['act']) {
	case "add":
		$oContentProc->add();
		$oContentProc->addMeta();
		$oContentProc->uploadThumbnail();
		
		$aResult = array("msg" => "OK");
		break;
		
	case "update":
		$oContentProc->setCno($_POST['cno']);
		$oContentProc->update();
		$oContentProc->updateMeta();
		$result = $oContentProc->uploadThumbnail();
		
		$aResult = array("msg" => "OK", "thumbnailurl" => $result);
		
		break;
		
	case "del":
		$oContentProc->setCno($_POST['cno']);
		$oContentProc->del();
		
		$aResult = array("msg" => "OK");
		break;
}
echo json_encode($aResult);
exit();
?>