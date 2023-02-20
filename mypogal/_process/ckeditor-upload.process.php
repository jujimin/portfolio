<?php
if ($_FILES['upload']['size'] > 0) {
	$curDate = date("YmdHis");
	$extension = strtolower(substr(strchr($_FILES['upload']['name'], "."), 1));
	$filename = $curDate."-".str_replace(" ", "-", $_FILES['upload']['name']);
	
	$ckeditorPath = "/mypogal/_userdata/ckeditor/images";
	$uploadPath = $_SERVER['DOCUMENT_ROOT'].$ckeditorPath;
	$uploadUrl = $_SERVER['HTTP_HOST'].$ckeditorPath."/";
	$protocal = "http".((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "")."://";
	$uploadFullUrl = $protocal.$uploadUrl;
	
	$aAllowImgExtens = array("jpg","jpeg","gif","png");
	if (in_array($extension, $aAllowImgExtens)) {
		$destination = $uploadPath."/".iconv("UTF-8", "EUC-KR", $filename);
		if (move_uploaded_file($_FILES['upload']['tmp_name'], $destination)) {
			echo '<script type="text/javascript">parent.Common.showMsg("업로드되었습니다.");</script>';
		}
	} else {
		echo '<script type="text/javascript">parent.Common.showMsg("'.$extension.'확장자는 사용할 수 없습니다.");</script>';
	}
	
	echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction({$_GET['CKEditorFuncNum']}, '".$uploadFullUrl.$filename."');</script>;";
} else {
	exit();
}
?>