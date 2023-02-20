<?php
/**********************************************************************************************************************************
 * MyPogal
 * 마이포겔은 아이로소프트 사이데미(cydemy.com)에서 개발한 웹클라이언트 개발자 과정
 * 학습자를 위한 개인 포트폴리오 갤러리 웹사이트 콘텐츠 관리 시스템입니다.
 * Copyright (c) 2016 iroSOFT
 * -------------------------------------------------------------------
 * 버전: 2.0.1-2016.08.26
 * 배포: www.cydemy.com
 * 피드백: master@cydemy.com
 * 라이센스: 다음 아래의 조항(Cydemy Licence)을 따릅니다.
 * (1) Cydemy.com 회원이면 누구나 무료로 다운로드 받아 설치를 하실 수 있습니다.
 * (2) 하나의 설치 파일당 신청시 등록한 도메인에서만 사용이 가능합니다. 단 다음 사항을 준수하는 범위 내에서 설치 도메인 갯수를 제한하지 않습니다.
 * 	- 두 개 이상의 도메인에 설치하는 경우에는 각각 별도로 다운로드 신청을 해야합니다.
 * 	- 상업용으로 절대 사용을 불허하며 학습용이거나 포트폴리오 갤러리 웹사이트 형식이어야 합니다. 포트폴리오 갤러리 웹사이트가 아닌 경우에는 학습용도로 간주합니다.
 * 	- 포트폴리오 갤러리 웹사이트가 아닌 경우에도 학습용도로 설치가 가능하나  상업적인 용도로 변경을 불허합니다.
 * 	- 학습용을 포함, 프리랜서 및 취업용으로 자신의 포트폴리오 갤러리 웹사이트에 설치하여 사용(유지)하는 경우에는 무료 사용권한을 계속 유지할 수 있습니다.
 * (3) 소스코드를 수정하거나 재배포를 금합니다.
 * (4) 위에 명시된 조건을 갖추는 경우에 소프트웨어 사용권을 가지나 소프트웨어 사용으로 인해 발생하는 피해와 오류 발생시 유지보수 책임을 지지 않습니다.
 * (5) 위의 명시된 용도 이외나 상업적 용도로 사용하시고자 하는 경우에는 별도의 라이센스를 허락받아야 합니다. 
 * <설치 환경>
 * PHP 5.3.x 이상
 * MySQL 5.5.x 이상
 * UTF-8 환경
 */

include_once './_libs/initial.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>웹포트폴리오 갤러리 관리::마이포겔</title>
<script src="./_libs/js/jquery-2.2.3.min.js"></script>
<link rel="stylesheet" href="./_libs/js/jquery-ui-1.11.4/jquery-ui.min.css">
<script src="./_libs/js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="./_libs/js/jquery.form.js"></script>
<script type="text/javascript" src="./_libs/js/jquery.ba-dotimeout/jquery.ba-dotimeout.min.js"></script>
<script type="text/javascript" src="./_libs/js/jquery.cookie.js"></script>
<link href="./style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
var _buildnum = "<?=net_irosoft_mypogal_Configs::BUILD_NUMBER?>";
var _version = "<?=net_irosoft_mypogal_Configs::VERSIOIN?>";
</script>
</head>

<body>
<?php 
$oSetup = new net_irosoft_mypogal_Setup();
if (!$oSetup->db_connect) {
	include_once './contents/dberror.php';
} else if ($oSetup->isSetup()) {
	include_once './contents/setup.php';
} else if ($oSetup->isUpdated()) {
	include_once './contents/update.php';
} else {
	if (!$oSes->isLogin()) {
		include_once './contents/login.php';
	} else {
		include_once './contents/frame.php';
		include_once './contents/common-sidebar.php';
	}
}

?>
</body>
</html>